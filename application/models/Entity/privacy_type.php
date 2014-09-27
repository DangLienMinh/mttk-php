<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="privacy_type")
 */
class Privacy_type
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $privacy_type_id;

    /**
     * @Column(type="string")
     */
    protected $name;

    public function getPrivacy_type_id()
    {
        return $this->privacy_type_id;
    }
    
    public function setPrivacy_type_id($privacy_type_id)
    {
        $this->privacy_type_id = $privacy_type_id;
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