<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class fanclubDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

    public function themFanclub($data)
    {
        $fanclub = new Fanclub;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $fanclub->setEmail($email);
        $fanclub->setFanclub_name($data['name']);
        $fanclub->setFanclub_desc($data['desc']);
        $this->em->persist($fanclub);
        $this->em->flush();
        //return $comment->getComment_id();
    }

    public function themFanclubUser($data)
    {
        $fanclub = new Fanclub_users;
        $email = $this->em->getReference('Entity\User', $data['email']);
        $fanclubID = $this->em->getReference('Entity\Fanclub', $data['fanclub_id']);
        $fanclub->setEmail($email);
        $fanclub->setFanclub_id($fanclubID);
        $this->em->persist($fanclub);
        $this->em->flush();
    }

    public function themFanclubUpdate($data)
    {
        $fanclub = new Fanclub_updates;
        $status = $this->em->getReference('Entity\Status', $data['status_id']);
        $fanclubID = $this->em->getReference('Entity\Fanclub', $data['fanclub_id']);
        $fanclub->setStatus_id($status);
        $fanclub->setFanclub_id($fanclubID);
        $this->em->persist($fanclub);
        $this->em->flush();
    }

    public function timFanclub($name){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL TimFanclub(?)");
        $sth->bindValue(1, $name);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }
}
?>