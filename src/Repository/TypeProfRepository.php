<?php

namespace App\Repository;

use App\Entity\TypeProf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeProf|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeProf|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeProf[]    findAll()
 * @method TypeProf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeProfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeProf::class);
    }

    // /**
    //  * @return TypeProf[] Returns an array of TypeProf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeProf
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
