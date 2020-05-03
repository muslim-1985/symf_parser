<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Network\Detach;

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
        $user = $this->users->get(new Id($command->user));

        $user->detachNetwork(
            $command->network,
            $command->identity
        );

        $this->users->flush($user);
    }
}
