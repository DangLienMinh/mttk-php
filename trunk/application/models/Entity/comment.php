<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="comment")
 */
class Comment
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $comment_id;

    /**
     * @Column(type="string")
     */
    protected $message;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ManyToOne(targetEntity="status")
     * @JoinColumn(name="status_id", referencedColumnName="status_id")
     **/
    protected $status_id;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="friend_name", referencedColumnName="email")
     **/
    protected $friend_name;

    public function getComment_id()
    {
        return $this->comment_id;
    }
    
    public function setComment_id($comment_id)
    {
        $this->comment_id = $comment_id;
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
    public function getStatus_id()
    {
        return $this->status_id;
    }
    
    public function setStatus_id($status_id)
    {
        $this->status_id = $status_id;
        return $this;
    }
    public function getFriend_name()
    {
        return $this->friend_name;
    }
    
    public function setFriend_name($friend_name)
    {
        $this->friend_name = $friend_name;
        return $this;
    }
	
}
?>