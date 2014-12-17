<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class CommentDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

   //add a new comment and get id return
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

    //remove comment by id
    public function xoaComment($id)
    {
        $comment = $this->em->getReference('Entity\Comment', $id);
        $this->em->remove($comment);
        $this->em->flush();
    }

    //get comment by id
    public function layComment($status_id)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("select c.comment_id,s.status_id,c.message,CONCAT(u.first_name,' ',u.last_name) as name,u.picture,c.created_at ,u.email
    from status s,comment c,user u where c.status_id=s.status_id and c.friend_name=u.email
    and s.status_id=?");
        $sth->bindValue(1, $status_id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //get the latest comment of the status
    public function layLastComment($status_id,$count)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL GetLastComment(?,?)");
        $sth->bindValue(1, $status_id);
        $sth->bindValue(2, $count);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
}
?>