<?php

namespace MusicManager\ManageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 */
class Album
{        
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $released;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $rate;

    /**
     * @var string
     */
    private $sleevePicUrl;

    /**
     * @var integer
     */
    private $bandId;

    /*
     * @var string
     */
    private $uploadImageDir = '/Projects/music-manager/web/images/';

    /**
     * @var Band
     */
    private $band;

    /**
     * @var ArrayCollection
     */
    protected $songs;
    

    public function __construct() 
    {
        $this->songs = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set released
     *
     * @param integer $released
     * @return Album
     */
    public function setReleased($released)
    {
        $this->released = $released;
    
        return $this;
    }

    /**
     * Get released
     *
     * @return integer 
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Album
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return Album
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set sleevePicUrl
     *
     * @param string $sleevePicUrl
     * @return Album
     */
    public function setSleevePicUrl($sleevePicUrl)
    {
        $this->sleevePicUrl = $sleevePicUrl;
    
        return $this;
    }

    /**
     * Get sleevePicUrl
     *
     * @return string 
     */
    public function getSleevePicUrl()
    {        
        return $this->sleevePicUrl;
    }

    /**
     * Set bandId
     *
     * @param integer $bandId
     * @return Album
     */
    public function setBandId($bandId)
    {
        $this->bandId = $bandId;
    
        return $this;
    }

    /**
     * Get bandId
     *
     * @return integer 
     */
    public function getBandId()
    {
        return $this->bandId;
    }
    
    /**
     * Set band
     *
     * @param Band $band
     * @return Band
     */
    public function setBand(Band $band)
    {
        $this->band = $band;
    
        return $this;
    }

    /**
     * Get band
     *
     * @return Band
     */
    public function getBand()
    {
        return $this->band;
    }
    
    /**
     * Get songs
     *
     * @return ArrayCollection Song
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * Add songs
     *
     * @param Song
     */
    public function addSong(Song $song)
    {
        $song->setAlbum($this);
        $this->songs->add($song);
    }

    /**
     * Remove song
     *
     * @param Song
     */
    public function removeSong(Song $songs)
    {
        $this->songs->removeElement($songs);
    }

    
    /*
     * @return full path to sleeve picture
     */
    public function getFullPathToSleeve() 
    {
        $this->sleevePicUrl = empty($this->sleevePicUrl) ? 'brak-obrazka.jpg' : $this->sleevePicUrl;
        
        return 'http://' . $_SERVER['SERVER_NAME'] . $this->uploadImageDir . $this->sleevePicUrl;
    }
}