<?php
namespace Entity;
use Doctrine\Common\Collections\ArrayCollection;
class ProfileDAO
{
	private $em;
	function __construct($em) {
       $this->em=$em;
    }

    //add new profile
	public function themProfile($data)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("CALL firstLogin(?,?,?)");
		$sth->bindValue(1, $data['email']);
		$sth->bindValue(2, $data['address']);
		$sth->bindValue(3, $data['pic']);
		$sth->execute();
	}

	//get all the profile of user
	public function getProfile($email)
	{
		$cnn=$this->em->getConnection();
		$sth = $cnn->prepare("select profile_id,p.email,gender,nickname,language,p.privacy_type_id,about_me,relationship,looking_for,phone,interests,
			education,hobbies,fav_movies,fav_artists,fav_books,fav_animals,religion,everything_else,address,birthday 
			from profile p,user u where p.email=u.email and p.email=?");
		$sth->bindValue(1, $email);
		$sth->execute();
		$result = $sth->fetchAll();
		return $result;
	}

	//change the education of user
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

	//change the Religion of user
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
	
	//change the Phone of user
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

	//change the Birthday of user
	public function suaBirthday($email,$data)
	{
	    $user = $this->em->getReference('Entity\User', $email);
	    $user->setBirthday($data);
		$this->em->merge($user);
		$this->em->flush();
	}

	//change the Gender of user
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

	//change the Language of user
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

	//change the About of user
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

	//change the Nickname of user
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

	//change the Everything_else of user
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

	//change the Hobbies of user
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

	//change the favorite Movie of user
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

	//change the favorite Artist of user
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

	//change the favorite book of user
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

	//change the animal favorite of user
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