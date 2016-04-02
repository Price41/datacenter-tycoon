<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TypeElectricity;

class LoadTypeElectricityData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $typeElectricity1 = new TypeElectricity();
        $typeElectricity1->setPower(7500);
        $typeElectricity1->setBuildingCost(0);
        $typeElectricity1->setMonthlyCost(10);
        $typeElectricity1->setKwhCost(0.1);

        $manager->persist($typeElectricity1);

        $typeElectricity2 = new TypeElectricity();
        $typeElectricity2->setPower(15000);
        $typeElectricity2->setBuildingCost(0);
        $typeElectricity2->setMonthlyCost(20);
        $typeElectricity2->setKwhCost(0.095);

        $manager->persist($typeElectricity2);

        $manager->flush();
    }
}
