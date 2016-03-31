<?php

namespace AppBundle\Server;

class Worker
{
    public function updateServer($servers, $date)
    {
        $data = [];
        $data['servers'] = [];
        $data['datacenters'] = [];

        foreach ($servers as $server)
        {
            $consumption = $server->getTypeServer()->getConsumption();
            // Minimum power consumption = 15 % of maximum power consumption
            $power = $this->getInstantPower($consumption, $consumption * 0.15, $date);
            $wanUsage = $this->getInstantWanUsage(10, 1, $date);
            $data['servers'][$server->getId()] = [
                'power' => number_format($power, 0),
                'wan_usage' => number_format($wanUsage, 1)
            ];

            $idDatacenter = $server->getRack()->getDatacenter()->getId();
            if(!isset($data['datacenters'][$idDatacenter]))
            {
                $data['datacenters'][$idDatacenter]['power'] = 0;
                $data['datacenters'][$idDatacenter]['wan_usage'] = 0;
            }
            $data['datacenters'][$idDatacenter]['power'] += $power;
            $data['datacenters'][$idDatacenter]['wan_usage'] += $wanUsage;
        }

        return $data;
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
