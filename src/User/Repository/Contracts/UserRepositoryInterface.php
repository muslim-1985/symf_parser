<?php
declare(strict_types=1);

namespace App\User\Repository\Contracts;

use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface extends PasswordUpgraderInterface
{
    public function saveUser(UserInterface $user): void;
}