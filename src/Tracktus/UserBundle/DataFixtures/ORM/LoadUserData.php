<?php

namespace Tracktus\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tracktus\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUserName('ali')->setEmail('user@foo.com')
            ->setPlainPassword('71SECRET');
        $user->setEnabled(true);
        $userManager = $this->container->get('fos_user.user_manager');
        $userManager->updatePassword($user);
        $manager->persist($user);
        $manager->flush();
    }
}