<?php

namespace App\Repository;

use App\Entity\Acontacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Acontacter>
 *
 * @method Acontacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acontacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acontacter[]    findAll()
 * @method Acontacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcontacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acontacter::class);
    }

//    /**
//     * @return Acontacter[] Returns an array of Acontacter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Acontacter
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
