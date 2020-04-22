<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Network\Attach;

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
        if ($this->users->hasByNetworkIdentity($command->network, $command->identity)) {
            throw new \DomainException('Profile is already in use.');
        }
        /** @var User $user */
        $user = $this->users->get(new Id($command->user));

        $user->attachNetwork(
            $command->network,
            $command->identity
        );

        $this->users->flush();
    }
}
