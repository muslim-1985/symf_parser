<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\SignUp\Request;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Id;
use App\User\Model\Entity\User\Name;
use App\User\Model\Entity\User\User;
use App\User\Model\Service\SignUpConfirmTokenizer;
use App\User\Model\Service\SignUpConfirmTokenSender;
use App\User\Model\Service\PasswordHasher;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class Handler
{
    private UserRepositoryInterface $users;
    private PasswordHasher $hasher;
    private SignUpConfirmTokenizer $tokenizer;
    private SignUpConfirmTokenSender $sender;

    public function __construct(
        UserRepositoryInterface $users,
        PasswordHasher $hasher,
        SignUpConfirmTokenizer $tokenizer,
        SignUpConfirmTokenSender $sender
    )
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new \DomainException('User already exists.');
        }

        $user = User::signUpByEmail(
            Id::next(),
            new \DateTimeImmutable(),
            new Name(
                $command->firstName,
                $command->lastName
            ),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate()
        );

        $this->users->add($user);

        $this->sender->send($email, $token);

        $this->users->flush($user);
    }
}
