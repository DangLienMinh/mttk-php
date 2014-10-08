<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="notification_type")
 */
class Notification_type
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $noti_type;

    /**
     * @Column(type="string")
     */
    protected $name;

    public function getNoti_type()
    {
        return $this->noti_type;
    }
    
    public function setNoti_type($noti_type)
    {
        $this->noti_type = $noti_type;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
?>