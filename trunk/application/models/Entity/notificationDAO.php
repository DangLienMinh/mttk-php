<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class NotificationDAO
{
	private $em;
	function __construct($em){
       $this->em=$em;
    }

	public function getNewNotify($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL GetNewNotify(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getOldNotify($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("SELECT notification_id,msg,type,privacy_type_id,notification.created_at,notification.email,is_read,status_id,(select picture from user where email=user_make_noti) as picture FROM notification, user 
 WHERE notification.email=user.email and notification.email=? and type!=4 order by is_read ASC,created_at DESC LIMIT 6");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function getNextOldNotify($email,$id)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("SELECT notification_id,msg,type,privacy_type_id,notification.created_at,notification.email,is_read,status_id,(select picture from user where email=user_make_noti) as picture FROM notification, user 
 WHERE notification.email=user.email and notification.email=? and type!=4 and notification_id<? order by is_read ASC,created_at DESC LIMIT 5");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $id);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function setNotifyIsRead($notification_id)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("UPDATE notification set is_read=1 where notification_id=?");
		$sth->bindValue(1, $notification_id);
		$sth->execute();
	}

	public function setAllNotifyIsRead($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("UPDATE notification set is_read=1 where is_read=0 and email=?");
		$sth->bindValue(1, $email);
		$sth->execute();
	}
}
?>