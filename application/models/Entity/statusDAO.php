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
		// prepare statement
		$sth = $this->em->prepare("CALL GetStatus($email)");

		// execute and fetch
		$sth->execute();
		$result = $sth->fetch();

		// DEBUG
		if ($input->getOption('verbose')) {
		    $output->writeln(var_dump($result));
		}
	}
}
?>