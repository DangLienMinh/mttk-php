<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class StatusDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function layDSStatus($email)
	{
		// prepare statemen
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetStatus(?)");
		$sth->bindValue(1, $email);
		// execute and fetch
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function layDSWallStatus($email)
	{
		// prepare statemen
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetUserWall(?)");
		$sth->bindValue(1, $email);
		// execute and fetch
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function laySingleStatus($status)
	{
		// prepare statemen
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetSingleStatus(?)");
		$sth->bindValue(1, $status);
		// execute and fetch
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
	}
}
?>