<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersGroups
 */
class UsersGroups
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Entity\Users
     */
    private $user;

    /**
     * @var \Entity\Groups
     */
    private $group;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Entity\Users $user
     * @return UsersGroups
     */
    public function setUser(\Entity\Users $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \Entity\Groups $group
     * @return UsersGroups
     */
    public function setGroup(\Entity\Groups $group = null)
    {
        $this->group = $group;
    
        return $this;
    }

    /**
     * Get group
     *
     * @return \Entity\Groups 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
