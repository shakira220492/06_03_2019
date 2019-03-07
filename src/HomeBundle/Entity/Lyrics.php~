<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lyrics
 *
 * @ORM\Table(name="lyrics", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="environment_id", columns={"environment_id"})})
 * @ORM\Entity
 */
class Lyrics
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lyrics_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lyricsId;

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
     * Get lyricsId
     *
     * @return integer
     */
    public function getLyricsId()
    {
        return $this->lyricsId;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Lyrics
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

    /**
     * Set environment
     *
     * @param \HomeBundle\Entity\Environment $environment
     *
     * @return Lyrics
     */
    public function setEnvironment(\HomeBundle\Entity\Environment $environment = null)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * Get environment
     *
     * @return \HomeBundle\Entity\Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
