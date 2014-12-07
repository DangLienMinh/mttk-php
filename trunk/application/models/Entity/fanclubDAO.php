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
        $sth = $cnn->prepare("select fanclub_id,fanclub_name,fanclub_desc,(select count(*)+1 from fanclub_users where fanclub_id=(select fanclub_id from fanclub where fanclub_name=?)) as soluong from fanclub where fanclub_name=? order by fanclub_name LIMIT 5");
        $sth->bindValue(1, $name);
        $sth->bindValue(2, $name);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getFanclubByID($id){
        $query = $this->em->createQuery("SELECT p.fanclub_name,p.fanclub_desc,p.coverImg FROM Entity\Fanclub p WHERE p.fanclub_id = ?1");
        $query->setParameter(1, $id);
        $results=$query->getResult();
        return $results;
    }

    public function checkUserCreateGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from fanclub where email=? and fanclub_id=?");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function checkUserMemberGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from fanclub_users where email=? and fanclub_id=?");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getFanclub($email){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT p.fanclub_id,p.fanclub_name,p.fanclub_desc FROM Fanclub p WHERE p.email = ? or p.fanclub_id in(select h.fanclub_id from Fanclub_users h where h.email=?) order by p.fanclub_name LIMIT 10");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $email);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getMembers($id)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("(SELECT CONCAT(first_name,' ',last_name) as name,picture,user.email from user,fanclub where user.email=fanclub.email and fanclub.fanclub_id=?) UNION
(SELECT CONCAT(first_name,' ',last_name) as name,picture,user.email from user,fanclub_users where user.email=fanclub_users.email and fanclub_users.fanclub_id=?) ORDER BY name");
        $sth->bindValue(1, $id);
        $sth->bindValue(2, $id);
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

    public function suaProfileCover($data)
    {
        $fanclub = $this->em->getReference('Entity\Fanclub',$data['fanclub_id']);
        $fanclub->setCoverImg($data['pic']);
        $this->em->merge($fanclub);
        $this->em->flush();
    }
    public function getPreviousProfileCover($fanclub_id)
    {
        $fanclub = $this->em->getReference('Entity\Fanclub', $fanclub_id);
        return $fanclub->getCoverImg();
    }
}
?>