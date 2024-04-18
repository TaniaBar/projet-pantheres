<?php

namespace App\Repository;

use App\Entity\Boxes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Boxes>
 *
 * @method Boxes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boxes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boxes[]    findAll()
 * @method Boxes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoxesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boxes::class);
    }

    //    /**
    //     * @return Boxes[] Returns an array of Boxes objects
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

    //    public function findOneBySomeField($value): ?Boxes
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
