<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class reportadminDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

    public function getReportStatus()
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getReportStatus()");
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getReportFanclub()
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getReportFanclub()");
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	
	public function addReportStatus($data)
	{
		$report = new Reportadmin;
		$user = $this->em->getReference('Entity\User',$data['email']);
		$status = $this->em->getReference('Entity\Status',$data['status_id']);
		$report->setReason($data['reason']);
		$report->setEmail($user);
		$report->setStatus_id($status);
		$this->em->persist($report);
		$this->em->flush();
	}

	public function solvedUserReport($report_id)
	{
		$report = $this->em->getReference('Entity\Reportadmin', $report_id);
	    $this->em->remove($report);
	    $this->em->flush();
	}

	public function notifyCancelReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyCancelReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2,$user);
		$sth->execute();
	}

	public function notifyAcceptReport($status,$user){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyAcceptReport(?,?)");
		$sth->bindValue(1, $status);
		$sth->bindValue(2, $user);
		$sth->execute();
	}


	public function addReportFanclub($data)
	{
		$report = new Reportadmin;
		$user = $this->em->getReference('Entity\User',$data['email']);
		$fanclub = $this->em->getReference('Entity\Fanclub',$data['fanclub_id']);
		$report->setReason($data['reason']);
		$report->setEmail($user);
		$report->setFanclub_id($fanclub);
		$this->em->persist($report);
		$this->em->flush();
	}

	public function getDayNewStatus(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getDayNewStatus()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getDayNewUser(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getDayNewUser()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getDayNewFanclub(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getDayNewFanclub()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getUserGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getUserGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getFanclubGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getFanclubGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	public function getStatusGraph(){
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getStatusGraph()");
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
	}

	
}
/*$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL checkUserCreateGroup(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;*/
?>