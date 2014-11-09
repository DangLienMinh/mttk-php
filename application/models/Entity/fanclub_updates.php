<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="fanclub_updates")
 */
class Fanclub_updates
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $fanclub_update_id;

   /**
     * @ManyToOne(targetEntity="status")
     * @JoinColumn(name="status_id", referencedColumnName="status_id")
     **/
    protected $status_id;

    /**
     * @ManyToOne(targetEntity="fanclub")
     * @JoinColumn(name="fanclub_id", referencedColumnName="fanclub_id")
     **/
    protected $fanclub_id;

    public function getFanclub_update_id()
    {
        return $this->fanclub_update_id;
    }
    
    public function setFanclub_update_id($fanclub_update_id)
    {
        $this->fanclub_update_id = $fanclub_update_id;
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