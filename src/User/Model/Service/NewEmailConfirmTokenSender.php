<?php

declare(strict_types=1);

namespace App\User\Model\Service;

use App\User\Model\Entity\User\Email;
use Twig\Environment;

class NewEmailConfirmTokenSender
{
    private \Swift_Mailer $mailer;
    private Environment $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(Email $email, string $token): void
    {
        $message = (new \Swift_Message('Email Confirmation'))
            ->setTo($email->getValue())
            ->setBody($this->twig->render('mail/user/email.html.twig', [
                'token' => $token
            ]), 'text/html');

        if (!$this->mailer->send($message)) {
            throw new \RuntimeException('Unable to send message.');
        }
    }
}
