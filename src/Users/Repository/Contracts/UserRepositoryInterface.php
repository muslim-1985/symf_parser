<?php
declare(strict_types=1);

namespace App\Users\Repository\Contracts;

use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

interface UserRepositoryInterface extends PasswordUpgraderInterface
{

}