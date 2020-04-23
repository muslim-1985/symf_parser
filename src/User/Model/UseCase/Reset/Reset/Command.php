<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Reset\Reset;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $token;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    public $password;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}