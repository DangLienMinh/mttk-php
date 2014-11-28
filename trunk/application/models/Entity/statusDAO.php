<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class StatusDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function getStatus($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetStatus(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getNextStatus($email,$id)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetNextStatus(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $id);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function layDSWallStatus($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetUserWall(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function layDSFanclubStatus($fanclub)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetFanclubStatus(?)");
		$sth->bindValue(1, $fanclub);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function layDSNextWallStatus($email,$id)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetNextUserWall(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $id);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function laySingleStatus($status)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetSingleStatus(?)");
		$sth->bindValue(1, $status);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function GetFamousStatus($sdate,$edate)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetFamousStatus(?,?)");
		$sth->bindValue(1, $sdate);
		$sth->bindValue(2, $edate);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function themStatus($data)
	{
		$status = new Status;
	    $email = $this->em->getReference('Entity\User', $data['email']);
	    $privacy = $this->em->getReference('Entity\Privacy_type', (int)$data['privacy']);
	    $status->setPrivacy_type_id($privacy);
		$status->setEmail($email);
		$status->setTitle($data['title']);
		$status->setThumbs_up(0);
		$status->setMessage( $data['status']);
		$status->setMusic( $data['music']);
		$this->em->persist($status);
		$this->em->flush();
		return $status->getStatus_id();
	}

	public function themShareStatus($data)
	{
		$status = new Status;
		$shareStatus = $this->em->getReference('Entity\Status', $data['status']);
	    $email = $this->em->getReference('Entity\User', $data['email']);
	    $privacy = $this->em->getReference('Entity\Privacy_type', 1);
	    $status->setPrivacy_type_id($privacy);
		$status->setEmail($email);
		$status->setTitle($shareStatus->getTitle());
		$status->setThumbs_up(0);
		$status->setMessage( $data['message']);
		$status->setMusic( $shareStatus->getMusic());
		$this->em->persist($status);
		$this->em->flush();
		return $status->getStatus_id();
	}

	public function notifyShare($data){
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL notifyShare(?,?,?)");
		$sth->bindValue(1, $data['status']);
		$sth->bindValue(2, $data['newStatus']);
		$sth->bindValue(3, $data['email']);
		$sth->execute();
	}

	public function suaStatus($id,$msg)
	{
	    $status = $this->em->getReference('Entity\Status', $id);
	    $status->setMessage($msg);
		$this->em->merge($status);
		$this->em->flush();
	}

	public function xoaStatus($status,$linkUrl)
	{
	    $status = $this->em->getReference('Entity\Status', $status);
	    unlink($linkUrl.$status->getMusic());
	    $this->em->remove($status);
	    $this->em->flush();
	}
}
?>