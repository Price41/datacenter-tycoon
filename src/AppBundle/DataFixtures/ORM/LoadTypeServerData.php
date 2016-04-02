<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TypeServer;

class LoadTypeServerData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $typeServerXS = new TypeServer();
        $typeServerXS->setName('XS');
        $typeServerXS->setCpuNumber(1);
        $typeServerXS->setCpuCores(4);
        $typeServerXS->setCpuHT(1);
        $typeServerXS->setCpuFreq(2000);
        $typeServerXS->setRam(8);
        $typeServerXS->setHdd(500);
        $typeServerXS->setConsumption(200);
        $typeServerXS->setBuyingCost(1200);
        $typeServerXS->setHeight(1);

        $manager->persist($typeServerXS);

        $typeServerS = new TypeServer();
        $typeServerS->setName('S');
        $typeServerS->setCpuNumber(2);
        $typeServerS->setCpuCores(4);
        $typeServerS->setCpuHT(1);
        $typeServerS->setCpuFreq(2000);
        $typeServerS->setRam(16);
        $typeServerS->setHdd(1000);
        $typeServerS->setConsumption(350);
        $typeServerS->setBuyingCost(2000);
        $typeServerS->setHeight(1);

        $manager->persist($typeServerS);

        $manager->flush();
    }
}
