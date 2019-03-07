<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Field
 *
 * @ORM\Table(name="field", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="layout_id", columns={"layout_id"})})
 * @ORM\Entity
 */
class Field
{
    /**
     * @var integer
     *
     * @ORM\Column(name="field_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fieldId;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=100, nullable=false)
     */
    private $fieldName;

    /**
     * @var string
     *
     * @ORM\Column(name="field_usualMode", type="string", length=25, nullable=false)
     */
    private $fieldUsualmode;

    /**
     * @var string
     *
     * @ORM\Column(name="field_currentMode", type="string", length=25, nullable=false)
     */
    private $fieldCurrentmode;

    /**
     * @var string
     *
     * @ORM\Column(name="field_icon", type="string", length=255, nullable=false)
     */
    private $fieldIcon;

    /**
     * @var string
     *
     * @ORM\Column(name="field_emergentWindow", type="string", length=255, nullable=false)
     */
    private $fieldEmergentwindow;

    /**
     * @var string
     *
     * @ORM\Column(name="field_contentWindow", type="string", length=255, nullable=false)
     */
    private $fieldContentwindow;

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
     * @var \Layout
     *
     * @ORM\ManyToOne(targetEntity="Layout")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="layout_id", referencedColumnName="layout_id")
     * })
     */
    private $layout;



    /**
     * Get fieldId
     *
     * @return integer
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     *
     * @return Field
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set fieldUsualmode
     *
     * @param string $fieldUsualmode
     *
     * @return Field
     */
    public function setFieldUsualmode($fieldUsualmode)
    {
        $this->fieldUsualmode = $fieldUsualmode;

        return $this;
    }

    /**
     * Get fieldUsualmode
     *
     * @return string
     */
    public function getFieldUsualmode()
    {
        return $this->fieldUsualmode;
    }

    /**
     * Set fieldCurrentmode
     *
     * @param string $fieldCurrentmode
     *
     * @return Field
     */
    public function setFieldCurrentmode($fieldCurrentmode)
    {
        $this->fieldCurrentmode = $fieldCurrentmode;

        return $this;
    }

    /**
     * Get fieldCurrentmode
     *
     * @return string
     */
    public function getFieldCurrentmode()
    {
        return $this->fieldCurrentmode;
    }

    /**
     * Set fieldIcon
     *
     * @param string $fieldIcon
     *
     * @return Field
     */
    public function setFieldIcon($fieldIcon)
    {
        $this->fieldIcon = $fieldIcon;

        return $this;
    }

    /**
     * Get fieldIcon
     *
     * @return string
     */
    public function getFieldIcon()
    {
        return $this->fieldIcon;
    }

    /**
     * Set fieldEmergentwindow
     *
     * @param string $fieldEmergentwindow
     *
     * @return Field
     */
    public function setFieldEmergentwindow($fieldEmergentwindow)
    {
        $this->fieldEmergentwindow = $fieldEmergentwindow;

        return $this;
    }

    /**
     * Get fieldEmergentwindow
     *
     * @return string
     */
    public function getFieldEmergentwindow()
    {
        return $this->fieldEmergentwindow;
    }

    /**
     * Set fieldContentwindow
     *
     * @param string $fieldContentwindow
     *
     * @return Field
     */
    public function setFieldContentwindow($fieldContentwindow)
    {
        $this->fieldContentwindow = $fieldContentwindow;

        return $this;
    }

    /**
     * Get fieldContentwindow
     *
     * @return string
     */
    public function getFieldContentwindow()
    {
        return $this->fieldContentwindow;
    }

    /**
     * Set user
     *
     * @param \VideoBundle\Entity\User $user
     *
     * @return Field
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
     * Set layout
     *
     * @param \VideoBundle\Entity\Layout $layout
     *
     * @return Field
     */
    public function setLayout(\VideoBundle\Entity\Layout $layout = null)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return \VideoBundle\Entity\Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }
}
