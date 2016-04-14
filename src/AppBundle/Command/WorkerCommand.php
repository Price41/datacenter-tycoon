<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Server\Worker;

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

        $zmqcontext = new \ZMQContext();
        $socket = $zmqcontext->getSocket(\ZMQ::SOCKET_PUSH);
        $socket->connect('tcp://localhost:5555');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $worker = new Worker($em);

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
            $data['date'] = $date->format('Y-m-d H:i:s');
            $data['users'] = [];

            $users = $em->getRepository('AppBundle:User')->findAll();
            foreach ($users as $user)
            {
                $userData['datacenters'] = [];
                foreach ($user->getDatacenters() as $datacenter)
                {
                    $datacenterData['racks'] = [];

                    foreach ($datacenter->getRacks() as $rack)
                    {
                        if(!isset($datacenterData['racks'][$rack->getId()])) {
                            $datacenterData['racks'][$rack->getId()] = [];
                        }
                        $rackData = [];
                        $workerData = $worker->updateServer($rack->getServers(), $date);

                        $rackData['servers'] = $workerData['servers'];
                        /*$data['datacenters'] = [];*/

                        foreach ($workerData['datacenters'] as $idDatacenter => $value)
                        {
                            // kWh used in 10 minutes
                            $kwh = $value['power'] * (10/60) / 1000;
                            if($predis->exists('dc'.$idDatacenter.'_kwh'))
                            {
                                $datacenterKWh = $predis->get('dc'.$idDatacenter.'_kwh');
                                $kwh += $datacenterKWh;
                            }
                            $predis->set('dc'.$idDatacenter.'_kwh', $kwh);

                            $datacenterData['power_usage'] = number_format($value['power']);
                            $datacenterData['kwh'] = number_format($kwh, 3);
                            $datacenterData['wan_usage'] = number_format($value['wan_usage'], 1);
                        }

                        $datacenterData['racks'][$rack->getId()] = $rackData;
                    }
                    $userData['datacenters'][$datacenter->getId()] = $datacenterData;
                }
                $data['users'][$user->getId()] = $userData;
            }

            // Time += 10 minutes at each iteration
            $date->add(new \DateInterval('PT10M'));
            $predis->set('date', $date->format('Y-m-d H:i:s'));

            $jsonencode = json_encode($data);
            $socket->send($jsonencode);

            $timeEnd = microtime(true);
            usleep(1000000 - ($timeEnd - $timeStart) * 1000000);
            $timeEndSleep = microtime(true);
            /*$output->writeln(number_format($timeEnd - $timeStart, 4) * 1000 .
                ' ms => ' . number_format($timeEndSleep - $timeStart, 4) * 1000 . ' ms total');*/
        }
    }
}
