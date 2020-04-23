<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\SignUp\Confirm\ByToken;

class Command
{
    public $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
