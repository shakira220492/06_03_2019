<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Layout
 *
 * @ORM\Table(name="layout", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Layout
{
    /**
     * @var integer
     *
     * @ORM\Column(name="layout_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $layoutId;

    /**
     * @var string
     *
     * @ORM\Column(name="layout_backgroundColor", type="string", length=255, nullable=false)
     */
    private $layoutBackgroundcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="layout_opacity", type="string", length=255, nullable=false)
     */
    private $layoutOpacity;

    /**
     * @var string
     *
     * @ORM\Column(name="layout_width", type="string", length=255, nullable=false)
     */
    private $layoutWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="layout_height", type="string", length=255, nullable=false)
     */
    private $layoutHeight;

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
     * Get layoutId
     *
     * @return integer
     */
    public function getLayoutId()
    {
        return $this->layoutId;
    }

    /**
     * Set layoutBackgroundcolor
     *
     * @param string $layoutBackgroundcolor
     *
     * @return Layout
     */
    public function setLayoutBackgroundcolor($layoutBackgroundcolor)
    {
        $this->layoutBackgroundcolor = $layoutBackgroundcolor;

        return $this;
    }

    /**
     * Get layoutBackgroundcolor
     *
     * @return string
     */
    public function getLayoutBackgroundcolor()
    {
        return $this->layoutBackgroundcolor;
    }

    /**
     * Set layoutOpacity
     *
     * @param string $layoutOpacity
     *
     * @return Layout
     */
    public function setLayoutOpacity($layoutOpacity)
    {
        $this->layoutOpacity = $layoutOpacity;

        return $this;
    }

    /**
     * Get layoutOpacity
     *
     * @return string
     */
    public function getLayoutOpacity()
    {
        return $this->layoutOpacity;
    }

    /**
     * Set layoutWidth
     *
     * @param string $layoutWidth
     *
     * @return Layout
     */
    public function setLayoutWidth($layoutWidth)
    {
        $this->layoutWidth = $layoutWidth;

        return $this;
    }

    /**
     * Get layoutWidth
     *
     * @return string
     */
    public function getLayoutWidth()
    {
        return $this->layoutWidth;
    }

    /**
     * Set layoutHeight
     *
     * @param string $layoutHeight
     *
     * @return Layout
     */
    public function setLayoutHeight($layoutHeight)
    {
        $this->layoutHeight = $layoutHeight;

        return $this;
    }

    /**
     * Get layoutHeight
     *
     * @return string
     */
    public function getLayoutHeight()
    {
        return $this->layoutHeight;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Layout
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
