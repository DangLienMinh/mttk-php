<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class NotificationDAO
{
	private $em;
	function __construct($em)
	{
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
		$sth = $this->em->prepare("CALL GetOldNotify($email)");

		// execute and fetch
		$sth->execute();
		$result = $sth->fetch();
		$output->writeln(var_dump($result));
	}
}
?>