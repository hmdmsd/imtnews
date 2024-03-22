<?php

namespace App\Repository;

use App\Entity\Reporter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reporter>
 *
 * @method Reporter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reporter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reporter[]    findAll()
 * @method Reporter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReporterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reporter::class);
    }

//    /**
//     * @return Reporter[] Returns an array of Reporter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reporter
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
