<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="fanclub")
 */
class Fanclub
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $fanclub_id;

    /**
     * @Column(type="string")
     */
    protected $fanclub_name;

    /**
     * @Column(type="string")
     */
    protected $fanclub_desc;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;
	
    public function getFanclub_id()
    {
        return $this->fanclub_id;
    }
    
    public function setFanclub_id($fanclub_id)
    {
        $this->fanclub_id = $fanclub_id;
        return $this;
    }
    public function getFanclub_name()
    {
        return $this->fanclub_name;
    }
    
    public function setFanclub_name($fanclub_name)
    {
        $this->fanclub_name = $fanclub_name;
        return $this;
    }
    public function getFanclub_desc()
    {
        return $this->fanclub_desc;
    }
    
    public function setFanclub_desc($fanclub_desc)
    {
        $this->fanclub_desc = $fanclub_desc;
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