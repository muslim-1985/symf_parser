<?php
declare(strict_types=1);

namespace App\Market\Product\Model\Repository;

use App\Dependencies\RepositoryInterface;
use App\Market\Product\Model\Entity\CreditCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class CreditCardRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditCard::class);
    }

    // /**
    //  * @return UserProduct[] Returns an array of UserProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserProduct
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function add(object $entity): void
    {
        // TODO: Implement add() method.
    }

    public function flush(): void
    {
        // TODO: Implement flush() method.
    }
}