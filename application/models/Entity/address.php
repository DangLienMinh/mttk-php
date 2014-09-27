<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="address")
 */
class Address
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $address_id;

    /**
     * @Column(type="string")
     */
    protected $address;

    /**
     * @ManyToOne(targetEntity="city")
     **/
    protected $city_id;

    /**
     * @ManyToOne(targetEntity="profile")
     **/
    protected $profile_id;

    public function getAddress_id()
    {
        return $this->address_id;
    }
    
    public function setAddress_id($address_id)
    {
        $this->address_id = $address_id;
        return $this;
    }
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    public function getCity_id()
    {
        return $this->city_id;
    }
    
    public function setCity_id($city_id)
    {
        $this->city_id = $city_id;
        return $this;
    }
    public function getProfile_id()
    {
        return $this->profile_id;
    }
    
    public function setProfile_id($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this;
    }
  	
}
?>