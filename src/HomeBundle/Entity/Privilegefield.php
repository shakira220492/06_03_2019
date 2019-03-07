<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Privilegefield
 *
 * @ORM\Table(name="privilegeField", indexes={@ORM\Index(name="privilege_id", columns={"privilege_id"}), @ORM\Index(name="field_id", columns={"field_id"})})
 * @ORM\Entity
 */
class Privilegefield
{
    /**
     * @var integer
     *
     * @ORM\Column(name="privilegeField_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $privilegefieldId;

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
     * Get privilegefieldId
     *
     * @return integer
     */
    public function getPrivilegefieldId()
    {
        return $this->privilegefieldId;
    }

    /**
     * Set field
     *
     * @param \HomeBundle\Entity\Field $field
     *
     * @return Privilegefield
     */
    public function setField(\HomeBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \HomeBundle\Entity\Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set privilege
     *
     * @param \HomeBundle\Entity\Privilege $privilege
     *
     * @return Privilegefield
     */
    public function setPrivilege(\HomeBundle\Entity\Privilege $privilege = null)
    {
        $this->privilege = $privilege;

        return $this;
    }

    /**
     * Get privilege
     *
     * @return \HomeBundle\Entity\Privilege
     */
    public function getPrivilege()
    {
        return $this->privilege;
    }
}
