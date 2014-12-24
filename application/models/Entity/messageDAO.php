<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class MessageDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

    //get new message for current user that they have not read
	public function getNewMessageNumber($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("SELECT count(*) from message where toUser=? and is_read=0 
		and email in (select friend_name from friend where email=? and accept=1 and is_subscriber=1 UNION select email from friend where friend.friend_name=? and accept=1 and is_subscriber=1) group by email");
		$sth->bindValue(1, $email);
		$sth->bindValue(2, $email);
		$sth->bindValue(3, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//get new message for current user that they have not read
	public function checkUnreadMessage($from_user,$to_user)
	{
		$cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from message where toUser=? and email=? and is_read=0");
        $sth->bindValue(1, $to_user);
		$sth->bindValue(2,$from_user);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result[0]['checked'];
	}
	
    //get first 20 messages of current user and other user
    public function getFirstMessages($data)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getFirstMessages(?,?)");
		$sth->bindValue(1, $data['from']);
		$sth->bindValue(2, $data['to']);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//get next 10 messages of current user and other user
	public function getMoreMessages($data)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getMoreMessages(?,?,?)");
		$sth->bindValue(1, $data['from']);
		$sth->bindValue(2, $data['to']);
		$sth->bindValue(3, $data['started']);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}
	
	//add new message of current user and other user
	public function addMessage($data)
	{
		$message = new Message;
		$toUser = $this->em->getReference('Entity\User',$data['to']);
		$fromUser = $this->em->getReference('Entity\User',$data['from']);
		$message->setMessage($data['message']);
		$message->setToUser($toUser);
		$message->setEmail($fromUser);
		$message->setIs_read(0);
		$this->em->persist($message);
		$this->em->flush();
		return $message->getMessage_id();
	}

	
}
?>