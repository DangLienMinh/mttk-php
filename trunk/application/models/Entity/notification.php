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
     * @ManyToOne(targetEntity="notification_type")
     * @JoinColumn(name="noti_type", referencedColumnName="noti_type")
     **/
    protected $type;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     * @JoinColumn(name="privacy_type_id", referencedColumnName="privacy_type_id")
     **/
    protected $privacy_type_id;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @Column(type="integer")
     */
    protected $is_read;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    /**
     * @ManyToOne(targetEntity="status")
     * @JoinColumn(name="status_id", referencedColumnName="status_id")
     **/
    protected $status_id;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="user_make_noti", referencedColumnName="email")
     **/
    protected $user_make_noti;


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
    public function getIs_read()
    {
        return $this->is_read;
    }
    
    public function setIs_read($is_read)
    {
        $this->is_read = $is_read;
        return $this;
    }

    public function getStatus_id()
    {
        return $this->status_id;
    }
    
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
        return $this;
    }
    public function getUser_make_noti()
    {
        return $this->user_make_noti;
    }

    public function setUser_make_noti($user_make_noti)
    {
        $this->user_make_noti = $user_make_noti;
        return $this;
    }
}
?>