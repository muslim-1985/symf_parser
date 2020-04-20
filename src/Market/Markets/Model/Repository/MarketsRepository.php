<?php
declare(strict_types=1);

namespace App\Market\Markets\Model\Repository;

use App\Markets\Entity\Markets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Markets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Markets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Markets[]    findAll()
 * @method Markets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Markets::class);
    }

    // /**
    //  * @return Markets[] Returns an array of Markets objects
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
    public function findOneBySomeField($value): ?Markets
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
