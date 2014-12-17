<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class MessageDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
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