<?php

namespace AppBundle\Repository;

class ServerRepository extends \Doctrine\ORM\EntityRepository
{
    public function FindByIds($ids)
    {
        $qb = $this->createQueryBuilder('s');

        $qb->where('s.id IN (:ids)')->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }
}
