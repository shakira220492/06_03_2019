<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Privilege
 *
 * @ORM\Table(name="privilege")
 * @ORM\Entity
 */
class Privilege
{
    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $privilegeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_reading", type="integer", nullable=false)
     */
    private $privilegeReading;

    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_deleting", type="integer", nullable=false)
     */
    private $privilegeDeleting;

    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_writing", type="integer", nullable=false)
     */
    private $privilegeWriting;



    /**
     * Get privilegeId
     *
     * @return integer
     */
    public function getPrivilegeId()
    {
        return $this->privilegeId;
    }

    /**
     * Set privilegeReading
     *
     * @param integer $privilegeReading
     *
     * @return Privilege
     */
    public function setPrivilegeReading($privilegeReading)
    {
        $this->privilegeReading = $privilegeReading;

        return $this;
    }

    /**
     * Get privilegeReading
     *
     * @return integer
     */
    public function getPrivilegeReading()
    {
        return $this->privilegeReading;
    }

    /**
     * Set privilegeDeleting
     *
     * @param integer $privilegeDeleting
     *
     * @return Privilege
     */
    public function setPrivilegeDeleting($privilegeDeleting)
    {
        $this->privilegeDeleting = $privilegeDeleting;

        return $this;
    }

    /**
     * Get privilegeDeleting
     *
     * @return integer
     */
    public function getPrivilegeDeleting()
    {
        return $this->privilegeDeleting;
    }

    /**
     * Set privilegeWriting
     *
     * @param integer $privilegeWriting
     *
     * @return Privilege
     */
    public function setPrivilegeWriting($privilegeWriting)
    {
        $this->privilegeWriting = $privilegeWriting;

        return $this;
    }

    /**
     * Get privilegeWriting
     *
     * @return integer
     */
    public function getPrivilegeWriting()
    {
        return $this->privilegeWriting;
    }
}
