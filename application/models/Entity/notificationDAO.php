<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class NotificationDAO
{
	private $em;
	function __construct($em){
       $this->em=$em;
    }

	public function getNewNotify($email)
	{
		// prepare statement
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetNewNotify(?)");
		$sth->bindValue(1, $email);
		// execute and fetch
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getOldNotify($email)
	{
		// prepare statement
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetOldNotify(?)");
		$sth->bindValue(1, $email);
		// execute and fetch
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getNextOldNotify($email,$id)
	{
		// prepare statement
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetNextOldNotify(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $id);
		// execute and fetch
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function setNotifyIsRead($notification_id)
	{
		// prepare statement
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL setNotifyIsRead(?)");
		$sth->bindValue(1, $notification_id);
		// execute and fetch
		$sth->execute();
	}

	public function setOffNotify($email)
	{
		// prepare statement
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL setOffNotify(?)");
		$sth->bindValue(1, $email);
		// execute and fetch
		$sth->execute();
	}
}
?>