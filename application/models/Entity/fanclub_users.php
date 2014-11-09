<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="fanclub_users")
 */
class Fanclub_users
{
     /**
     * @Id
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

     /**
     * @Id
     * @ManyToOne(targetEntity="fanclub")
     * @JoinColumn(name="fanclub_id", referencedColumnName="fanclub_id")
     **/
    protected $fanclub_id;

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getFanclub_id()
    {
        return $this->fanclub_id;
    }
    
    public function setFanclub_id($fanclub_id)
    {
        $this->fanclub_id = $fanclub_id;
        return $this;
    }
}
?>