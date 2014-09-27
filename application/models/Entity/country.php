<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="country")
 */
class Country
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $country_id;

    /**
     * @Column(type="string")
     */
    protected $country;

   public function getCountry_id()
   {
       return $this->country_id;
   }
   
   public function setCountry_id($country_id)
   {
       $this->country_id = $country_id;
       return $this;
   }
   public function getCountry()
   {
       return $this->country;
   }
   
   public function setCountry($country)
   {
       $this->country = $country;
       return $this;
   }
	
}
?>