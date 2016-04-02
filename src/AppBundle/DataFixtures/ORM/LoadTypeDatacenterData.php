<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TypeDatacenter;

class LoadTypeDatacenterData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $typeDatacenter1 = new TypeDatacenter();
        $typeDatacenter1->setName('Garage');
        $typeDatacenter1->setMaxRack(3);

        $manager->persist($typeDatacenter1);

        $typeDatacenter2 = new TypeDatacenter();
        $typeDatacenter2->setName('DataCenter Tier I');
        $typeDatacenter2->setMaxRack(50);

        $manager->persist($typeDatacenter2);

        $typeDatacenter3 = new TypeDatacenter();
        $typeDatacenter3->setName('DataCenter Tier II');
        $typeDatacenter3->setMaxRack(100);

        $manager->persist($typeDatacenter3);

        $typeDatacenter4 = new TypeDatacenter();
        $typeDatacenter4->setName('DataCenter Tier III');
        $typeDatacenter4->setMaxRack(250);

        $manager->persist($typeDatacenter4);

        $manager->flush();
    }
}
