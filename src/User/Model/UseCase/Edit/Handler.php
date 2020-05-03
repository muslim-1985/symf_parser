<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Edit;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Name;
use App\User\Model\Entity\User\Id;
use App\User\Model\Entity\User\User;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class Handler
{
    private UserRepositoryInterface $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function handle(Command $command): void
    {
        /** @var User $user */
        $user = $this->users->get(new Id($command->id));

        $user->edit(
            new Email($command->email),
            new Name(
                $command->firstName,
                $command->lastName
            )
        );

        $this->users->flush($user);
    }
}
