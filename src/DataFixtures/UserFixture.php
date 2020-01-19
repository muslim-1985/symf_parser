<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\User\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @param ObjectManager $manager
     */
    protected function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'main_user', function(int $i): User {
            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));
            $user->setEmail(sprintf('user%d@example.com', $i));
            $user->setName($this->faker->firstName);
            $user->setIp($this->faker->ipv4);
            return $user;
        });
        $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));
            $user->setEmail(sprintf('admin%d@example.com', $i));
            $user->setName($this->faker->firstName);
            $user->setIp($this->faker->ipv4);
            $user->setRoles(['ROLE_ADMIN']);
            return $user;
        });
    }
}
