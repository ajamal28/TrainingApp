<?php

namespace App\Repository;

use App\Entity\Bikes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bikes>
 *
 * @method Bikes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bikes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bikes[]    findAll()
 * @method Bikes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bikes::class);
    }

    //    /**
    //     * @return Bikes[] Returns an array of Bikes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Bikes
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
