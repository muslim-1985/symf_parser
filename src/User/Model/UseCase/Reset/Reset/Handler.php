<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Reset\Reset;

use App\User\Model\Service\PasswordHasher;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class Handler
{
    private UserRepositoryInterface $users;
    private PasswordHasher $hasher;

    public function __construct(UserRepositoryInterface $users, PasswordHasher $hasher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
    }

    public function handle(Command $command): void
    {
        if (!$user = $this->users->findByResetToken($command->token)) {
            throw new \DomainException('Incorrect or confirmed token.');
        }

        $user->passwordReset(
            new \DateTimeImmutable(),
            $this->hasher->hash($command->password)
        );

        $this->users->flush();
    }
}
