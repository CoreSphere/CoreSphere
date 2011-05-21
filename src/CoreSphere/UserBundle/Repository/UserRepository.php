<?php

namespace CoreSphere\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT u
                                   FROM CoreSphere\UserBundle\Entity\User u
                                   ORDER BY u.username ASC')
                    ->getResult();
    }
}