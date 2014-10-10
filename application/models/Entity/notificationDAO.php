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

	public function layDSNotify($email)
	{
		// prepare statement
		$sth = $this->em->prepare("CALL GetNotify($email)");

		// execute and fetch
		$sth->execute();
		$result = $sth->fetch();
		$output->writeln(var_dump($result));
	}
}
?>