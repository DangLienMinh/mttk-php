<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="playlist")
 */
class Playlist
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $Playlist_id;

    /**
     * @Column(type="string")
     */
    protected $Playlist_name;

    /**
     * @Column(type="string")
     */
    protected $Playlist_created_date;

    /**
     * @ManyToOne(targetEntity="user")
     **/
    protected $user_name;

    /**
     * @Column(type="string")
     */
    protected $Music_list;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     **/
    protected $privacy_type_id;

    public function getPlaylist_id()
    {
        return $this->Playlist_id;
    }
    
    public function setPlaylist_id($Playlist_id)
    {
        $this->Playlist_id = $Playlist_id;
        return $this;
    }
    public function getPlaylist_name()
    {
        return $this->Playlist_name;
    }
    
    public function setPlaylist_name($Playlist_name)
    {
        $this->Playlist_name = $Playlist_name;
        return $this;
    }
    public function getPlaylist_created_date()
    {
        return $this->Playlist_created_date;
    }
    
    public function setPlaylist_created_date($Playlist_created_date)
    {
        $this->Playlist_created_date = $Playlist_created_date;
        return $this;
    }
    public function getUser_name()
    {
        return $this->user_name;
    }
    
    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;
        return $this;
    }
    public function getMusic_list()
    {
        return $this->Music_list;
    }
    
    public function setMusic_list($Music_list)
    {
        $this->Music_list = $Music_list;
        return $this;
    }
    public function getPrivacy_type_id()
    {
        return $this->privacy_type_id;
    }
    
    public function setPrivacy_type_id($privacy_type_id)
    {
        $this->privacy_type_id = $privacy_type_id;
        return $this;
    }

	
}
?>