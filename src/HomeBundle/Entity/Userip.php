<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userip
 *
 * @ORM\Table(name="userIp")
 * @ORM\Entity
 */
class Userip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userIp_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $useripId;

    /**
     * @var string
     *
     * @ORM\Column(name="userIp_geolocalization", type="string", length=255, nullable=false)
     */
    private $useripGeolocalization;



    /**
     * Get useripId
     *
     * @return integer
     */
    public function getUseripId()
    {
        return $this->useripId;
    }

    /**
     * Set useripGeolocalization
     *
     * @param string $useripGeolocalization
     *
     * @return Userip
     */
    public function setUseripGeolocalization($useripGeolocalization)
    {
        $this->useripGeolocalization = $useripGeolocalization;

        return $this;
    }

    /**
     * Get useripGeolocalization
     *
     * @return string
     */
    public function getUseripGeolocalization()
    {
        return $this->useripGeolocalization;
    }
}
