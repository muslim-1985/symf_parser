<?php

declare(strict_types=1);

namespace App\User\Model\Service;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\ResetToken;
use Twig\Environment;

class ResetTokenSender
{
    private \Swift_Mailer $mailer;
    private Environment $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(Email $email, ResetToken $token): void
    {
        $message = (new \Swift_Message('Password resetting'))
            ->setTo($email->getValue())
            ->setBody($this->twig->render('mail/user/reset.html.twig', [
                'token' => $token->getToken()
            ]), 'text/html');

        if (!$this->mailer->send($message)) {
            throw new \RuntimeException('Unable to send message.');
        }
    }
}
