<?php

namespace App\Repository;

use App\Entity\Estudiantemateria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estudiantemateria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudiantemateria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudiantemateria[]    findAll()
 * @method Estudiantemateria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudiantemateriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudiantemateria::class);
    }

    // /**
    //  * @return Estudiantemateria[] Returns an array of Estudiantemateria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estudiantemateria
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
