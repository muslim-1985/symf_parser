<?php


namespace App\Event\Dispatcher;


interface EventDispatcher
{
    public function dispatch(array $events): void;
}