<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;

class ProfileDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

	public function themProfile($data)
	{
		// prepare statemen
		//echo $data['email'].$data['address'].$data['pic'];
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL firstLogin(?,?,?)");
		$sth->bindValue(1, $data['email']);
		$sth->bindValue(2, $data['address']);
		$sth->bindValue(3, $data['pic']);
		$sth->execute();
	}

	public function getProfile($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL getProfile(?)");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	public function suaEducation($email,$education)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setEducation($education);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaReligion($email,$religion)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setReligion($religion);
		$this->em->merge($profile);
		$this->em->flush();
	}
	public function suaPhone($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setPhone($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaBirthday($email,$data)
	{
	    $user = $this->em->getReference('Entity\User', $email);
	    $user->setBirthday($data);
		$this->em->merge($user);
		$this->em->flush();
	}

	public function suaGender($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setGender($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaLanguage($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setLanguage($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaAbout($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setAbout_me($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaNickname($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setNickname($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaEverything_else($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setEverything_else($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaHobbies($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setHobbies($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaMovie($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setFav_movies($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaArtist($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setFav_artists($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaBook($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setFav_books($data);
		$this->em->merge($profile);
		$this->em->flush();
	}

	public function suaAnimal($email,$data)
	{
		$query = $this->em->createQuery("SELECT p.profile_id FROM Entity\Profile p WHERE p.email = ?1");
		$query->setParameter(1, $email);
		$profile_id=$query->getResult();
	    $profile = $this->em->getReference('Entity\Profile', $profile_id[0]['profile_id']);
	    $profile->setFav_animals($data);
		$this->em->merge($profile);
		$this->em->flush();
	}
}
?>