<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\SignUp\Confirm\ByToken;

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
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new \DomainException('Incorrect or confirmed token.');
        }

        $user->confirmSignUp();

        $this->users->flush($user);
    }
}
