<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
  private const USER_REFERENCE = 'user';

  public function load(ObjectManager $manager): void
  {
    //create admin user
    $user = new User();
    $user->setEmail('adminEmail@email.com');
    $user->setPassword('adminPassword');
    $user->setRoles(['ROLE_ADMIN']);
    $manager->persist($user);

    $manager->flush();
  }
}
