<?php


namespace App\Dependencies\Event\Dispatcher;


interface EventDispatcher
{
    public function dispatch(array $events): void;
}