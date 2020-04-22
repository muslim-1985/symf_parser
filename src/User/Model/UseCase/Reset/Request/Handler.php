<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Reset\Request;

use App\User\Model\Entity\User\Email;
use App\User\Model\Service\ResetTokenizer;
use App\User\Model\Service\ResetTokenSender;
use App\User\Model\Repository\Contracts\UserRepositoryInterface;

class Handler
{
    private UserRepositoryInterface $users;
    private ResetTokenizer $tokenizer;
    private ResetTokenSender $sender;

    public function __construct(
        UserRepositoryInterface $users,
        ResetTokenizer $tokenizer,
        ResetTokenSender $sender
    )
    {
        $this->users = $users;
        $this->tokenizer = $tokenizer;
        $this->sender = $sender;
    }

    public function handle(Command $command): void
    {
        $user = $this->users->getByEmail(new Email($command->email));

        $user->requestPasswordReset(
            $this->tokenizer->generate(),
            new \DateTimeImmutable()
        );

        $this->users->flush();

        $this->sender->send($user->getEmail(), $user->getResetToken());
    }
}
