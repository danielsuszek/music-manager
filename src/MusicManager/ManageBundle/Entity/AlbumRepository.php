<?php

namespace MusicManager\ManageBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AlbumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlbumRepository extends EntityRepository
{
    public function getNameOrdered($asc_desc = 'ASC') 
    {
        $qb = $this->createQueryBuilder('alb')
           ->select('alb')
           ->addOrderBy('alb.name', $asc_desc);

        return $qb->getQuery()
                  ->getResult();        
    }
}
