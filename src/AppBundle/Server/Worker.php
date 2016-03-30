<?php

namespace AppBundle\Server;

class Worker
{
    public function updateServer($servers, $date)
    {
        $data = [];

        foreach ($servers as $server)
        {
            $consumption = $server->getTypeServer()->getConsumption();
            // Minimum power consumption = 15 % of maximum power consumption
            $power = $this->getInstantPower($consumption, $consumption * 0.15, $date);
            $data[$server->getId()] = ['power' => $power];
        }

        return $data;
    }

    private function getInstantPower($maxpower, $minpower, $date)
    {
        $hours = $date->format('H');
        $minutes = $date->format('i');
        $minutes = $minutes / 60;
        $decimalHour = $hours + $minutes;

        $power = ((sin(($decimalHour/12*pi())-pi())+1)/2) * ($maxpower-$minpower) + $minpower;
        // Random power variation +/- 10%
        $randomOffset = rand(-10, 10);

        return $power + $power*($randomOffset/100);
    }
}
