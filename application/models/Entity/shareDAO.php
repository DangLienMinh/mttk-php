<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class Thumb_up_downDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

    public function themShare($data)
    {
        $share = new Share;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $status = $this->em->getReference('Entity\Status', $data['status']);
        $share->setStatus_id($status);
        $share->setFriend_name($email);
        $share->setMessage($data['message']);
        $this->em->persist($share);
        $this->em->flush();
    }

    public function xoaShare($data)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL dislikeStatus(?,?)");
        $sth->bindValue(1, $data['email']);
        $sth->bindValue(2, $data['status']);
        // execute and fetch
        $sth->execute();
    }

    public function kiemTraShare($data)
    {
        // prepare statemen
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL checkShare(?,?)");
        $sth->bindValue(1, $data['email']);
        $sth->bindValue(2, $data['status']);
        // execute and fetch
        $sth->execute();
    }

    
}
?>