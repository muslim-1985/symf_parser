<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Network\Auth;

class Command
{
    public $network;
    public $identity;
    public $firstName;
    public $lastName;

    public function __construct(string $network, string $identity)
    {
        $this->network = $network;
        $this->identity = $identity;
    }
}
