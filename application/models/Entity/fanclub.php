<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="fanclub")
 */
class FanClub
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $FanClub_id;

    /**
     * @Column(type="string")
     */
    protected $FanClubName;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     **/
    protected $privacy_type_id;

    /**
     * @Column(type="string")
     */
    protected $Description;

    /**
     * @Column(type="string")
     */
    protected $Picture;

    /**
     * @ManyToOne(targetEntity="user")
     **/
    protected $email;
   
	  
    public function getFanClub_id()
    {
        return $this->FanClubName;
    }
    
    public function setFanClub_id($FanClub_id)
    {
        $this->FanClub_id = $FanClub_id;
        return $this;
    }
    public function getFanClubName()
    {
        return $this->FanClubName;
    }
    
    public function setFanClubName($FanClubName)
    {
        $this->FanClubName = $FanClubName;
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
    public function getDescription()
    {
        return $this->Description;
    }
    
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }
    public function getPicture()
    {
        return $this->Picture;
    }
    
    public function setPicture($Picture)
    {
        $this->Picture = $Picture;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
?>