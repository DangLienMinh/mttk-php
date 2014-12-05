<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Reportadmin extends \Entity\Reportadmin implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getReport_id()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["report_id"];
        }
        $this->__load();
        return parent::getReport_id();
    }

    public function setReport_id($report_id)
    {
        $this->__load();
        return parent::setReport_id($report_id);
    }

    public function getCreated_at()
    {
        $this->__load();
        return parent::getCreated_at();
    }

    public function setCreated_at($created_at)
    {
        $this->__load();
        return parent::setCreated_at($created_at);
    }

    public function getReason()
    {
        $this->__load();
        return parent::getReason();
    }

    public function setReason($reason)
    {
        $this->__load();
        return parent::setReason($reason);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getStatus_id()
    {
        $this->__load();
        return parent::getStatus_id();
    }

    public function setStatus_id($status_id)
    {
        $this->__load();
        return parent::setStatus_id($status_id);
    }

    public function getFanclub_id()
    {
        $this->__load();
        return parent::getFanclub_id();
    }

    public function setFanclub_id($fanclub_id)
    {
        $this->__load();
        return parent::setFanclub_id($fanclub_id);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'report_id', 'created_at', 'reason', 'email', 'status_id', 'fanclub_id');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}