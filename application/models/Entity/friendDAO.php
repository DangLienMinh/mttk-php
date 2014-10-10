<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class FriendDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
   }

	public function themFriend($email,$friend_name)
	{
	    $friend = new Friend;
	    $email = $this->em->getReference('Entity\User', $email);
	    $friend_name = $this->em->getReference('Entity\User', $friend_name);
		$friend->setEmail($email);
		$friend->setFriend_name($friend_name);
		$friend->setAccept(0);
		$friend->setIs_subscriber(1);
		$this->em->persist($friend);
		$this->em->flush();
	}


	
}
?>