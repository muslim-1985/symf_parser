<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\Network\Detach;

class Command
{
    public $user;
    public $network;
    public $identity;

    public function __construct(string $user, string $network, string $identity)
    {
        $this->user = $user;
        $this->network = $network;
        $this->identity = $identity;
    }
}
