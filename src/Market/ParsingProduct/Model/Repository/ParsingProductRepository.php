<?php
declare(strict_types=1);

namespace App\Market\Markets\Model\Repository;

use App\Markets\Entity\MarketProducts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MarketProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketProducts[]    findAll()
 * @method MarketProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParsingProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketProducts::class);
    }

    // /**
    //  * @return ParsingProduct[] Returns an array of ParsingProduct objects
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
    public function findOneBySomeField($value): ?ParsingProduct
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
