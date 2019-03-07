<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="video_id", columns={"video_id"})})
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="comment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commentId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_content", type="string", length=170, nullable=false)
     */
    private $commentContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_likes", type="integer", nullable=false)
     */
    private $commentLikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_dislikes", type="integer", nullable=false)
     */
    private $commentDislikes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="comment_creationDate", type="date", nullable=false)
     */
    private $commentCreationdate;

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
     * @var \Video
     *
     * @ORM\ManyToOne(targetEntity="Video")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_id", referencedColumnName="video_id")
     * })
     */
    private $video;



    /**
     * Get commentId
     *
     * @return integer
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set commentContent
     *
     * @param string $commentContent
     *
     * @return Comment
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;

        return $this;
    }

    /**
     * Get commentContent
     *
     * @return string
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Set commentLikes
     *
     * @param integer $commentLikes
     *
     * @return Comment
     */
    public function setCommentLikes($commentLikes)
    {
        $this->commentLikes = $commentLikes;

        return $this;
    }

    /**
     * Get commentLikes
     *
     * @return integer
     */
    public function getCommentLikes()
    {
        return $this->commentLikes;
    }

    /**
     * Set commentDislikes
     *
     * @param integer $commentDislikes
     *
     * @return Comment
     */
    public function setCommentDislikes($commentDislikes)
    {
        $this->commentDislikes = $commentDislikes;

        return $this;
    }

    /**
     * Get commentDislikes
     *
     * @return integer
     */
    public function getCommentDislikes()
    {
        return $this->commentDislikes;
    }

    /**
     * Set commentCreationdate
     *
     * @param \DateTime $commentCreationdate
     *
     * @return Comment
     */
    public function setCommentCreationdate($commentCreationdate)
    {
        $this->commentCreationdate = $commentCreationdate;

        return $this;
    }

    /**
     * Get commentCreationdate
     *
     * @return \DateTime
     */
    public function getCommentCreationdate()
    {
        return $this->commentCreationdate;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Comment
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

    /**
     * Set video
     *
     * @param \HomeBundle\Entity\Video $video
     *
     * @return Comment
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
