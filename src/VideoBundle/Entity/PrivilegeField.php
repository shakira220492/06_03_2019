<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrivilegeField
 *
 * @ORM\Table(name="privilege_field", indexes={@ORM\Index(name="privilege_id", columns={"privilege_id"}), @ORM\Index(name="field_id", columns={"field_id"})})
 * @ORM\Entity
 */
class PrivilegeField
{
    /**
     * @var integer
     *
     * @ORM\Column(name="privilege_field", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $privilegeField;

    /**
     * @var \Field
     *
     * @ORM\ManyToOne(targetEntity="Field")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_id", referencedColumnName="field_id")
     * })
     */
    private $field;

    /**
     * @var \Privilege
     *
     * @ORM\ManyToOne(targetEntity="Privilege")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="privilege_id", referencedColumnName="privilege_id")
     * })
     */
    private $privilege;



    /**
     * Get privilegeField
     *
     * @return integer
     */
    public function getPrivilegeField()
    {
        return $this->privilegeField;
    }

    /**
     * Set field
     *
     * @param \VideoBundle\Entity\Field $field
     *
     * @return PrivilegeField
     */
    public function setField(\VideoBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \VideoBundle\Entity\Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set privilege
     *
     * @param \VideoBundle\Entity\Privilege $privilege
     *
     * @return PrivilegeField
     */
    public function setPrivilege(\VideoBundle\Entity\Privilege $privilege = null)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return \VideoBundle\Entity\Privilege
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }
}
