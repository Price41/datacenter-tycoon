<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TypeInternet;

class LoadTypeInternetData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $typeInternet1 = new TypeInternet();
        $typeInternet1->setSpeed(20);
        $typeInternet1->setBuildingCost(0);
        $typeInternet1->setMonthlyCost(50);

        $manager->persist($typeInternet1);

        $typeInternet2 = new TypeInternet();
        $typeInternet2->setSpeed(50);
        $typeInternet2->setBuildingCost(0);
        $typeInternet2->setMonthlyCost(65);

        $manager->persist($typeInternet2);

        $manager->flush();
    }
}
