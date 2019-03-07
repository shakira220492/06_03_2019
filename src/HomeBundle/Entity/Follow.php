<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 *
 * @ORM\Table(name="follow", indexes={@ORM\Index(name="follow_follower", columns={"follow_follower"}), @ORM\Index(name="follow_influencer", columns={"follow_influencer"})})
 * @ORM\Entity
 */
class Follow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="follow_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $followId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="follow_follower", referencedColumnName="user_id")
     * })
     */
    private $followFollower;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="follow_influencer", referencedColumnName="user_id")
     * })
     */
    private $followInfluencer;



    /**
     * Get followId
     *
     * @return integer
     */
    public function getFollowId()
    {
        return $this->followId;
    }

    /**
     * Set followFollower
     *
     * @param \HomeBundle\Entity\User $followFollower
     *
     * @return Follow
     */
    public function setFollowFollower(\HomeBundle\Entity\User $followFollower = null)
    {
        $this->followFollower = $followFollower;

        return $this;
    }

    /**
     * Get followFollower
     *
     * @return \HomeBundle\Entity\User
     */
    public function getFollowFollower()
    {
        return $this->followFollower;
    }

    /**
     * Set followInfluencer
     *
     * @param \HomeBundle\Entity\User $followInfluencer
     *
     * @return Follow
     */
    public function setFollowInfluencer(\HomeBundle\Entity\User $followInfluencer = null)
    {
        $this->followInfluencer = $followInfluencer;

        return $this;
    }

    /**
     * Get followInfluencer
     *
     * @return \HomeBundle\Entity\User
     */
    public function getFollowInfluencer()
    {
        return $this->followInfluencer;
    }
}
