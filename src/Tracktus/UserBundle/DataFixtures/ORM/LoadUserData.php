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
        //Get an userManager
        $userManager = $this->container->get('fos_user.user_manager');
        

        //Create a simple member account
        $user = new User();
        $user->setUserName('ali')->setEmail('user@foo.com')
            ->setPlainPassword('71SECRET');
        $user->setEnabled(true);
        $userManager->updatePassword($user);
        $manager->persist($user);

        //Create an admin account
        $projectLead = new User();
        $projectLead->setUserName('fred')->setEmail('fred@foo.com')
            ->setPlainPassword('71SECRET');
        $projectLead->setEnabled(true);
        $userManager->updatePassword($projectLead);
        $manager->persist($projectLead);

        //Create a supervisor
        $supervisor = new User();
        $supervisor->setUserName('yann')->setEmail('yann@foo.com')
            ->setPlainPassword('71SECRET');
        $supervisor->setEnabled(true);
        $userManager->updatePassword($supervisor);
        $manager->persist($supervisor);

        //Save in database
        $manager->flush();
    }
}