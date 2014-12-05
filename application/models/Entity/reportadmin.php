<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="reportadmin")
 */
class Reportadmin
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $report_id;

    /**
     * @Column(type="datetime")
     */
    protected $created_at;

    /**
     * @Column(type="string")
     */
    protected $reason;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

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

    public function getReport_id()
    {
        return $this->report_id;
    }
    
    public function setReport_id($report_id)
    {
        $this->report_id = $report_id;
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
    public function getReason()
    {
        return $this->reason;
    }
    
    public function setReason($reason)
    {
        $this->reason = $reason;
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