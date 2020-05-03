<?php
declare(strict_types=1);

namespace App\User\Event;

use App\User\Model\Entity\User\Email;
use App\User\Model\Entity\User\Id;
use App\User\Model\Entity\User\Name;

class UserEdited
{
    public Id $userId;
    public Name $name;
    public Email $email;

    public function __construct(Id $id, Name $name, Email $email)
    {
        $this->userId = $id;
        $this->name = $name;
        $this->email = $email;
    }
}