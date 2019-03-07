<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Environmentandenvironmentkind
 *
 * @ORM\Table(name="environmentAndEnvironmentKind", indexes={@ORM\Index(name="environment_id", columns={"environment_id"}), @ORM\Index(name="environmentKind_id", columns={"environmentKind_id"})})
 * @ORM\Entity
 */
class Environmentandenvironmentkind
{
    /**
     * @var integer
     *
     * @ORM\Column(name="environmentAndEnvironmentKind_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $environmentandenvironmentkindId;

    /**
     * @var \Environmentkind
     *
     * @ORM\ManyToOne(targetEntity="Environmentkind")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="environmentKind_id", referencedColumnName="environmentKind_id")
     * })
     */
    private $environmentkind;

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
     * Get environmentandenvironmentkindId
     *
     * @return integer
     */
    public function getEnvironmentandenvironmentkindId()
    {
        return $this->environmentandenvironmentkindId;
    }

    /**
     * Set environmentkind
     *
     * @param \VideoBundle\Entity\Environmentkind $environmentkind
     *
     * @return Environmentandenvironmentkind
     */
    public function setEnvironmentkind(\VideoBundle\Entity\Environmentkind $environmentkind = null)
    {
        $this->environmentkind = $environmentkind;

        return $this;
    }

    /**
     * Get environmentkind
     *
     * @return \VideoBundle\Entity\Environmentkind
     */
    public function getEnvironmentkind()
    {
        return $this->environmentkind;
    }

    /**
     * Set environment
     *
     * @param \VideoBundle\Entity\Environment $environment
     *
     * @return Environmentandenvironmentkind
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
