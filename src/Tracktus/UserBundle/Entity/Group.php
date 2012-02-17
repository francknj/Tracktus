<?php
namespace Tracktus\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * A group is a collection of roles assignable to a user
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group extends BaseGroup
{
    /**
     * The group's id
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Create a new group with specified roles
     * @param string $name  The name of the group
     * @param array  $roles An array of roles
     * 
     */
    public function __construct($name, $roles = array())
    {
        parent::__construct($name, $roles);
    }
}
