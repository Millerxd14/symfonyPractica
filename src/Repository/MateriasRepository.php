<?php

namespace App\Repository;

use App\Entity\Materias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Materias|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materias|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materias[]    findAll()
 * @method Materias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MateriasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materias::class);
    }
    public function buscarMateria($nombre){
        return $this->getEntityManager()
            ->createQuery("SELECT m FROM App:Materias m WHERE m.nombre LIKE :nombre")
            ->setParameter('nombre', '%'.$nombre.'%')
            ->getResult();
    }
    // /**
    //  * @return Materias[] Returns an array of Materias objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Materias
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
