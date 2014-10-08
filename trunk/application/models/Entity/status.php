<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="status")
 */
class Status
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $status_id;

    /**
     * @Column(type="string")
     */
    protected $message;

    /**
     * @Column(type="string")
     */
    protected $music;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;
    
    /**
     * @Column(type="integer")
     */
    protected $thumbs_up;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     * @JoinColumn(name="privacy_type_id", referencedColumnName="privacy_type_id")
     **/
    protected $privacy_type_id;


    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    public function getStatus_id()
    {
        return $this->status_id;
    }
    
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setMessage($message)
    {
        $this->message = $message;
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
    public function getCreated_at()
    {
        return $this->created_at;
    }
    
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }
    public function getThumbs_up()
    {
        return $this->thumbs_up;
    }
    
    public function setThumbs_up($thumbs_up)
    {
        $this->thumbs_up = $thumbs_up;
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