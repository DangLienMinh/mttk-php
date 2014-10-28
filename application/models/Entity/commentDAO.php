<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class CommentDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

    public function themComment($data)
    {
        $comment = new Comment;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $status = $this->em->getReference('Entity\Status', $data['status']);
        $comment->setMessage($data['message']);
        $comment->setStatus_id($status);
        $comment->setFriend_name($email);
        $this->em->persist($comment);
        $this->em->flush();
        return $comment->getComment_id();
    }

    public function xoaComment($id)
    {
        $comment = $this->em->getReference('Entity\Comment', $id);
        $this->em->remove($comment);
        $this->em->flush();
    }

    public function layComment($status_id)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetComment(?)");
        $sth->bindValue(1, $status_id);
        // execute and fetch
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function layLastComment($status_id,$count)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetLastComment(?,?)");
        $sth->bindValue(1, $status_id);
        $sth->bindValue(2, $count);
        // execute and fetch
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
}
?>