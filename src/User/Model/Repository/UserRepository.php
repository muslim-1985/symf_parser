<?php
declare(strict_types = 1);

namespace App\User\Model\Repository;

use App\Dependencies\Contracts\AggregateRoot;
use App\Dependencies\Contracts\RepositoryInterface;
use App\Dependencies\Exceptions\EntityNotFoundException;
use App\Event\Dispatcher\EventDispatcher;
use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Id;
use App\User\Model\Entity\User\User;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private EventDispatcher $dispatcher;

    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     * @param EventDispatcher $dispatcher
     */
    public function __construct(ManagerRegistry $registry, EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        parent::__construct($registry, User::class);
    }

    public function findByConfirmToken(string $token): ?User
    {
        return $this->findOneBy(['confirmToken' => $token]);
    }

    /**
     * @param string $token
     * @return User|object|null
     */
    public function findByResetToken(string $token): ?User
    {
        return $this->findOneBy(['resetToken.token' => $token]);
    }

    public function get(Id $id): User
    {
        /** @var User $user */
        if (!$user = $this->find($id->getValue())) {
            throw new EntityNotFoundException('User is not found.');
        }
        return $user;
    }

    public function getByEmail(Email $email): User
    {
        /** @var User $user */
        if (!$user = $this->findOneBy(['email' => $email->getValue()])) {
            throw new EntityNotFoundException('User is not found.');
        }
        return $user;
    }

    public function hasByEmail(Email $email): bool
    {
        return $this->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.email = :email')
                ->setParameter(':email', $email->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    /**
     * @param string $network
     * @param string $identity
     * @return bool
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function hasByNetworkIdentity(string $network, string $identity): bool
    {
        return $this->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->innerJoin('t.networks', 'n')
                ->andWhere('n.network = :network and n.identity = :identity')
                ->setParameter(':network', $network)
                ->setParameter(':identity', $identity)
                ->getQuery()->getSingleScalarResult() > 0;
    }
    // /**
    //  * @return ProductCreator[] Returns an array of ProductCreator objects
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


//    public function findOneBySomeField($value): ?ProductCreator
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.email = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * @param object $user
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(object $user): void
    {
        $this->_em->persist($user);
    }

    /**
     * @param AggregateRoot[] $roots
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush (AggregateRoot ...$roots): void
    {
        $this->_em->flush();
        foreach ($roots as $root) {
            $this->dispatcher->dispatch($root->releaseEvents());
        }
    }
}
