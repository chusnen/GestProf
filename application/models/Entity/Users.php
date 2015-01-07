<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 */
class Users
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $activationCode;

    /**
     * @var string
     */
    private $forgottenPasswordCode;

    /**
     * @var integer
     */
    private $forgottenPasswordTime;

    /**
     * @var string
     */
    private $rememberCode;

    /**
     * @var integer
     */
    private $createdOn;

    /**
     * @var integer
     */
    private $lastLogin;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $phone;


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
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return Users
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    
        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Users
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set activationCode
     *
     * @param string $activationCode
     * @return Users
     */
    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
    
        return $this;
    }

    /**
     * Get activationCode
     *
     * @return string 
     */
    public function getActivationCode()
    {
        return $this->activationCode;
    }

    /**
     * Set forgottenPasswordCode
     *
     * @param string $forgottenPasswordCode
     * @return Users
     */
    public function setForgottenPasswordCode($forgottenPasswordCode)
    {
        $this->forgottenPasswordCode = $forgottenPasswordCode;
    
        return $this;
    }

    /**
     * Get forgottenPasswordCode
     *
     * @return string 
     */
    public function getForgottenPasswordCode()
    {
        return $this->forgottenPasswordCode;
    }

    /**
     * Set forgottenPasswordTime
     *
     * @param integer $forgottenPasswordTime
     * @return Users
     */
    public function setForgottenPasswordTime($forgottenPasswordTime)
    {
        $this->forgottenPasswordTime = $forgottenPasswordTime;
    
        return $this;
    }

    /**
     * Get forgottenPasswordTime
     *
     * @return integer 
     */
    public function getForgottenPasswordTime()
    {
        return $this->forgottenPasswordTime;
    }

    /**
     * Set rememberCode
     *
     * @param string $rememberCode
     * @return Users
     */
    public function setRememberCode($rememberCode)
    {
        $this->rememberCode = $rememberCode;
    
        return $this;
    }

    /**
     * Get rememberCode
     *
     * @return string 
     */
    public function getRememberCode()
    {
        return $this->rememberCode;
    }

    /**
     * Set createdOn
     *
     * @param integer $createdOn
     * @return Users
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return integer 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set lastLogin
     *
     * @param integer $lastLogin
     * @return Users
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    
        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return integer 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Users
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Users
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Users
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Users
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Users
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
