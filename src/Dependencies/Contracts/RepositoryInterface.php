<?php

namespace App\Dependencies\Contracts;


interface RepositoryInterface
{
    public function add(object $entity): void;
    public function flush(): void;
}