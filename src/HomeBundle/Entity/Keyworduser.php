<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keyworduser
 *
 * @ORM\Table(name="keywordUser", indexes={@ORM\Index(name="keyword_id", columns={"keyword_id"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="userIp_id", columns={"userIp_id"})})
 * @ORM\Entity
 */
class Keyworduser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keyworduserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="keywordUser_score", type="integer", nullable=false)
     */
    private $keyworduserScore;

    /**
     * @var \Keyword
     *
     * @ORM\ManyToOne(targetEntity="Keyword")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword_id", referencedColumnName="keyword_id")
     * })
     */
    private $keyword;

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
     * @var \Userip
     *
     * @ORM\ManyToOne(targetEntity="Userip")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userIp_id", referencedColumnName="userIp_id")
     * })
     */
    private $userip;



    /**
     * Get keyworduserId
     *
     * @return integer
     */
    public function getKeyworduserId()
    {
        return $this->keyworduserId;
    }

    /**
     * Set keyworduserScore
     *
     * @param integer $keyworduserScore
     *
     * @return Keyworduser
     */
    public function setKeyworduserScore($keyworduserScore)
    {
        $this->keyworduserScore = $keyworduserScore;

        return $this;
    }

    /**
     * Get keyworduserScore
     *
     * @return integer
     */
    public function getKeyworduserScore()
    {
        return $this->keyworduserScore;
    }

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keyworduser
     */
    public function setKeyword(\HomeBundle\Entity\Keyword $keyword = null)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return \HomeBundle\Entity\Keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Keyworduser
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
     * Set userip
     *
     * @param \HomeBundle\Entity\Userip $userip
     *
     * @return Keyworduser
     */
    public function setUserip(\HomeBundle\Entity\Userip $userip = null)
    {
        $this->userip = $userip;

        return $this;
    }

    /**
     * Get userip
     *
     * @return \HomeBundle\Entity\Userip
     */
    public function getUserip()
    {
        return $this->userip;
    }
}
