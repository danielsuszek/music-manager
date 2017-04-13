<?php

namespace MusicManager\ManageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Song
 */
class Song
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $length;

    /**
     * @var integer
     */
    private $albumId;

    /**
     * @var Album
     */
    private $album;

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
     * Set title
     *
     * @param string $title
     * @return Song
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Song
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set albumId
     *
     * @param integer $albumId
     * @return Song
     */
    public function setAlbumId($albumId)
    {
        $this->albumId = $albumId;
    
        return $this;
    }

    /**
     * Get albumId
     *
     * @return integer 
     */
    public function getAlbumId()
    {
        return $this->albumId;
    }

    /**
     * Set album
     *
     * @param Album $album
     * @return Album
     */    
    public function setAlbum(Album $album) 
    {
        $this->album = $album;
        
        return $this;
    }
    
    /**
     * Get album
     *
     * @return Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
    
    public function addAlbum(Album $album)
{
    if (!$this->album->contains($album)) {
        $this->album->add($album);
    }
}

}
