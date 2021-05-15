<?php

namespace App\Repository;

use App\Entity\Estudiantes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estudiantes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estudiantes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estudiantes[]    findAll()
 * @method Estudiantes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstudiantesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estudiantes::class);
    }



    public function buscarEstudiante($nombre){
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM App:Estudiantes e WHERE e.nombre LIKE :nombre")
            ->setParameter('nombre', '%'.$nombre.'%')
            ->getResult();
    }
    // /**
    //  * @return Estudiantes[] Returns an array of Estudiantes objects
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
    public function findOneBySomeField($value): ?Estudiantes
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
