<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="message")
 */
class Message
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $message_id;

    /**
     * @Column(type="string")
     */
    protected $message;

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
     * @JoinColumn(name="toUser", referencedColumnName="email")
     **/
    protected $toUser;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    public function getMessage_id()
    {
        return $this->message_id;
    }
    
    public function setMessage_id($message_id)
    {
        $this->message_id = $message_id;
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
    public function getCreated_at()
    {
        return $this->created_at;
    }
    
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
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
    public function getToUser()
    {
        return $this->toUser;
    }
    
    public function setToUser($toUser)
    {
        $this->toUser = $toUser;
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