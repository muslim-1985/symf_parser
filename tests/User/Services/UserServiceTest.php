<?php
declare(strict_types=1);

namespace App\Tests\User\Services;

use App\User\Entity\User;
use App\User\Repository\Contracts\UserRepositoryInterface;
use App\User\Repository\UserRepository;
use App\User\Service\UserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $mockUserRepo = $this->createMock(UserRepositoryInterface::class);
        $this->userService = new UserService($mockUserRepo);
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

    public function testPersistAndFlushUser()
    {

        $em = $this->createMock(EntityManagerInterface::class);

        $em->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(User::class));

        $mockUserRepo = $this->createMock(UserRepository::class);
        $mockUserRepo->expects($this->any())
            ->method('saveUser')
            ->with($this->user)
        ;

        $userService = new UserService($mockUserRepo);
        $ip = '123434kkkj';
        $encodePassword = 'ccc132243423';
        $userService->createUser($this->user, $ip, $encodePassword);
        $this->assertSame($encodePassword, $this->user->getPassword());
        $this->assertSame($ip, $this->user->getIp());
    }
}