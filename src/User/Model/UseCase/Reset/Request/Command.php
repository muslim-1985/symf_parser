<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Reset\Request;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;
}