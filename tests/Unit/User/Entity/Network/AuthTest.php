<?php

declare(strict_types=1);

namespace App\Tests\Unit\User\Entity\Network;

use App\User\Model\Entity\User\Id;
use App\User\Model\Entity\User\Name;
use App\User\Model\Entity\User\Network;
use App\User\Model\Entity\User\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::signUpByNetwork(
            $id = Id::next(),
            $date = new \DateTimeImmutable(),
            $name = new Name('First', 'Last'),
            $network = 'vk',
            $identity = '0000001'
        );

        self::assertTrue($user->isActive());

        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($name, $user->getName());

        self::assertCount(1, $networks = $user->getNetworks());
        self::assertInstanceOf(Network::class, $first = reset($networks));
        self::assertEquals($network, $first->getNetwork());
        self::assertEquals($identity, $first->getIdentity());
    }
}
