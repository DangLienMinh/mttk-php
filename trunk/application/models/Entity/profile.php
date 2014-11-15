<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="profile")
 */
class Profile
{
     /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue
     */
    protected $profile_id;

    /**
     * @ManyToOne(targetEntity="user")
     * @JoinColumn(name="email", referencedColumnName="email")
     **/
    protected $email;

    /**
     * @ManyToOne(targetEntity="privacy_type")
     * @JoinColumn(name="privacy_type_id", referencedColumnName="privacy_type_id")
     **/
    protected $privacy_type_id;

    /**
     * @Column(type="string")
     */
    protected $relationship;

    /**
     * @Column(type="string")
     */
    protected $looking_for;

    /**
     * @Column(type="string")
     */
    protected $about_me;

    /**
     * @Column(type="string")
     */
    protected $language;

    /**
     * @Column(type="string")
     */
    protected $gender;

    /**
     * @Column(type="string")
     */
    protected $nickname;

    /**
     * @Column(type="string")
     */
    protected $phone;

    /**
     * @Column(type="string")
     */
    protected $interests;

    /**
     * @Column(type="string")
     */
    protected $education;

    /**
     * @Column(type="string")
     */
    protected $hobbies;

    /**
     * @Column(type="string")
     */
    protected $fav_movies;

    /**
     * @Column(type="string")
     */
    protected $fav_artists;

    /**
     * @Column(type="string")
     */
    protected $fav_books;

    /**
     * @Column(type="string")
     */
    protected $fav_animals;
    
    /**
     * @Column(type="integer")
     */
    protected $religion;

    /**
     * @Column(type="string")
     */
    protected $everything_else;

    /**
     * @Column(type="string")
     */
    protected $address;

    public function getProfile_id()
    {
        return $this->profile_id;
    }
    
    public function setProfile_id($profile_id)
    {
        $this->profile_id = $profile_id;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getPrivacy_type_id()
    {
        return $this->privacy_type_id;
    }
    
    public function setPrivacy_type_id($privacy_type_id)
    {
        $this->privacy_type_id = $privacy_type_id;
        return $this;
    }
    public function getAbout_me()
    {
        return $this->about_me;
    }
    
    public function setAbout_me($about_me)
    {
        $this->about_me = $about_me;
        return $this;
    }
    public function getRelationship()
    {
        return $this->relationship;
    }
    
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
        return $this;
    }
    public function getLooking_for()
    {
        return $this->looking_for;
    }
    
    public function setLooking_for($looking_for)
    {
        $this->looking_for = $looking_for;
        return $this;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }
    public function getInterests()
    {
        return $this->interests;
    }
    
    public function setInterests($interests)
    {
        $this->interests = $interests;
        return $this;
    }
    public function getEducation()
    {
        return $this->education;
    }
    
    public function setEducation($education)
    {
        $this->education = $education;
        return $this;
    }
    public function getHobbies()
    {
        return $this->hobbies;
    }
    
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;
        return $this;
    }
    public function getFav_movies()
    {
        return $this->fav_movies;
    }
    
    public function setFav_movies($fav_movies)
    {
        $this->fav_movies = $fav_movies;
        return $this;
    }
    public function getFav_artists()
    {
        return $this->fav_artists;
    }
    
    public function setFav_artists($fav_artists)
    {
        $this->fav_artists = $fav_artists;
        return $this;
    }
    public function getFav_books()
    {
        return $this->fav_books;
    }
    
    public function setFav_books($fav_books)
    {
        $this->fav_books = $fav_books;
        return $this;
    }
    public function getFav_animals()
    {
        return $this->fav_animals;
    }
    
    public function setFav_animals($fav_animals)
    {
        $this->fav_animals = $fav_animals;
        return $this;
    }
    public function getReligion()
    {
        return $this->religion;
    }
    
    public function setReligion($religion)
    {
        $this->religion = $religion;
        return $this;
    }
    public function getEverything_else()
    {
        return $this->everything_else;
    }
    
    public function setEverything_else($everything_else)
    {
        $this->everything_else = $everything_else;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }
    public function getGender()
    {
        return $this->gender;
    }
    
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }
    public function getNickname()
    {
        return $this->nickname;
    }
    
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }
}
?>