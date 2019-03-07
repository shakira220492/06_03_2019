<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Optiondiv
 *
 * @ORM\Table(name="optionDiv", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Optiondiv
{
    /**
     * @var integer
     *
     * @ORM\Column(name="optionDiv_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $optiondivId;

    /**
     * @var string
     *
     * @ORM\Column(name="optionDiv_name", type="string", length=100, nullable=false)
     */
    private $optiondivName;

    /**
     * @var string
     *
     * @ORM\Column(name="optionDiv_status", type="string", length=100, nullable=false)
     */
    private $optiondivStatus;

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
     * Get optiondivId
     *
     * @return integer
     */
    public function getOptiondivId()
    {
        return $this->optiondivId;
    }

    /**
     * Set optiondivName
     *
     * @param string $optiondivName
     *
     * @return Optiondiv
     */
    public function setOptiondivName($optiondivName)
    {
        $this->optiondivName = $optiondivName;

        return $this;
    }

    /**
     * Get optiondivName
     *
     * @return string
     */
    public function getOptiondivName()
    {
        return $this->optiondivName;
    }

    /**
     * Set optiondivStatus
     *
     * @param string $optiondivStatus
     *
     * @return Optiondiv
     */
    public function setOptiondivStatus($optiondivStatus)
    {
        $this->optiondivStatus = $optiondivStatus;

        return $this;
    }

    /**
     * Get optiondivStatus
     *
     * @return string
     */
    public function getOptiondivStatus()
    {
        return $this->optiondivStatus;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Optiondiv
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
