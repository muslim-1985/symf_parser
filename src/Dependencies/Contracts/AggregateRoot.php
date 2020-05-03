<?php


namespace App\Dependencies\Contracts;


interface AggregateRoot
{
    public function releaseEvents(): array;
}