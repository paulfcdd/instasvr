<?php 
namespace Instasaver\IndexEnBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements AdvancedUserInterface, \Serializable {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
	protected $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
	protected $username;
    /**
     * @ORM\Column(type="string", length=255)
     */
	protected $password;
	 /**
     * @ORM\Column(type="text") 
     */
	protected $userAbout;
	/**
     * @ORM\Column(type="string", length=3, options={"default":"en"})
     */
	protected $userLang;
	/**
	* @ORM\Column(type="string", length=255)
	*/
	protected $userAvatar;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

   /* /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
  //  public $name;

    public function __construct()
    {
        $this->isActive = true;
    }
	
	
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
     * Set email
     *
     * @param string $email
     *
     * @return Register
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
     * Set username
     *
     * @param string $username
     *
     * @return Register
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
	
	 public function getSalt()
    {
        return null;
    }
	
    /**
     * Set password
     *
     * @param string $password
     *
     * @return Register
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
	
	public function getRoles()
    {
        return array('ROLE_USER');
    }
	
	public function eraseCredentials()
    {
    }
	
	 public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function getAbsolutePath() {
        return null === $this->userAvatar
            ? null
            : $this->getUploadRootDir().'/'.$this->userAvatar;
    }

    public function getWebPath() {
        return null === $this->userAvatar
            ? null
            : $this->getUploadDir().'/'.$this->userAvatar;
    }

    protected function getUploadRootDir() {
        return __DIR__.'/../../../../web/'.$this->getUploadRootDir();
    }

    protected function getUploadDir() {
        return '/uploads/documents';
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
			$this->isActive
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
			$this->isActive
        ) = unserialize($serialized);
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set userAbout
     *
     * @param string $userAbout
     *
     * @return User
     */
    public function setUserAbout($userAbout)
    {
        $this->userAbout = $userAbout;

        return $this;
    }

    /**
     * Get userAbout
     *
     * @return string
     */
    public function getUserAbout()
    {
        return $this->userAbout;
    }

    /**
     * Set userLang
     *
     * @param string $userLang
     *
     * @return User
     */
    public function setUserLang($userLang)
    {
        $this->userLang = $userLang;

        return $this;
    }

    /**
     * Get userLang
     *
     * @return string
     */
    public function getUserLang()
    {
        return $this->userLang;
    }
	
	public function setUserAvatar($userAvatar) {
		
		return $this->userAvatar = $userAvatar;
		
		return $this;
	}
	
	public function getUserAvatar() {
		
		return $this->userAvatar;
	}

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
