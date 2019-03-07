<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bluetooth
 *
 * @ORM\Table(name="bluetooth", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="environment_id", columns={"environment_id"})})
 * @ORM\Entity
 */
class Bluetooth
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bluetooth_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bluetoothId;

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
     * Get bluetoothId
     *
     * @return integer
     */
    public function getBluetoothId()
    {
        return $this->bluetoothId;
    }

    /**
     * Set user
     *
     * @param \VideoBundle\Entity\User $user
     *
     * @return Bluetooth
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
     * @return Bluetooth
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
