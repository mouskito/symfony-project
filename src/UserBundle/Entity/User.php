<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $loginCount = 0;

    public function __construct(){
        parent::__construct();
    }

    /**
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return User
     */
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;
        return $this;
    }
 
    /**
     * Get loginCount
     *
     * @return integer
     */
    public function getLoginCount()
    {
        return $this->loginCount;
    }
}

