<?php
namespace Tracktus\UserBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="groups")
*/
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * The group's id
     * @var integer
     */
    protected $id;

    /**
     * @{@inheritdoc}
     */
    public function __construct($name, $roles = array())
    {
        parent::__construct($name, $roles);
    }
}
