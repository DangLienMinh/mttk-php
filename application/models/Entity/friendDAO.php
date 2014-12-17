<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class FriendDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
   }

   //add new friend 
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

	//get all the friend requests for current user
	public function getFriendRequest($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select picture,CONCAT(first_name,' ',last_name) as name,email from user 
	where email in(select email from friend where friend.friend_name=? and accept=0)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//get all friends for current users
	public function getAllFriends($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("(select CONCAT(first_name,' ',last_name) as name,picture,user.email from friend,user where friend.friend_name=user.email and friend.email=? and accept=1) UNION
(select CONCAT(first_name,' ',last_name) as name,picture,user.email from friend,user where friend.email=user.email and friend.friend_name=? and accept=1) ORDER BY name");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//get all friends for messages
	public function getAllChatFriends($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("(select CONCAT(first_name,' ',last_name) as name,picture,user.email,online from friend,user where friend.friend_name=user.email and friend.email=? and accept=1) UNION
(select CONCAT(first_name,' ',last_name) as name,picture,user.email,online from friend,user where friend.email=user.email and friend.friend_name=? and accept=1) ORDER BY online desc,name");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//get suggested friends for current user
	public function getSuggestedFriend($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select u.email,u.picture,CONCAT(u.first_name,' ',u.last_name) as name from user u 
		where u.email not in (select friend_name from friend where friend.email=?) and u.email not in 
		(select email from friend where friend.friend_name=?) and u.email!='admin@socialmusic.com' and u.email!=? LIMIT 10");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $email);
		$sth->bindValue(3, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//current user accepted other friend request and they becom friend
	public function acceptFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("update friend set accept=1 where email=? and friend_name=?");
		$sth->bindValue(1, $friend);
		$sth->bindValue(2, $email);
		$sth->execute();
	}

	//current user declined other friend request and they becom friend
	public function declineFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("delete from friend where email=? and friend_name=?");
		$sth->bindValue(1, $friend);
		$sth->bindValue(2, $email);
		$sth->execute();
	}

	//current user unfriends other user
	public function UnFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL unFriend(?,?)");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->execute();
	}

	//current user unfollows other user
	public function unfollowFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("update friend set is_subscriber=0 where email=? and friend_name=? or email=? and friend_name=?");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->bindValue(3, $friend);
		$sth->bindValue(4, $email);
		$sth->execute();
	}

	//current user follows other user
	public function followFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("update friend set is_subscriber=1 where email=? and friend_name=? or email=? and friend_name=?");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->bindValue(3, $friend);
		$sth->bindValue(4, $email);
		$sth->execute();
	}

	//check if current user is friend with other user
	public function checkFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select * from friend where email=? and friend_name=? or email=? and friend_name=?");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->bindValue(3, $friend);
		$sth->bindValue(4, $email);
		$sth->execute();
		$result = $sth->fetch();
		return $result;
	}

	//check current user accept other user friend request
	public function checkAcceptFriend($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select accept from friend where email=? and friend_name=? or email=? and friend_name=?");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->bindValue(3, $friend);
		$sth->bindValue(4, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//check if current user follow or not follow other user
	public function checkFriendSubscribe($email,$friend)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select is_subscriber from friend where email=? and friend_name=? or email=? and friend_name=?");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $friend);
		$sth->bindValue(3, $friend);
		$sth->bindValue(4, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
}
?>