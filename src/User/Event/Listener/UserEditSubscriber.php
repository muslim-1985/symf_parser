<?php
declare(strict_types=1);

namespace App\User\Event\Listener;


use App\User\Event\UserEdited;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserEditSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            UserEdited::class => [
                ['onUserEdited'],
            ]
        ];
    }

    public function onUserEdited(UserEdited $event): void
    {
        dump($event);
    }
}