<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Environment
 *
 * @ORM\Table(name="environment", indexes={@ORM\Index(name="environment_parentId", columns={"environment_parentId"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Environment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="environment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $environmentId;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_iconImage", type="string", length=300, nullable=false)
     */
    private $environmentIconimage;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_areaWidth", type="string", length=255, nullable=false)
     */
    private $environmentAreawidth;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_areaHeight", type="string", length=255, nullable=false)
     */
    private $environmentAreaheight;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_areaBgColor", type="string", length=255, nullable=false)
     */
    private $environmentAreabgcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_menuWidth", type="string", length=255, nullable=false)
     */
    private $environmentMenuwidth;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_menuHeight", type="string", length=255, nullable=false)
     */
    private $environmentMenuheight;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_menuBgColor", type="string", length=255, nullable=false)
     */
    private $environmentMenubgcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_name", type="string", length=255, nullable=true)
     */
    private $environmentName;

    /**
     * @var string
     *
     * @ORM\Column(name="environment_description", type="string", length=255, nullable=true)
     */
    private $environmentDescription;

    /**
     * @var \Environment
     *
     * @ORM\ManyToOne(targetEntity="Environment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="environment_parentId", referencedColumnName="environment_id")
     * })
     */
    private $environmentParentid;

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
     * Get environmentId
     *
     * @return integer
     */
    public function getEnvironmentId()
    {
        return $this->environmentId;
    }

    /**
     * Set environmentIconimage
     *
     * @param string $environmentIconimage
     *
     * @return Environment
     */
    public function setEnvironmentIconimage($environmentIconimage)
    {
        $this->environmentIconimage = $environmentIconimage;

        return $this;
    }

    /**
     * Get environmentIconimage
     *
     * @return string
     */
    public function getEnvironmentIconimage()
    {
        return $this->environmentIconimage;
    }

    /**
     * Set environmentAreawidth
     *
     * @param string $environmentAreawidth
     *
     * @return Environment
     */
    public function setEnvironmentAreawidth($environmentAreawidth)
    {
        $this->environmentAreawidth = $environmentAreawidth;

        return $this;
    }

    /**
     * Get environmentAreawidth
     *
     * @return string
     */
    public function getEnvironmentAreawidth()
    {
        return $this->environmentAreawidth;
    }

    /**
     * Set environmentAreaheight
     *
     * @param string $environmentAreaheight
     *
     * @return Environment
     */
    public function setEnvironmentAreaheight($environmentAreaheight)
    {
        $this->environmentAreaheight = $environmentAreaheight;

        return $this;
    }

    /**
     * Get environmentAreaheight
     *
     * @return string
     */
    public function getEnvironmentAreaheight()
    {
        return $this->environmentAreaheight;
    }

    /**
     * Set environmentAreabgcolor
     *
     * @param string $environmentAreabgcolor
     *
     * @return Environment
     */
    public function setEnvironmentAreabgcolor($environmentAreabgcolor)
    {
        $this->environmentAreabgcolor = $environmentAreabgcolor;

        return $this;
    }

    /**
     * Get environmentAreabgcolor
     *
     * @return string
     */
    public function getEnvironmentAreabgcolor()
    {
        return $this->environmentAreabgcolor;
    }

    /**
     * Set environmentMenuwidth
     *
     * @param string $environmentMenuwidth
     *
     * @return Environment
     */
    public function setEnvironmentMenuwidth($environmentMenuwidth)
    {
        $this->environmentMenuwidth = $environmentMenuwidth;

        return $this;
    }

    /**
     * Get environmentMenuwidth
     *
     * @return string
     */
    public function getEnvironmentMenuwidth()
    {
        return $this->environmentMenuwidth;
    }

    /**
     * Set environmentMenuheight
     *
     * @param string $environmentMenuheight
     *
     * @return Environment
     */
    public function setEnvironmentMenuheight($environmentMenuheight)
    {
        $this->environmentMenuheight = $environmentMenuheight;

        return $this;
    }

    /**
     * Get environmentMenuheight
     *
     * @return string
     */
    public function getEnvironmentMenuheight()
    {
        return $this->environmentMenuheight;
    }

    /**
     * Set environmentMenubgcolor
     *
     * @param string $environmentMenubgcolor
     *
     * @return Environment
     */
    public function setEnvironmentMenubgcolor($environmentMenubgcolor)
    {
        $this->environmentMenubgcolor = $environmentMenubgcolor;

        return $this;
    }

    /**
     * Get environmentMenubgcolor
     *
     * @return string
     */
    public function getEnvironmentMenubgcolor()
    {
        return $this->environmentMenubgcolor;
    }

    /**
     * Set environmentName
     *
     * @param string $environmentName
     *
     * @return Environment
     */
    public function setEnvironmentName($environmentName)
    {
        $this->environmentName = $environmentName;

        return $this;
    }

    /**
     * Get environmentName
     *
     * @return string
     */
    public function getEnvironmentName()
    {
        return $this->environmentName;
    }

    /**
     * Set environmentDescription
     *
     * @param string $environmentDescription
     *
     * @return Environment
     */
    public function setEnvironmentDescription($environmentDescription)
    {
        $this->environmentDescription = $environmentDescription;

        return $this;
    }

    /**
     * Get environmentDescription
     *
     * @return string
     */
    public function getEnvironmentDescription()
    {
        return $this->environmentDescription;
    }

    /**
     * Set environmentParentid
     *
     * @param \HomeBundle\Entity\Environment $environmentParentid
     *
     * @return Environment
     */
    public function setEnvironmentParentid(\HomeBundle\Entity\Environment $environmentParentid = null)
    {
        $this->environmentParentid = $environmentParentid;

        return $this;
    }

    /**
     * Get environmentParentid
     *
     * @return \HomeBundle\Entity\Environment
     */
    public function getEnvironmentParentid()
    {
        return $this->environmentParentid;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Environment
     */
    public function setUser(\HomeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
