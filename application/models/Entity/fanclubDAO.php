<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class FanclubDAO
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
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL themFanclubUser(?,?,?)");
        $sth->bindValue(1, $data['user']);
        $sth->bindValue(2, $data['fanclub_id']);
        $sth->bindValue(3,$data['email']);
        $sth->execute();
    }

    public function tuThemVaoFanclub($data)
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

    public function getFanclubByID($id){
        $query = $this->em->createQuery("SELECT p.fanclub_name,p.fanclub_desc FROM Entity\Fanclub p WHERE p.fanclub_id = ?1");
        $query->setParameter(1, $id);
        $results=$query->getResult();
        return $results;
    }

    public function checkUserCreateGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL checkUserCreateGroup(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function checkUserMemberGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL checkUserMemberGroup(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }


    public function getFanclub($email){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getFanclubList(?)");
        $sth->bindValue(1, $email);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getMembers($id)
    {
        // prepare statement
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL getAllMembers(?)");
        $sth->bindValue(1, $id);
        // execute and fetch
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function removeMember($email,$id)
    {
       $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL removeMember(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
    }

    public function removeFanclub($email,$id)
    {
       $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL removeMemberAdmin(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
    }
}
?>