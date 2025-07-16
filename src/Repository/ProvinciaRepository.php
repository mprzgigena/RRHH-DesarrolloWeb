<?php

namespace App\Repository;

use App\Entity\Provincia;
use App\Entity\Pais; 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ProvinciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Provincia::class);
    }

    /**
     * @return Provincia[] 
     */
    public function filtrar(?Pais $pais, ?int $minPoblacion, ?float $maxSuperficie): array 
    { 
        $qb = $this->createQueryBuilder('p') 
            ->leftJoin('p.pais', 'pais') 
            ->addSelect('pais'); 
    
        if ($pais) { 
            $qb->andWhere('p.pais = :pais') 
            ->setParameter('pais', $pais); 
        } 
    
        if ($minPoblacion !== null) { 
            $qb->andWhere('p.poblacion >= :minPoblacion') 
            ->setParameter('minPoblacion', $minPoblacion); 
        } 
    
        if ($maxSuperficie !== null) { 
            $qb->andWhere('p.superficie <= :maxSuperficie') 
            ->setParameter('maxSuperficie', $maxSuperficie); 
        } 
    
        return $qb->getQuery()->getResult(); 
    }
    

}