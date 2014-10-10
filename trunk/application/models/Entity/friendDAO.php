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
		$friend->setEmail($email);
		$friend->setFriend_name($friend_name);
		$this->em->persist($friend);
		$this->em->flush();
	}

	public function suaUser($data)
	{
	    $user = $em->getReference('Entity\User', $email);
		$this->em->merge($user);
		$this->em->flush();
	}

	
}
?>