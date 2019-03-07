<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Environmentkind
 *
 * @ORM\Table(name="environmentKind")
 * @ORM\Entity
 */
class Environmentkind
{
    /**
     * @var integer
     *
     * @ORM\Column(name="environmentKind_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $environmentkindId;

    /**
     * @var string
     *
     * @ORM\Column(name="environmentKind_name", type="string", length=255, nullable=false)
     */
    private $environmentkindName;

    /**
     * @var string
     *
     * @ORM\Column(name="environmentKind_description", type="string", length=255, nullable=false)
     */
    private $environmentkindDescription;



    /**
     * Get environmentkindId
     *
     * @return integer
     */
    public function getEnvironmentkindId()
    {
        return $this->environmentkindId;
    }

    /**
     * Set environmentkindName
     *
     * @param string $environmentkindName
     *
     * @return Environmentkind
     */
    public function setEnvironmentkindName($environmentkindName)
    {
        $this->environmentkindName = $environmentkindName;

        return $this;
    }

    /**
     * Get environmentkindName
     *
     * @return string
     */
    public function getEnvironmentkindName()
    {
        return $this->environmentkindName;
    }

    /**
     * Set environmentkindDescription
     *
     * @param string $environmentkindDescription
     *
     * @return Environmentkind
     */
    public function setEnvironmentkindDescription($environmentkindDescription)
    {
        $this->environmentkindDescription = $environmentkindDescription;

        return $this;
    }

    /**
     * Get environmentkindDescription
     *
     * @return string
     */
    public function getEnvironmentkindDescription()
    {
        return $this->environmentkindDescription;
    }
}
