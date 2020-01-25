<?php
declare(strict_types=1);

namespace App\Purchases\Repository;

use App\Purchases\Entity\PurchaseCheck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PurchaseCheck|null find($id, $lockMode = null, $lockVersion = null)
 * @method PurchaseCheck|null findOneBy(array $criteria, array $orderBy = null)
 * @method PurchaseCheck[]    findAll()
 * @method PurchaseCheck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchaseCheckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PurchaseCheck::class);
    }

    // /**
    //  * @return PurchaseCheck[] Returns an array of PurchaseCheck objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PurchaseCheck
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}