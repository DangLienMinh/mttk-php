<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class FanclubDAO
{
    private $em;
    function __construct($em) {
       $this->em=$em;
   }

   //add a new fanclub
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

    //add new user to fanclub by other member in the fanclub
    public function themFanclubUser($data)
    {
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL themFanclubUser(?,?,?)");
        $sth->bindValue(1, $data['user']);
        $sth->bindValue(2, $data['fanclub_id']);
        $sth->bindValue(3,$data['email']);
        $sth->execute();
    }

    //user add themself to fanclub by finding the fanclub
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

    //member post new status in the fanclub
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

    //search fanclub by name
    public function timFanclub($name){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT g.fanclub_id, fanclub_name,fanclub_desc,COUNT(m.email)+1 AS soluong
        FROM fanclub AS g
        LEFT JOIN fanclub_users AS m USING(fanclub_id)
        WHERE fanclub_name like ?
        GROUP BY g.fanclub_id
        order by fanclub_name  LIMIT 5");
        $sth->bindValue(1, $name.'%');
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //search fanclub by fanclub_id
    public function getFanclubByID($id){
        $query = $this->em->createQuery("SELECT p.fanclub_name,p.fanclub_desc,p.coverImg FROM Entity\Fanclub p WHERE p.fanclub_id = ?1");
        $query->setParameter(1, $id);
        $results=$query->getResult();
        return $results;
    }

    //check user is the fanclub creator
    public function checkUserCreateGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from fanclub where email=? and fanclub_id=?");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //check user is the member in fanclub
    public function checkUserMemberGroup($email,$id){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT count(*) as checked from fanclub_users where email=? and fanclub_id=?");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //get all the fanclubs the user involved
    public function getFanclub($email){
        $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("SELECT p.fanclub_id,p.fanclub_name,p.fanclub_desc FROM Fanclub p WHERE p.email = ? or p.fanclub_id in(select h.fanclub_id from Fanclub_users h where h.email=?) order by p.fanclub_name");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $email);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    //get all the members of the fanclub
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

    //admin removes member from their fanclub
    public function removeMember($email,$id)
    {
       $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL removeMember(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
    }

    //admin removes their fanclub
    public function removeFanclub($email,$id)
    {
       $cnn=$this->em->getConnection();
        $sth = $cnn->prepare("CALL removeMemberAdmin(?,?)");
        $sth->bindValue(1, $email);
        $sth->bindValue(2, $id);
        $sth->execute();
    }

    //change the cover photo of the fanclub
    public function suaProfileCover($data)
    {
        $fanclub = $this->em->getReference('Entity\Fanclub',$data['fanclub_id']);
        $fanclub->setCoverImg($data['pic']);
        $this->em->merge($fanclub);
        $this->em->flush();
    }

    //get the provious fanclub cover for deleting to add new cover
    public function getPreviousProfileCover($fanclub_id)
    {
        $fanclub = $this->em->getReference('Entity\Fanclub', $fanclub_id);
        return $fanclub->getCoverImg();
    }
}
?>