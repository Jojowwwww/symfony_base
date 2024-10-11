<?php

namespace App\Repository;

use App\Entity\Burger;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Burger>
 */
class BurgerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Burger::class);
    }

    public function findBurgersWithIngredient(string $ingredient): array
    {
        return $this->createQueryBuilder('b')
            ->join('b.oignons', 'o')
            ->join('b.sauces', 's')
            ->where('o.name LIKE :ingredient OR s.name LIKE :ingredient')
            ->setParameter('ingredient', '%' . $ingredient . '%')
            ->getQuery()
            ->getResult();
    }

    public function findTopXBurgers(int $limit)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.price', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Burger[] Returns an array of Burger objects
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

//    public function findOneBySomeField($value): ?Burger
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
