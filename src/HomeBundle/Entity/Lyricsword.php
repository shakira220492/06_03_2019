<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lyricsword
 *
 * @ORM\Table(name="lyricsWord", indexes={@ORM\Index(name="lyricsLine_id", columns={"lyricsLine_id"}), @ORM\Index(name="keyword_id", columns={"keyword_id"})})
 * @ORM\Entity
 */
class Lyricsword
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lyricsWord_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lyricswordId;

    /**
     * @var string
     *
     * @ORM\Column(name="lyricsWord_startTime", type="decimal", precision=10, scale=1, nullable=false)
     */
    private $lyricswordStarttime;

    /**
     * @var string
     *
     * @ORM\Column(name="lyricsWord_endTime", type="decimal", precision=10, scale=1, nullable=false)
     */
    private $lyricswordEndtime;

    /**
     * @var \Lyricsline
     *
     * @ORM\ManyToOne(targetEntity="Lyricsline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lyricsLine_id", referencedColumnName="lyricsLine_id")
     * })
     */
    private $lyricsline;

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
     * Get lyricswordId
     *
     * @return integer
     */
    public function getLyricswordId()
    {
        return $this->lyricswordId;
    }

    /**
     * Set lyricswordStarttime
     *
     * @param string $lyricswordStarttime
     *
     * @return Lyricsword
     */
    public function setLyricswordStarttime($lyricswordStarttime)
    {
        $this->lyricswordStarttime = $lyricswordStarttime;

        return $this;
    }

    /**
     * Get lyricswordStarttime
     *
     * @return string
     */
    public function getLyricswordStarttime()
    {
        return $this->lyricswordStarttime;
    }

    /**
     * Set lyricswordEndtime
     *
     * @param string $lyricswordEndtime
     *
     * @return Lyricsword
     */
    public function setLyricswordEndtime($lyricswordEndtime)
    {
        $this->lyricswordEndtime = $lyricswordEndtime;

        return $this;
    }

    /**
     * Get lyricswordEndtime
     *
     * @return string
     */
    public function getLyricswordEndtime()
    {
        return $this->lyricswordEndtime;
    }

    /**
     * Set lyricsline
     *
     * @param \HomeBundle\Entity\Lyricsline $lyricsline
     *
     * @return Lyricsword
     */
    public function setLyricsline(\HomeBundle\Entity\Lyricsline $lyricsline = null)
    {
        $this->lyricsline = $lyricsline;

        return $this;
    }

    /**
     * Get lyricsline
     *
     * @return \HomeBundle\Entity\Lyricsline
     */
    public function getLyricsline()
    {
        return $this->lyricsline;
    }

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Lyricsword
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
}
