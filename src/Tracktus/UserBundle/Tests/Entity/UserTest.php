<?php

namespace Tracktus\UserBundle\Tests;

use Tracktus\UserBundle\Entity\User;

/**
* 
*/
class UserTest extends \PHPUnit_Framework_TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
    }

    public function testExtendsFOSUser()
    {
        $this->assertInstanceOf('FOS\\UserBundle\Model\User', $this->user);
    }
}