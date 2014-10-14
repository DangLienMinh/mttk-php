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
    }
}
?>