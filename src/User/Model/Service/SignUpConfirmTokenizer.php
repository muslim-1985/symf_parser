<?php

declare(strict_types=1);

namespace App\User\Model\Service;

use Ramsey\Uuid\Uuid;

class SignUpConfirmTokenizer
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
