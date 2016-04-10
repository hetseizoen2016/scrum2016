<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ReservatieRepository extends EntityRepository
{
   public function findAllOrderedByDate()
   {
       return $this->getEntityManager()
           ->createQuery(
               'SELECT p FROM AppBundle:Reservatie p ORDER BY p.datum ASC'
           )
           ->getResult();
   }
}
