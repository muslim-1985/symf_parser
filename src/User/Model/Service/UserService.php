<?php
declare(strict_types=1);

namespace App\User\Service;

use App\User\Repository\Contracts\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserInterface $user
     * @param string $ip
     * @param string $encodePassword
     */
    public function createUser(UserInterface $user, string $ip, string $encodePassword)
    {
        $user->setIp($ip);
        $user->setPassword($encodePassword);
        $em = $this->userRepository->_em;
        $em->persist($user);
        $em->flush();
    }
}