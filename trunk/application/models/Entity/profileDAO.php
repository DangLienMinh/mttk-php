<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class ProfileDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function themProfile($data)
	{
		// prepare statemen
		//echo $data['email'].$data['address'].$data['pic'];
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL firstLogin(?,?,?)");
		$sth->bindValue(1, $data['email']);
		$sth->bindValue(2, $data['address']);
		$sth->bindValue(3, $data['pic']);
		$sth->execute();
	}
}
?>