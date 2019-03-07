<?php

namespace VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="video_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $videoId;

    /**
     * @var string
     *
     * @ORM\Column(name="video_name", type="string", length=100, nullable=false)
     */
    private $videoName;

    /**
     * @var string
     *
     * @ORM\Column(name="video_description", type="string", length=500, nullable=false)
     */
    private $videoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="video_image", type="string", length=255, nullable=false)
     */
    private $videoImage;

    /**
     * @var string
     *
     * @ORM\Column(name="video_content", type="string", length=255, nullable=false)
     */
    private $videoContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_amount_views", type="integer", nullable=false)
     */
    private $videoAmountViews;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_likes", type="integer", nullable=false)
     */
    private $videoLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="video_dislikes", type="integer", nullable=false)
     */
    private $videoDislikes;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="user_id")
     * })
     */
    private $idUser;



    /**
     * Get videoId
     *
     * @return integer
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Set videoName
     *
     * @param string $videoName
     *
     * @return Video
     */
    public function setVideoName($videoName)
    {
        $this->videoName = $videoName;

        return $this;
    }

    /**
     * Get videoName
     *
     * @return string
     */
    public function getVideoName()
    {
        return $this->videoName;
    }

    /**
     * Set videoDescription
     *
     * @param string $videoDescription
     *
     * @return Video
     */
    public function setVideoDescription($videoDescription)
    {
        $this->videoDescription = $videoDescription;

        return $this;
    }

    /**
     * Get videoDescription
     *
     * @return string
     */
    public function getVideoDescription()
    {
        return $this->videoDescription;
    }

    /**
     * Set videoImage
     *
     * @param string $videoImage
     *
     * @return Video
     */
    public function setVideoImage($videoImage)
    {
        $this->videoImage = $videoImage;

        return $this;
    }

    /**
     * Get videoImage
     *
     * @return string
     */
    public function getVideoImage()
    {
        return $this->videoImage;
    }

    /**
     * Set videoContent
     *
     * @param string $videoContent
     *
     * @return Video
     */
    public function setVideoContent($videoContent)
    {
        $this->videoContent = $videoContent;

        return $this;
    }

    /**
     * Get videoContent
     *
     * @return string
     */
    public function getVideoContent()
    {
        return $this->videoContent;
    }

    /**
     * Set videoAmountViews
     *
     * @param integer $videoAmountViews
     *
     * @return Video
     */
    public function setVideoAmountViews($videoAmountViews)
    {
        $this->videoAmountViews = $videoAmountViews;

        return $this;
    }

    /**
     * Get videoAmountViews
     *
     * @return integer
     */
    public function getVideoAmountViews()
    {
        return $this->videoAmountViews;
    }

    /**
     * Set videoLikes
     *
     * @param integer $videoLikes
     *
     * @return Video
     */
    public function setVideoLikes($videoLikes)
    {
        $this->videoLikes = $videoLikes;

        return $this;
    }

    /**
     * Get videoLikes
     *
     * @return integer
     */
    public function getVideoLikes()
    {
        return $this->videoLikes;
    }

    /**
     * Set videoDislikes
     *
     * @param integer $videoDislikes
     *
     * @return Video
     */
    public function setVideoDislikes($videoDislikes)
    {
        $this->videoDislikes = $videoDislikes;

        return $this;
    }

    /**
     * Get videoDislikes
     *
     * @return integer
     */
    public function getVideoDislikes()
    {
        return $this->videoDislikes;
    }

    /**
     * Set idUser
     *
     * @param \VideoBundle\Entity\User $idUser
     *
     * @return Video
     */
    public function setIdUser(\VideoBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \VideoBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
