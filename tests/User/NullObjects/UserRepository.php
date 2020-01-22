<?php
declare(strict_types=1);

namespace App\Tests\User\NullObjects;


use App\User\Repository\Contracts\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        // TODO: Implement upgradePassword() method.
    }

    public function saveUser(UserInterface $user): void
    {
        // TODO: Implement saveUser() method.
    }
}