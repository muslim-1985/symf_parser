<?php
declare(strict_types=1);

namespace App\Market\Product\Model\Repository;

use App\Dependencies\RepositoryInterface;
use App\Market\Product\Model\Entity\CreatorProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CreatorProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreatorProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreatorProduct[]    findAll()
 * @method CreatorProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatorProductRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreatorProduct::class);
    }

    // /**
    //  * @return CreatorProduct[] Returns an array of CreatorProduct objects
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
    public function findOneBySomeField($value): ?CreatorProduct
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
