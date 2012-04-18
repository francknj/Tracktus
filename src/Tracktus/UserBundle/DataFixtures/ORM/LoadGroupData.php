<?php

namespace Tracktus\UserBundle\DataFixtures\ORM;
use Tracktus\UserBundle\Entity\Group;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //Create group Member
        $memberGroup = new Group('Member');
        $memberGroup->addRole('USER_MEMBER');
        $this->addReference('member_group', $memberGroup);
        $manager->persist($memberGroup);

        //Create group ProjectLead
        $projectLeadGroup = new Group('Project Leader');
        $projectLeadGroup->addRole('USER_PROJECT_LEADER');
        $this->addReference('leader_group', $projectLeadGroup);
        $manager->persist($projectLeadGroup);

        //Create group supervisor
        $supervisorGroup = new Group('Supervisor');
        $supervisorGroup->addRole('USER_SUPERVISOR');
        $this->addReference('supervisor_group', $supervisorGroup);
        $manager->persist($supervisorGroup);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}