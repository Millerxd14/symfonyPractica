<?php

namespace App\Repository;

use App\Entity\CalificacionesFinales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CalificacionesFinales|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalificacionesFinales|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalificacionesFinales[]    findAll()
 * @method CalificacionesFinales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalificacionesFinalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalificacionesFinales::class);
    }
    public function buscarCalificacion($nombre){
        return $this->getEntityManager()
            ->createQuery("SELECT c FROM App:CalificacionesFinales c WHERE c.nombreEstudiante LIKE :nombre")
            ->setParameter('nombre', '%'.$nombre.'%')
            ->getResult();
    }
    public function promediosPorMateria(){
        return $this->getEntityManager()
            ->createQuery("SELECT cal.nombreMateria, AVG(cal.calificacionFinal) as promedio FROM App:CalificacionesFinales cal GROUP BY cal.nombreMateria")
            ->getResult();
    }
    // /**
    //  * @return CalificacionesFinales[] Returns an array of CalificacionesFinales objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CalificacionesFinales
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
