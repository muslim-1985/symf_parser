<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Email\Request;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Id;
use App\User\Model\Service\NewEmailConfirmTokenizer;
use App\User\Model\Service\NewEmailConfirmTokenSender;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class Handler
{
    private UserRepositoryInterface $users;
    private NewEmailConfirmTokenizer $tokenizer;
    private NewEmailConfirmTokenSender $sender;

    public function __construct(
        UserRepositoryInterface $users,
        NewEmailConfirmTokenizer $tokenizer,
        NewEmailConfirmTokenSender $sender
    )
    {
        $this->users = $users;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
    }

    public function handle(Command $command): void
    {
        $user = $this->users->get(new Id($command->id));

        $email = new Email($command->email);

        if ($this->users->hasByEmail($email)) {
            throw new \DomainException('Email is already in use.');
        }

        $user->requestEmailChanging(
            $email,
            $token = $this->tokenizer->generate()
        );

        $this->users->flush($user);

        $this->sender->send($email, $token);
    }
}
