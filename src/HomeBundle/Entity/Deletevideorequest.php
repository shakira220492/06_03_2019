<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Deletevideorequest
 *
 * @ORM\Table(name="deleteVideoRequest", indexes={@ORM\Index(name="video_id", columns={"video_id"})})
 * @ORM\Entity
 */
class Deletevideorequest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="deleteVideoRequest_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deletevideorequestId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleteVideoRequest_dateToDelete", type="date", nullable=false)
     */
    private $deletevideorequestDatetodelete;

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
     * Get deletevideorequestId
     *
     * @return integer
     */
    public function getDeletevideorequestId()
    {
        return $this->deletevideorequestId;
    }

    /**
     * Set deletevideorequestDatetodelete
     *
     * @param \DateTime $deletevideorequestDatetodelete
     *
     * @return Deletevideorequest
     */
    public function setDeletevideorequestDatetodelete($deletevideorequestDatetodelete)
    {
        $this->deletevideorequestDatetodelete = $deletevideorequestDatetodelete;

        return $this;
    }

    /**
     * Get deletevideorequestDatetodelete
     *
     * @return \DateTime
     */
    public function getDeletevideorequestDatetodelete()
    {
        return $this->deletevideorequestDatetodelete;
    }

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Deletevideorequest
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
