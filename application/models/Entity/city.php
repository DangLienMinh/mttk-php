<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="city")
 */
class City
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $city_id;

    /**
     * @ManyToOne(targetEntity="country")
     **/
    protected $country_id;

    /**
     * @Column(type="string")
     */
    protected $city;

    public function getCity_id()
    {
        return $this->city_id;
    }
    
    public function setCity_id($city_id)
    {
        $this->city_id = $city_id;
        return $this;
    }
    public function getCountry_id()
    {
        return $this->country_id;
    }
    
    public function setCountry_id($country_id)
    {
        $this->country_id = $country_id;
        return $this;
    }
    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
}
?>