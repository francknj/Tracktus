<?php

namespace Tracktus\UserBundle\Tests\Entity;

use Tracktus\UserBundle\Entity\Group;

/**
* 
*/
class GroupTest extends \PHPUnit_Framework_TestCase
{
    private $group;

    public function setUp()
    {
        $this->group = new Group('Admin', array('ROLE_USER'));
    }

    public function testExtendsFOSGroup()
    {
        $this->assertInstanceOf('FOS\\UserBundle\\Model\\Group', $this->group);
    }
}
