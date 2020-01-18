<?php
declare(strict_types=1);

namespace App\User\Repository\Contracts;

use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

interface UserRepositoryInterface extends PasswordUpgraderInterface
{

}