<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="chat")
 */
class Chat
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $chat_id;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $to;

    /**
     * @Column(type="string")
     */
    protected $msg;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    public function getChat_id()
    {
        return $this->chat_id;
    }
    
    public function setChat_id($chat_id)
    {
        $this->chat_id = $chat_id;
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
    public function getTo()
    {
        return $this->to;
    }
    
    public function setTo($to)
    {
        $this->to = $to;
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
    public function getCreated_at()
    {
        return $this->created_at;
    }
    
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }
	
}
?>