<?php

namespace Tracktus\AppBundle\Tests\Entity;

use Tracktus\AppBundle\Entity\Project;
use Tracktus\UserBundle\Entity\User;

class ProjectTest extends \PHPUnit_Framework_TestCase {

    private $project;
    public function setUp() {
        $this->project = new Project('Projet 1', 'Test project');
    }

    public function testGetters() {
        $this->assertEquals('Projet 1', $this->project->getName());
        $this->assertEquals('Test project', $this->project->getDescription());
        $this->assertEquals(new \DateTime(), $this->project->createdAt());
    }

    public function testGenericSetter()
    {
        $this->project->setName('Projet 2');
        $this->project->setDescription('Test Project 2');
        $this->assertEquals('Projet 2', $this->project->getName());
        $this->assertEquals('Test Project 2', $this->project->getDescription());
    }

    public function testManager()
    {
        $user = new User();
        $this->project->setManager($user);
        $this->assertEquals($user, $this->project->getManager());
    }

    public function testCreator()
    {
        $user = new User();
        $this->project->setCreator($user);
        $this->assertEquals($user, $this->project->getCreator());
    }

    public function testAddMember()
    {
        $user = new User();
        $this->project->addMember($user);
        $members = $this->project->getMembers();
        $this->assertContains($user, $members);
    }

    public function testIsMember()
    {
        $member = new User();
        $notAmember = new User();
        $this->project->addMember($member);
        $this->assertTrue($this->project->isMember($member));
        $this->assertFalse($this->project->isMember($notAmember));
    }

    public function testIsFinished()
    {
        $this->project->setFinished(true);
        $this->assertTrue($this->project->isFinished());
    }

    public function testSetFinishedThrowsExceptionOnNotBoolVariable()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $this->project->setFinished("dfghjk");
    }
}