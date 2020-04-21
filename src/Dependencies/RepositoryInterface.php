<?php

namespace App\Dependencies;


interface RepositoryInterface
{
    public function add(object $entity): void;
    public function flush(): void;
}