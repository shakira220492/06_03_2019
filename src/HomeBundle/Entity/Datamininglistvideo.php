<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Datamininglistvideo
 *
 * @ORM\Table(name="dataminingListVideo", indexes={@ORM\Index(name="video_id", columns={"video_id"}), @ORM\Index(name="dataminingList_id", columns={"dataminingList_id"})})
 * @ORM\Entity
 */
class Datamininglistvideo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dataminingListVideo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datamininglistvideoId;

    /**
     * @var \Datamininglist
     *
     * @ORM\ManyToOne(targetEntity="Datamininglist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dataminingList_id", referencedColumnName="dataminingList_id")
     * })
     */
    private $datamininglist;

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
     * Get datamininglistvideoId
     *
     * @return integer
     */
    public function getDatamininglistvideoId()
    {
        return $this->datamininglistvideoId;
    }

    /**
     * Set datamininglist
     *
     * @param \HomeBundle\Entity\Datamininglist $datamininglist
     *
     * @return Datamininglistvideo
     */
    public function setDatamininglist(\HomeBundle\Entity\Datamininglist $datamininglist = null)
    {
        $this->datamininglist = $datamininglist;

        return $this;
    }

    /**
     * Get datamininglist
     *
     * @return \HomeBundle\Entity\Datamininglist
     */
    public function getDatamininglist()
    {
        return $this->datamininglist;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Datamininglistvideo
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
