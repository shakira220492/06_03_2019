<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 *
 * @ORM\Table(name="logIn", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Login
{
    /**
     * @var integer
     *
     * @ORM\Column(name="logIn_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $loginId;

    /**
     * @var string
     *
     * @ORM\Column(name="logIn_hour", type="string", length=255, nullable=false)
     */
    private $loginHour;

    /**
     * @var string
     *
     * @ORM\Column(name="logIn_geolocalization", type="string", length=255, nullable=false)
     */
    private $loginGeolocalization;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get loginId
     *
     * @return integer
     */
    public function getLoginId()
    {
        return $this->loginId;
    }

    /**
     * Set loginHour
     *
     * @param string $loginHour
     *
     * @return Login
     */
    public function setLoginHour($loginHour)
    {
        $this->loginHour = $loginHour;

        return $this;
    }

    /**
     * Get loginHour
     *
     * @return string
     */
    public function getLoginHour()
    {
        return $this->loginHour;
    }

    /**
     * Set loginGeolocalization
     *
     * @param string $loginGeolocalization
     *
     * @return Login
     */
    public function setLoginGeolocalization($loginGeolocalization)
    {
        $this->loginGeolocalization = $loginGeolocalization;

        return $this;
    }

    /**
     * Get loginGeolocalization
     *
     * @return string
     */
    public function getLoginGeolocalization()
    {
        return $this->loginGeolocalization;
    }

    /**
     * Set user
     *
     * @param \VideoBundle\Entity\User $user
     *
     * @return Login
     */
    public function setUser(\VideoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \VideoBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
