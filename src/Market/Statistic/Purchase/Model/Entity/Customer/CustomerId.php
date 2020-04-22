<?php

declare(strict_types=1);

namespace App\Market\Purchases\Model\Entity;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class CustomerId
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}