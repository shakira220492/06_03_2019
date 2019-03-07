<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playpause
 *
 * @ORM\Table(name="playPause", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="environment_id", columns={"environment_id"})})
 * @ORM\Entity
 */
class Playpause
{
    /**
     * @var integer
     *
     * @ORM\Column(name="playPause_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $playpauseId;

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
     * @var \Environment
     *
     * @ORM\ManyToOne(targetEntity="Environment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="environment_id", referencedColumnName="environment_id")
     * })
     */
    private $environment;



    /**
     * Get playpauseId
     *
     * @return integer
     */
    public function getPlaypauseId()
    {
        return $this->playpauseId;
    }

    /**
     * Set user
     *
     * @param \VideoBundle\Entity\User $user
     *
     * @return Playpause
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

    /**
     * Set environment
     *
     * @param \VideoBundle\Entity\Environment $environment
     *
     * @return Playpause
     */
    public function setEnvironment(\VideoBundle\Entity\Environment $environment = null)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Get environment
     *
     * @return \VideoBundle\Entity\Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
