<?php

namespace App\Repository;

use App\Entity\Wines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wines>
 *
 * @method Wines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wines[]    findAll()
 * @method Wines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wines::class);
    }

    //    /**
    //     * @return Wines[] Returns an array of Wines objects
    //     */

    // methode pour barre de recherche
       public function findOneBySearchTerm(string $searchTerm): array
       {
           return $this->createQueryBuilder('w')
               ->where('w.name LIKE :searchTerm')
               ->setParameter('searchTerm', '%' . $searchTerm . '%')
               ->getQuery()
               ->getResult()
            ;
       }

    //   methode pour filtrer les categories de vin

       public function findByCategory($category)
       {
        return $this->createQueryBuilder('w')
            ->leftJoin('w.categories', 'c') // leftJoin associa i vini alle categorie
            ->where('c.name = :category') // filtra i vini in base al nome della categoria
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
       }

    //    methode pour filtrer sur les prix
    public function findByPriceRange(float $minPrice, float $maxPrice): array
    {
        return $this->createQueryBuilder('w')
            ->where('w.price BETWEEN :minPrice AND :maxPrice')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('maxPrice', $maxPrice)
            ->getQuery()
            ->getResult();
    } 
    
    //    public function findOneBySomeField($value): ?Wines
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
