<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 8/04/2016
 * Time: 10:39
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservatieRegelsRepository extends EntityRepository
{
    public function findByReservatieId($reservatieId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:ReservatieRegels p WHERE p.reservatieId = $reservatieId'
            )
            ->getResult();
    }
}
