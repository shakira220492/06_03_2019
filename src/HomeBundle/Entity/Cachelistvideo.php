<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cachelistvideo
 *
 * @ORM\Table(name="cacheListVideo", indexes={@ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="cacheList_id", columns={"cacheList_id"})})
 * @ORM\Entity
 */
class Cachelistvideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cacheListVideo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cachelistvideoId;

    /**
     * @var \Cachelist
     *
     * @ORM\ManyToOne(targetEntity="Cachelist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cacheList_id", referencedColumnName="cacheList_id")
     * })
     */
    private $cachelist;

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
     * Get cachelistvideoId
     *
     * @return integer
     */
    public function getCachelistvideoId()
    {
        return $this->cachelistvideoId;
    }

    /**
     * Set cachelist
     *
     * @param \HomeBundle\Entity\Cachelist $cachelist
     *
     * @return Cachelistvideo
     */
    public function setCachelist(\HomeBundle\Entity\Cachelist $cachelist = null)
    {
        $this->cachelist = $cachelist;

        return $this;
    }

    /**
     * Get cachelist
     *
     * @return \HomeBundle\Entity\Cachelist
     */
    public function getCachelist()
    {
        return $this->cachelist;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Cachelistvideo
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
