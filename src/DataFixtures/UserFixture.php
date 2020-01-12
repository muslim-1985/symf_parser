<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Users\Entity\Users;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    /**
     * @param ObjectManager $manager
     */
    protected function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'main_user', function(int $i): Users {
            $user = new Users();
            $user->setEmail(sprintf('spacebar%d@example.com', $i));
            $user->setName($this->faker->firstName);
            $user->setIp($this->faker->ipv4);
            $user->setPassword($this->faker->password);
            return $user;
        });
    }
}
