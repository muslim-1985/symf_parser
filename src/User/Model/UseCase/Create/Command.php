<?php
declare(strict_types=1);

namespace App\User\Model\UseCase\Create;
use App\User\Model\Entity\Email;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public Email $email;
    /**
     * @Assert\NotBlank()
     */
    public string $name;
    /**
     * @Assert\Ip()
     */
    public string $ip;
    /**
     * @Assert\NotBlank()
     */
    public string $password;
}