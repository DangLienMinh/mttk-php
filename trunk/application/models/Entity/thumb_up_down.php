<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="thumb_up_down")
 */
class Thumb_up_down
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $thumb_up_down_id;

    /**
     * @Column(type="integer")
     */
    protected $flag;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ManyToOne(targetEntity="status")
     **/
    protected $status_id;

    /**
     * @ManyToOne(targetEntity="user")
     **/
    protected $friend_name;

    public function getThumb_up_down_id()
    {
        return $this->thumb_up_down_id;
    }
    
    public function setThumb_up_down_id($thumb_up_down_id)
    {
        $this->thumb_up_down_id = $thumb_up_down_id;
        return $this;
    }
    public function getFlag()
    {
        return $this->flag;
    }
    
    public function setFlag($flag)
    {
        $this->flag = $flag;
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