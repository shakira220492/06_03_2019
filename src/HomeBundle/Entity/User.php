<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="city_id", columns={"city_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_profilePhoto", type="string", length=255, nullable=false)
     */
    private $userProfilephoto;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstGivenName", type="string", length=100, nullable=false)
     */
    private $userFirstgivenname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_secondGivenName", type="string", length=100, nullable=true)
     */
    private $userSecondgivenname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstFamilyName", type="string", length=100, nullable=false)
     */
    private $userFirstfamilyname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_secondFamilyName", type="string", length=100, nullable=true)
     */
    private $userSecondfamilyname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="text", length=65535, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_biography", type="text", length=65535, nullable=true)
     */
    private $userBiography;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;



    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userProfilephoto
     *
     * @param string $userProfilephoto
     *
     * @return User
     */
    public function setUserProfilephoto($userProfilephoto)
    {
        $this->userProfilephoto = $userProfilephoto;

        return $this;
    }

    /**
     * Get userProfilephoto
     *
     * @return string
     */
    public function getUserProfilephoto()
    {
        return $this->userProfilephoto;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userFirstgivenname
     *
     * @param string $userFirstgivenname
     *
     * @return User
     */
    public function setUserFirstgivenname($userFirstgivenname)
    {
        $this->userFirstgivenname = $userFirstgivenname;

        return $this;
    }

    /**
     * Get userFirstgivenname
     *
     * @return string
     */
    public function getUserFirstgivenname()
    {
        return $this->userFirstgivenname;
    }

    /**
     * Set userSecondgivenname
     *
     * @param string $userSecondgivenname
     *
     * @return User
     */
    public function setUserSecondgivenname($userSecondgivenname)
    {
        $this->userSecondgivenname = $userSecondgivenname;

        return $this;
    }

    /**
     * Get userSecondgivenname
     *
     * @return string
     */
    public function getUserSecondgivenname()
    {
        return $this->userSecondgivenname;
    }

    /**
     * Set userFirstfamilyname
     *
     * @param string $userFirstfamilyname
     *
     * @return User
     */
    public function setUserFirstfamilyname($userFirstfamilyname)
    {
        $this->userFirstfamilyname = $userFirstfamilyname;

        return $this;
    }

    /**
     * Get userFirstfamilyname
     *
     * @return string
     */
    public function getUserFirstfamilyname()
    {
        return $this->userFirstfamilyname;
    }

    /**
     * Set userSecondfamilyname
     *
     * @param string $userSecondfamilyname
     *
     * @return User
     */
    public function setUserSecondfamilyname($userSecondfamilyname)
    {
        $this->userSecondfamilyname = $userSecondfamilyname;

        return $this;
    }

    /**
     * Get userSecondfamilyname
     *
     * @return string
     */
    public function getUserSecondfamilyname()
    {
        return $this->userSecondfamilyname;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userBiography
     *
     * @param string $userBiography
     *
     * @return User
     */
    public function setUserBiography($userBiography)
    {
        $this->userBiography = $userBiography;

        return $this;
    }

    /**
     * Get userBiography
     *
     * @return string
     */
    public function getUserBiography()
    {
        return $this->userBiography;
    }

    /**
     * Set city
     *
     * @param \HomeBundle\Entity\City $city
     *
     * @return User
     */
    public function setCity(\HomeBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \HomeBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
