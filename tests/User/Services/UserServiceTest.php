<?php
declare(strict_types=1);

namespace App\Tests\User\Services;

use App\Tests\User\NullObjects\UserRepository;
use App\User\Entity\User;
use App\User\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService(new UserRepository());
        $this->user = new User();
    }

    public function testCreateUser()
    {
        $ip = '123434kkkj';
        $encodePassword = 'ccc132243423';
        $this->userService->createUser($this->user, $ip, $encodePassword);
        $this->assertSame($encodePassword, $this->user->getPassword());
        $this->assertSame($ip, $this->user->getIp());
    }
}