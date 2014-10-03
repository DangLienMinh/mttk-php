<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
class UserDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
   }
	/*public function layThongTin(Entity\User $temp)
	{
		$user = new Entity\User;
		$user->setEmail($temp->getEmail());
		$user->setPassword($temp->getPassword());
		$user->setFirst_name($temp->getFirst_name());
		$user->setLast_name($temp->getLast_name());
		$user->setPicture($temp->getPicture());
		$user->setOnline($temp->getOnline());
		$user->setCreated_at($temp->getCreated_at());
		$user->setBirthday($temp->getBirthday());
	}*/

	public function themUser($data)
	{
		
	    $user = new User;
		$user->setEmail($data['email']);
		$user->setPassword($data['password']);
		$user->setFirst_name($data['first_name']);
		$user->setLast_name($data['last_name']);
		$user->setBirthday($data['birthday']);
		$this->em->persist($user);
		$this->em->flush();
	}

	public function suaUser($data)
	{
	    $user = $em->getReference('Entity\User', $email);
		$this->em->merge($user);
		$this->em->flush();
	}

	public function xoaUser($email)
	{
	    $user = $em->getReference('Entity\User', $email);
	    $this->em->remove($user);
	    $this->em->flush();
	}

	public function searchUser($name){
		//$query = $this->em->createQuery("SELECT CONCAT(CONCAT(p.first_name,' '),p.last_name) FROM Entity\User p WHERE p.first_name like ?1");
		$query = $this->em->createQuery("SELECT p.email,p.first_name,p.last_name FROM Entity\User p WHERE p.first_name like ?1");
		$str=$name.'%';
		$query->setParameter(1, $str);
		$results=$query->getResult();
		return json_encode($results);
		/*foreach ($results AS $result) {
			echo $result['first_name']." ".$result['last_name'];
			echo "<br>";
		}*/
	}
}
?>