<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Thumb_up_downDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

   //add new like to status
    public function themLike($data)
    {
        $like = new Thumb_up_down;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $status = $this->em->getReference('Entity\Status', $data['status']);
        $like->setStatus_id($status);
        $like->setFriend_name($email);
        $this->em->persist($like);
        $this->em->flush();
    }

    //remove like from status
    public function xoaLike($data)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL dislikeStatus(?,?)");
        $sth->bindValue(1, $data['email']);
        $sth->bindValue(2, $data['status']);
        $sth->execute();
    }

    //get all likes of status
    public function layLike($status_id,$user)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetLike(?,?)");
        $sth->bindValue(1, $status_id);
        $sth->bindValue(2, $user);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //check if current user like the status
    public function layLikeUser($status_id,$user)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("select thumb_up_down_id from thumb_up_down where status_id=? and friend_name=?");
        $sth->bindValue(1, $status_id);
        $sth->bindValue(2, $user);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
}
?>