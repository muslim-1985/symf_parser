<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Create;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Name;
use App\User\Model\Entity\User\User;
use App\User\Model\Entity\User\Id;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;
use App\User\Model\Service\PasswordGenerator;
use App\User\Model\Service\PasswordHasher;

class Handler
{
    private UserRepositoryInterface $users;
    private PasswordHasher $hasher;
    private PasswordGenerator $generator;

    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasher $hasher,
        PasswordGenerator $generator
    )
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->generator = $generator;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new \DomainException('User with this email already exists.');
        }

        $user = User::create(
            Id::next(),
            new \DateTimeImmutable(),
            new Name(
                $command->firstName,
                $command->lastName
            ),
            $email,
            $this->hasher->hash($this->generator->generate())
        );

        $this->users->add($user);

        $this->users->flush();
    }
}
