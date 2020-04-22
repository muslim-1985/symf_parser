<?php
declare(strict_types=1);

namespace App\Market\Product\Model\Repository;


use App\Dependencies\RepositoryInterface;
use App\Market\Product\Model\Entity\CreatorProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class MappedProductRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreatorProduct::class);
    }
    public function add(object $entity): void
    {
        // TODO: Implement add() method.
    }

    public function flush(): void
    {
        // TODO: Implement flush() method.
    }
}