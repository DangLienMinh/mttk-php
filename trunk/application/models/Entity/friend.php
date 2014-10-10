<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="friend")
 */
class Friend
{
     /**
     * @Id
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="friend_name", referencedColumnName="email")
     */
    protected $friend_name;

    /**
     * @Column(type="integer")
     */
    protected $is_subscriber;

    /**
     * @Column(type="integer")
     */
    protected $accept;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @Id
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     */
    protected $email;

    public function getFriend_name()
    {
        return $this->friend_name;
    }
    
    public function setFriend_name($friend_name)
    {
        $this->friend_name = $friend_name;
        return $this;
    }
    public function getIs_subscriber()
    {
        return $this->is_subscriber;
    }
    
    public function setIs_subscriber($is_subscriber)
    {
        $this->is_subscriber = $is_subscriber;
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
	public function getAccept()
    {
        return $this->accept;
    }
    
    public function setAccept($accept)
    {
        $this->accept = $accept;
        return $this;
    }
}
?>