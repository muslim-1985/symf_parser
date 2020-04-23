<?php

declare(strict_types=1);

namespace App\Container\Model\User\Service;

use App\User\Model\Service\ResetTokenizer;

class ResetTokenizerFactory
{
    public function create(string $interval): ResetTokenizer
    {
        return new ResetTokenizer(new \DateInterval($interval));
    }
}