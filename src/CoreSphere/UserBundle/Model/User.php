<?php

namespace CoreSphere\UserBundle\Model;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements AdvancedUserInterface
{
	const ROLE_DEFAULT = 'ROLE_USER';

	protected $id;

	protected $username;

	protected $password;

	protected $salt;

	protected $plainPassword;

	protected $email;

    protected $createdAt;

    protected $updatedAt;

	protected $enabled;

	protected $locked;

    protected $expires;

    protected $expiresAt;

    protected $roles;

    protected $confirmationToken;

    protected $description;

	public function __construct()
	{
		$this->salt = base_convert(sha1(uniqid(mt_rand(), TRUE)), 16, 36);

		$this->enabled = true;
	    $this->locked = false;
        $this->roles = array();
        $this->expires = false;
        $this->expiresAt = new \DateTime('+ 4 weeks');

		$this->createdAt = $this->updatedAt = new \DateTime("now");
	}


    public function updated()
    {
        $this->updatedAt = new \DateTime("now");
    }

    public function updatedAt()
    {
        return $this->updatedAt;
    }

    public function createdAt()
    {
        return $this->createdAt;
    }

	public function getId()
	{
		return $this->id;
	}


	public function getRoles()
	{
		$roles = $this->roles;

		$roles[] = self::ROLE_DEFAULT;
		$roles[] = 'ROLE_SHOW_USER';
		$roles[] = 'ROLE_LIST_USER';

		if($this->id===1) {
		    $roles[] = 'ROLE_CREATE_USER';
    	    $roles[] = 'ROLE_UPDATE_USER';
		}

		return $roles;
	}


	public function setPassword($password)
	{
		$this->password = $password;
	}


	public function getPassword()
	{
		return $this->password;
	}


	public function getSalt()
	{
		return $this->salt;
	}


	public function getUsername()
	{
		return $this->username;
	}


	public function setUsername($username)
	{
		$this->username = $username;
	}


	public function setPlainPassword($plainPassword)
	{
		$this->plainPassword = $plainPassword;
	}


	public function getPlainPassword()
	{
		return $this->plainPassword;
	}


	public function getEmail()
	{
		return $this->email;
	}


	public function setEmail($email)
	{
		$this->email = $email;
	}


	public function eraseCredentials()
	{
		$this->plainPassword = NULL;
	}


	public function equals(UserInterface $user)
	{
		if($this->username !== $user->getUsername())
		{
			return FALSE;
		}
		if($this->password !== $user->getPassword())
		{
			return FALSE;
		}


		return TRUE;
	}


	public function isAccountNonExpired()
	{

        if (TRUE === $this->expires && $this->expiresAt->getTimestamp() < time()) {
            return FALSE;
        }


        return TRUE;
	}

    public function setExpiresAt(\DateTime $date = NULL)
    {
        $this->expiresAt = $date;
    }

	public function getExpiresAt()
    {
        return $this->expiresAt;
    }


	public function isAccountNonLocked()
	{
		return !$this->locked;
	}


	public function isLocked()
	{
		return $this->locked;
	}


	public function setLocked($bool)
	{
		$this->locked = (bool)$bool;
	}


	public function isCredentialsNonExpired()
	{
		return TRUE;
	}


	public function isEnabled()
	{
		return $this->enabled;
	}


	public function setEnabled($bool)
	{
		$this->enabled = (bool)$bool;
	}

	public function getExpires()
	{
		return $this->expires;
	}


	public function setExpires($bool)
	{
		$this->expires = (bool)$bool;
	}


	public function getDescription()
	{
		return $this->description;
	}


	public function setDescription($description) {
		$this->description = $description;
	}



}