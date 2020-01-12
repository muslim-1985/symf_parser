<?php
declare(strict_types=1);

namespace App\Markets\Repository;

use App\Markets\Entity\MarketProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MarketProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketProducts[]    findAll()
 * @method MarketProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketProducts::class);
    }

    // /**
    //  * @return MarketProducts[] Returns an array of MarketProducts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarketProducts
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
