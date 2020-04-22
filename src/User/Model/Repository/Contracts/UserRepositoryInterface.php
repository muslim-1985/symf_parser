<?php


namespace App\User\Model\Repository\Contracts;


use App\Dependencies\Contracts\RepositoryInterface;
use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getByEmail(Email $email): User;
    public function hasByEmail(Email $email): bool;
}