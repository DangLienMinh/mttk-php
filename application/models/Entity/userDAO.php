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
}
?>