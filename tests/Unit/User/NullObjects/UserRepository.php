<?php
declare(strict_types=1);

namespace App\Tests\Unit\User\NullObjects;


use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\User;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function add(object $entity): void
    {
        // TODO: Implement add() method.
    }

    public function flush(): void
    {
        // TODO: Implement flush() method.
    }

    public function getByEmail(Email $email): User
    {
        // TODO: Implement getByEmail() method.
    }

    public function hasByEmail(Email $email): bool
    {
        // TODO: Implement hasByEmail() method.
    }
}