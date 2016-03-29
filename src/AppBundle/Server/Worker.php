<?php

namespace AppBundle\Server;

class Worker
{
    public function updateServer($serverIds)
    {
        $data = [];

        foreach ($serverIds as $serverId)
        {
            $data[] = "WIP";
        }

        return $data;
    }

    private function getInstantPower($maxpower, $minpower, $time)
    {
        $hours = $time->format('H');
        $minutes = $time->format('i');
        $minutes = $minutes / 60;
        $decimalHour = $hours + $minutes;

        $power = ((sin(($decimalHour/12*pi())-pi())+1)/2) * ($maxpower-$minpower) + $minpower;
        // Random power variation +/- 10%
        $randomOffset = rand(-10, 10);

        return $power + $power*($randomOffset/100);
    }
}
