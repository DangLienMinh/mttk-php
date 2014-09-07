<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="test")
 */
class Test
{
      /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string")
     */
    protected $name;


    public function getId()
    {
        return $this->id;
    }
     public function setName($username)
    {
        $this->name = $username;
    }

    public function getName()
    {
        return $this->name;
    }

}

?>