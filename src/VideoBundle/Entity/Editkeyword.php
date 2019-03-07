<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editkeyword
 *
 * @ORM\Table(name="editKeyword", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="environment_id", columns={"environment_id"})})
 * @ORM\Entity
 */
class Editkeyword
{
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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Environment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="editKeyword_id", referencedColumnName="environment_id")
     * })
     */
    private $editkeyword;

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
     * Set user
     *
     * @param \VideoBundle\Entity\User $user
     *
     * @return Editkeyword
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
     * Set editkeyword
     *
     * @param \VideoBundle\Entity\Environment $editkeyword
     *
     * @return Editkeyword
     */
    public function setEditkeyword(\VideoBundle\Entity\Environment $editkeyword)
    {
        $this->editkeyword = $editkeyword;

        return $this;
    }

    /**
     * Get editkeyword
     *
     * @return \VideoBundle\Entity\Environment
     */
    public function getEditkeyword()
    {
        return $this->editkeyword;
    }

    /**
     * Set environment
     *
     * @param \VideoBundle\Entity\Environment $environment
     *
     * @return Editkeyword
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
