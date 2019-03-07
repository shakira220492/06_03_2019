<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specificlistvideo
 *
 * @ORM\Table(name="specificListVideo", indexes={@ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="specificList_id", columns={"specificList_id"})})
 * @ORM\Entity
 */
class Specificlistvideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="specificListVideo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $specificlistvideoId;

    /**
     * @var \Specificlist
     *
     * @ORM\ManyToOne(targetEntity="Specificlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specificList_id", referencedColumnName="specificList_id")
     * })
     */
    private $specificlist;

    /**
     * @var \Video
     *
     * @ORM\ManyToOne(targetEntity="Video")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_id", referencedColumnName="video_id")
     * })
     */
    private $video;



    /**
     * Get specificlistvideoId
     *
     * @return integer
     */
    public function getSpecificlistvideoId()
    {
        return $this->specificlistvideoId;
    }

    /**
     * Set specificlist
     *
     * @param \HomeBundle\Entity\Specificlist $specificlist
     *
     * @return Specificlistvideo
     */
    public function setSpecificlist(\HomeBundle\Entity\Specificlist $specificlist = null)
    {
        $this->specificlist = $specificlist;

        return $this;
    }

    /**
     * Get specificlist
     *
     * @return \HomeBundle\Entity\Specificlist
     */
    public function getSpecificlist()
    {
        return $this->specificlist;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Specificlistvideo
     */
    public function setVideo(\HomeBundle\Entity\Video $video = null)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return \HomeBundle\Entity\Video
     */
    public function getVideo()
    {
        return $this->video;
    }
}
