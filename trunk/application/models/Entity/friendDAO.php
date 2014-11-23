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

	public function getFriendRequest($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetFriendRequest(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getAllFriends($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getAllFriends(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getAllChatFriends($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getAllChatFriends(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getSuggestedFriend($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getSuggestedFriend(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function acceptFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL acceptFriendRequest(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	public function declineFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL removeFriendRequest(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	public function UnFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL unFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	public function unfollowFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL unfollowFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	public function followFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL followFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	public function checkFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL checkFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}

	public function checkAcceptFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL checkAcceptFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}


	public function checkFriendSubscribe($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL checkFriendSubscribe(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
}
?>