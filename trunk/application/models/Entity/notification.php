<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="notification")
 */
class Notification
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $notification_id;

    /**
     * @Column(type="string")
     */
    protected $msg;

    /**
     * @Column(type="integer")
     */
    protected $type;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     **/
    protected $privacy_type_id;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ManyToOne(targetEntity="user")
     **/
    protected $email;

    public function getNotification_id()
    {
        return $this->notification_id;
    }
    
    public function setNotification_id($notification_id)
    {
        $this->notification_id = $notification_id;
        return $this;
    }
    public function getMsg()
    {
        return $this->msg;
    }
    
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
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
    public function getCreated_at()
    {
        return $this->created_at;
    }
    
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
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