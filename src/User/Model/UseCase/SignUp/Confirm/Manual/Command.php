<?php

declare(strict_types=1);

namespace App\User\Model\UseCase\SignUp\Confirm\Manual;

class Command
{
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
