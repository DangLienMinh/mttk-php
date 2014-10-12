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
		$result = $sth->fetch();
		print_r($result);
	}

	public function themStatus($data)
	{
		$status = new Status;
	    $email = $this->em->getReference('Entity\User', $data['email']);
	    $privacy = $this->em->getReference('Entity\Privacy_type', (int)$data['privacy']);
	    $status->setPrivacy_type_id($privacy);
		$status->setEmail($email);
		$status->setThumbs_up(0);
		$status->setMessage( $data['status']);
		$status->setMusic( $data['music']);
		$this->em->persist($status);
		$this->em->flush();
	}
}
?>