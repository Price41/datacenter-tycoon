<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('dct:worker')
            ->setDescription('Start the DCT worker')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        \Predis\Autoloader::register();
        $predis = new \Predis\Client();

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        $pusher = $this->getContainer()->get('gos_web_socket.zmq.pusher');

        $lastIncomeDate = '';

        while(true)
        {
            $timeStart = microtime(true);

            $data = [];

            if(!$predis->exists('date'))
            {
                $d = new \DateTime('now');
                $predis->set('date', $d->format('Y-m-d 0:0:0'));
            }
            $date = new \DateTime($predis->get('date'));

            // Time += 10 minutes at each iteration
            $date->add(new \DateInterval('PT10M'));
            $predis->set('date', $date->format('Y-m-d H:i:s'));

            $users = $em->getRepository('AppBundle:User')->findAll();
            foreach ($users as $user)
            {
                $userData = [];
                $userData['datacenters'] = [];
                foreach ($user->getDatacenters() as $datacenter)
                {
                    $datacenterData['racks'] = [];
                    $datacenterData['power_usage'] = 0;
                    $datacenterData['kwh'] = 0;
                    $datacenterData['wan_usage'] = 0;

                    foreach ($datacenter->getRacks() as $rack)
                    {
                        if(!isset($datacenterData['racks'][$rack->getId()])) {
                            $datacenterData['racks'][$rack->getId()] = [];
                        }
                        $rackData = [];

                        foreach ($rack->getServers() as $server)
                        {
                            $serverId = $server->getId();
                            $consumption = $server->getTypeServer()->getConsumption();

                            // Minimum power consumption = 15 % of maximum power consumption
                            $power = $this->getInstantPower($consumption, $consumption * 0.15, $date);
                            $wanUsage = $this->getInstantWanUsage(10, 1, $date);

                            $rackData['servers'][$serverId] = [
                                'power' => number_format($power, 0),
                                'wan_usage' => number_format($wanUsage, 1)
                            ];

                            $datacenterData['power_usage'] += $power;
                            $datacenterData['wan_usage'] += $wanUsage;
                        }

                        $datacenterData['racks'][$rack->getId()] = $rackData;
                    }

                    /* If the bandwidth used by DC servers is greater than the DC Internet max bandwidth
                       Limit wan usage for each server proportionally to their original wan usage */
                    $maxDCBandwidth = $datacenter->getTypeInternet()->getSpeed();
                    if($datacenterData['wan_usage'] > $maxDCBandwidth) {
                        $delta = $datacenterData['wan_usage'] - $maxDCBandwidth;
                        foreach ($datacenter->getRacks() as $rack)
                        {
                            foreach ($rack->getServers() as $server)
                            {
                                $serverData = $datacenterData['racks'][$rack->getId()]['servers'][$server->getId()];
                                $originalWanUsage = $serverData['wan_usage'];
                                $newWanUsage = $originalWanUsage - ($originalWanUsage / $datacenterData['wan_usage']) * $delta;
                                $datacenterData['racks'][$rack->getId()]['servers'][$server->getId()]["wan_usage"] = number_format($newWanUsage, 1);

                            }
                        }
                        $datacenterData['wan_usage'] = $maxDCBandwidth;
                    }

                    // kWh used in 10 minutes
                    $kwh = $datacenterData['power_usage'] * (10/60) / 1000;
                    if($predis->exists('dc'.$datacenter->getId().'_kwh'))
                    {
                        $datacenterKWh = $predis->get('dc'.$datacenter->getId().'_kwh');
                        $kwh += $datacenterKWh;
                    }
                    $predis->set('dc'.$datacenter->getId().'_kwh', $kwh);

                    $datacenterData['power_usage'] = number_format($datacenterData['power_usage']);
                    $datacenterData['kwh'] = number_format($kwh, 3);
                    $datacenterData['wan_usage'] = number_format($datacenterData['wan_usage'], 1);

                    if($date->format('d') == $date->format('t') && $lastIncomeDate != $date->format('Y-m-d'))
                    {
                        $serversIncome = 0;
                        foreach ($user->getOffers() as $offer)
                        {
                            foreach ($offer->getCustomers() as $customer)
                            {
                                $serversIncome += $offer->getPrice() * $customer->getQuantity();
                            }
                        }

                        $electricityCost = round($datacenter->getTypeElectricity()->getKwhCost() * $kwh, 2);
                        $internetCost = $datacenter->getTypeInternet()->getMonthlyCost();

                        $userData['income'] = [
                            "kwh_used" => round($kwh, 3),
                            "electricity_cost" => $electricityCost,
                            "internet_cost" => $internetCost,
                            "servers_income" => $serversIncome,
                            "balance_delta" => $serversIncome - $electricityCost - $internetCost
                        ];
                        $user->setBalance($user->getBalance() - $electricityCost - $internetCost + $serversIncome);
                        $em->flush();
                        $predis->set('dc'.$datacenter->getId().'_kwh', 0);
                    }

                    $userData['datacenters'][$datacenter->getId()] = $datacenterData;
                    $userData['balance'] = $user->getBalance();
                }
                $data = $userData;
                $data['date'] = $date->format('Y-m-d H:i:s');
                $jsonencode = json_encode($data);
                $pusher->push($jsonencode, 'player_topic', ['user_id'=> $user->getId()]);
            }

            if($date->format('d') == $date->format('t') && $lastIncomeDate != $date->format('Y-m-d'))
            {
                $lastIncomeDate = $date->format('Y-m-d');
            }

            $timeEnd = microtime(true);
            $timeToSleep = 1000000 - ($timeEnd - $timeStart) * 1000000;
            if($timeToSleep > 0) {
                usleep($timeToSleep);
            }
            $timeEndSleep = microtime(true);

            if ($output->isVerbose())
            {
                $output->writeln(number_format($timeEnd - $timeStart, 4) * 1000 .
                    ' ms => ' . number_format($timeEndSleep - $timeStart, 4) * 1000 . ' ms total (' .
                    number_format(memory_get_usage()/1024/1024, 3) . ' Mo)');
            }
        }
    }

    private function getInstantPower($maxPower, $minPower, $date)
    {
        $decimalHour = $this->getDecimalHour($date);

        $power = ((sin(($decimalHour/12*pi())-pi())+1)/2) * ($maxPower-$minPower) + $minPower;
        // Random power variation +/- 10%
        $randomOffset = rand(-10, 10);

        return $power + $power * ($randomOffset / 100);
    }

    private function getInstantWanUsage($maxUsage, $minUsage, $date)
    {
        $decimalHour = $this->getDecimalHour($date);

        $wanUsage = ((sin(($decimalHour/12*pi())-pi())+1)/2) * ($maxUsage-$minUsage) + $minUsage;
        // Random Wan usage variation +/- 50%
        $randomOffset = rand(-50, 50);

        return $wanUsage + $wanUsage * ($randomOffset / 100);
    }

    private function getDecimalHour($date)
    {
        $hours = $date->format('H');
        $minutes = $date->format('i');

        return $hours + $minutes / 60;
    }
}
