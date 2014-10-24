<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="playlist_detail")
 */
class Playlist_detail
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $playlist_detail_id;

    /**
     * @ManyToOne(targetEntity="playlist")
     * @JoinColumn(name="Playlist_id", referencedColumnName="Playlist_id")
     **/
    protected $Playlist_id;

    /**
     * @Column(type="string")
     */
    protected $title;

    /**
     * @Column(type="string")
     */
    protected $music;

    public function getPlaylist_id()
    {
        return $this->Playlist_id;
    }
    
    public function setPlaylist_id($Playlist_id)
    {
        $this->Playlist_id = $Playlist_id;
        return $this;
    }

    public function getPlaylist_detail_id()
    {
        return $this->playlist_detail_id;
    }
    
    public function setPlaylist_detail_id($playlist_detail_id)
    {
        $this->playlist_detail_id = $playlist_detail_id;
        return $this;
    }
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    public function getMusic()
    {
        return $this->music;
    }
    
    public function setMusic($music)
    {
        $this->music = $music;
        return $this;
    }
    
}
?>