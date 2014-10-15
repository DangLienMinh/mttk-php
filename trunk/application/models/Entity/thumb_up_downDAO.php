<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Thumb_up_downDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

    public function themLike($data)
    {
        $like = new Like;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $status = $this->em->getReference('Entity\Status', $data['status']);
        $like->setStatus_id($status);
        $like->setFriend_name($email);
        $this->em->persist($like);
        $this->em->flush();
    }

    public function xoaLike()
    {
        $like = $this->em->getReference('Entity\Like', $id);
        $this->em->remove($comment);
        $this->em->flush();
    }

    public function layLike($status_id)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetLike(?)");
        $sth->bindValue(1, $status_id);
        // execute and fetch
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function layLikeUser($status_id,$user)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetLikeUser(?,?)");
        $sth->bindValue(1, $status_id);
        $sth->bindValue(2, $user);
        // execute and fetch
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
}
?>