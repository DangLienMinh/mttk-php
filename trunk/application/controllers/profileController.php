<?php

class ProfileController extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    function firstTime() {
        $data['address'] = $this->input->post('address');
        $img             = $this->input->post('image');
        $parts           = explode(',', $img);
        $pic             = base64_decode($parts[1]);
        $data['pic']     = uniqid() . '.png';
        $file            = FCPATH . 'uploads\\img\\' . $data['pic'];
        $success         = file_put_contents($file, $pic);
        $data['email']   = $this->session->userdata('email');
        $em              = $this->doctrine->em;
        $profile         = new Entity\ProfileDAO($em);
        $profile->themProfile($data);
        $this->session->set_userdata('pic', $data['pic']);
        echo base_url('/main/homePage');
    }
    
    function updateImage() {
        $em            = $this->doctrine->em;
        $user          = new Entity\UserDAO($em);
        $data['email'] = $this->session->userdata('email');
        if (file_exists(FCPATH . '/uploads/img/' . $user->getPreviousImage($data['email']))) {
            unlink(FCPATH . '/uploads/img/' . $user->getPreviousImage($data['email']));
        }
        $img         = $this->input->post('image');
        $parts       = explode(',', $img);
        $pic         = base64_decode($parts[1]);
        $data['pic'] = uniqid() . '.png';
        $file        = FCPATH . 'uploads\\img\\' . $data['pic'];
        $success     = file_put_contents($file, $pic);
        $user->suaProfileImage($data);
        $this->session->set_userdata('pic', $data['pic']);
        echo base_url('/main/homePage');
    }
    
    function suaProfileCover() {
        $em            = $this->doctrine->em;
        $user          = new Entity\UserDAO($em);
        $data['email'] = $this->session->userdata('email');
        if (file_exists(FCPATH . '/uploads/img/' . $user->getPreviousProfileCover($data['email']))) {
            unlink(FCPATH . '/uploads/img/' . $user->getPreviousProfileCover($data['email']));
        }
        $img         = $this->input->post('image');
        $parts       = explode(',', $img);
        $pic         = base64_decode($parts[1]);
        $data['pic'] = uniqid() . '.png';
        $file        = FCPATH . 'uploads\\img\\' . $data['pic'];
        $success     = file_put_contents($file, $pic);
        $user->suaProfileCover($data);
    }
    
    function changeProfileImage() {
        $this->smarty->view('changeProfileImage');
    }

    function getWallAbout(){
      $em      = $this->doctrine->em;
      $email   = $this->input->post('email');
      $profile = new Entity\ProfileDAO($em);
      $result  = $profile->getProfile($email);
      $content="";
      foreach ($result as $k) {
        $content.="<p>Address: ".$k['address']."</p><p>Email: ".$email."</p><p>Education: ".$k['education']."</p>";
      }
      echo $content;
    }
    
    
    public function getEducationAndReligion() {
        $em      = $this->doctrine->em;
        $email   = $this->input->post('email');
        $profile = new Entity\ProfileDAO($em);
        $result  = $profile->getProfile($email);
        $content = "";
        if (strcmp($this->session->userdata('email'), $email) != 0) {
            foreach ($result as $k) {
                $content .= '<div class="aboutTitle"><span>EDUCATION</span><div class="mainbox"><div class="text_wrapper">' . $k['education'] . '</div></div></div>';
                $content .= '<div class="aboutTitle"><span>RELIGION</span><div class="mainbox"><div class="text_wrapper">' . $k['religion'] . '</div></div></div>';
            }
        } else {
            foreach ($result as $k) {
                if ($k['education'] == "") {
                    $content .= '<div class="aboutTitle"><span>EDUCATION</span><div class="mainbox"><a class="insertAbout">Write something about your education</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="education"></textarea>
          </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>EDUCATION</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['education'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="education"></textarea>
          </div></div></div>';
                }
                if ($k['education'] == "") {
                    $content .= '<div class="aboutTitle"><span>RELIGION</span><div class="mainbox"><a class="insertAbout">Write something about your religion</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="education"></textarea>
          </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>RELIGION</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['religion'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="religion"></textarea>
          </div></div></div>';
                }
            }
        }
        echo $content;
    }
    
    public function getBasicInfo() {
        $em      = $this->doctrine->em;
        $email   = $this->input->post('email');
        $profile = new Entity\ProfileDAO($em);
        $result  = $profile->getProfile($email);
        $content = "";
        if (strcmp($this->session->userdata('email'), $email) != 0) {
            foreach ($result as $k) {
                $content .= '<div class="aboutTitle"><span>CONTACT INFORMATION</span><div class="mainbox"><div class="text_title">Mobile Phones</div><div class="text_wrapper1">' . $k['phone'] . '</div>
              </div>';
                $content .= '<div class="mainbox"><div class="text_title">Email</div><div class="text_wrapper1">' . $k['email'] . '</div>
              </div></div>';
                $content .= '<div class="aboutTitle"><span>BASIC INFO</span>
              <div class="mainbox"><div class="text_title">Date of birth</div><div class="text_wrapper1">' . $k['birthday'] . '</div>
              </div>';
                $content .= '<div class="mainbox"><div class="text_title">Gender</div><div class="text_wrapper1">' . $k['gender'] . '</div>
              </div>';
                $content .= '<div class="mainbox"><div class="text_title">Languages</div><div class="text_wrapper1">' . $k['language'] . '</div>
               </div></div>';
            }
        } else {
            foreach ($result as $k) {
                if ($k['phone'] == "") {
                    $content .= '<div class="aboutTitle"><span>CONTACT INFORMATION</span><div class="mainbox"><div class="text_title">Mobile Phones</div><a class="insertAbout">What is your phone number?</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <input class="editInput" name="phone"/>
              </div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>CONTACT INFORMATION</span><div class="mainbox"><div class="text_title">Mobile Phones</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['phone'] . '</div>
              <div class="edit" style="display:none">
                <input class="editInput" name="phone"/>
              </div></div>';
                }
                
                $content .= '<div class="mainbox"><div class="text_title">Email</div><div class="text_wrapper1">' . $k['email'] . '</div>
              </div></div><div class="aboutTitle"><span>BASIC INFO</span>
              <div class="mainbox"><div class="text_title">Date of birth</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['birthday'] . '</div>
              <div class="edit" style="display:none"><input class="editInput" type="date" name="birthday"/>
              </div></div>';
                
                if ($k['gender'] == "") {
                    $content .= '<div class="mainbox"><div class="text_title">Gender</div><a class="insertAbout">What is your gender?</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <input class="editCheckbox" value="male" checked="1" type="radio" name="gender"/>Male
                  <input class="editCheckbox" value="female" type="radio" name="gender"/>Female
              </div></div>';
                } else {
                    $content .= '<div class="mainbox"><div class="text_title">Gender</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['gender'] . '</div>
                  <div class="edit" style="display:none">
                    <input class="editCheckbox" value="male" checked="1" type="radio" name="gender"/>Male
                    <input class="editCheckbox" value="female" type="radio" name="gender"/>Female
               </div></div>';
                }
                
                if ($k['language'] == "") {
                    $content .= '<div class="mainbox"><div class="text_title">Languages</div><a class="insertAbout">What languages do you know?</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <input class="editInput" type="text" name="language"/>
              </div></div></div>';
                } else {
                    $content .= '<div class="mainbox"><div class="text_title">Languages</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['language'] . '</div>
                  <div class="edit" style="display:none">
                    <input class="editInput" type="text" name="language"/>
          </div></div></div>';
                }
            }
        }
        echo $content;
    }
    
    public function getUserDetail() {
        $em      = $this->doctrine->em;
        $email   = $this->input->post('email');
        $profile = new Entity\ProfileDAO($em);
        $result  = $profile->getProfile($email);
        $content = "";
        if (strcmp($this->session->userdata('email'), $email) != 0) {
            foreach ($result as $k) {
                $content .= '<div class="aboutTitle"><span>ABOUT YOU</span><div class="mainbox"><div class="text_wrapper">' . $k['about_me'] . '</div>
          </div></div>';
                $content .= '<div class="aboutTitle"><span>OTHER NAMES</span><div class="mainbox"><div class="text_wrapper">' . $k['nickname'] . '</div>
          </div></div>';
                $content .= '<div class="aboutTitle"><span>FAVORITE VOTES</span><div class="mainbox"><div class="text_wrapper">' . $k['everything_else'] . '</div>
          </div></div>';
            }
        } else {
            foreach ($result as $k) {
                if ($k['about_me'] == "") {
                    $content .= '<div class="aboutTitle"><span>ABOUT YOU</span><div class="mainbox"><a class="insertAbout">Write some details about yourself</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
              <div class="edit" style="display:none">
                <textarea class="editbox" cols="23" rows="3" name="aboutme"></textarea>
              </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>ABOUT YOU</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['about_me'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="aboutme"></textarea>
          </div></div></div>';
                }
                if ($k['nickname'] == "") {
                    $content .= '<div class="aboutTitle"><span>OTHER NAMES</span><div class="mainbox"><a class="insertAbout">Add a nickname, a birth name...</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="nickname"></textarea>
          </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>OTHER NAMES</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['nickname'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="nickname"></textarea>
          </div></div></div>';
                }
                if ($k['everything_else'] == "") {
                    $content .= '<div class="aboutTitle"><span>FAVORITE VOTES</span><div class="mainbox"><a class="insertAbout">Add your favorite quotation</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="everything_else"></textarea>
          </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>FAVORITE VOTES</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['everything_else'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="everything_else"></textarea>
          </div></div></div>';
                }
            }
        }
        echo $content;
    }
    
    public function getFavorite() {
        $em      = $this->doctrine->em;
        $email   = $this->input->post('email');
        $profile = new Entity\ProfileDAO($em);
        $result  = $profile->getProfile($email);
        $content = "";
        if (strcmp($this->session->userdata('email'), $email) != 0) {
            foreach ($result as $k) {
                $content .= '<div class="aboutTitle"><span>HOBBIES</span><div class="mainbox"><div class="text_wrapper">' . $k['hobbies'] . '</div>
          </div></div>';
                $content .= '<div class="aboutTitle"><span>FAVORITES</span><div class="mainbox"><div class="text_title">FAVORITE MOVIES</div><div class="text_wrapper1">' . $k['fav_movies'] . '</div>
              </div>';
                $content .= '<div class="mainbox"><div class="text_title">FAVORITE BOOKS</div><div class="text_wrapper1">' . $k['fav_books'] . '</div>
                  </div>';
                $content .= '<div class="mainbox"><div class="text_title">FAVORITE ANIMALS</div><div class="text_wrapper1">' . $k['fav_animals'] . '</div>
                  </div>';
                $content .= '<div class="mainbox"><div class="text_title">FAVORITE ARTISTS</div><div class="text_wrapper1">' . $k['fav_artists'] . '</div>
                  </div></div>';
            }
        } else {
            foreach ($result as $k) {
                if ($k['hobbies'] == "") {
                    $content .= '<div class="aboutTitle"><span>HOBBIES</span><div class="mainbox"><a class="insertAbout">What is your hobbies?</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper"></div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="hobbies"></textarea>
          </div></div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>HOBBIES</span><div class="mainbox"><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper">' . $k['hobbies'] . '</div>
          <div class="edit" style="display:none">
            <textarea class="editbox" cols="23" rows="3" name="hobbies"></textarea>
          </div></div></div>';
                }
                if ($k['fav_movies'] == "") {
                    $content .= '<div class="aboutTitle"><span>FAVORITES</span><div class="mainbox"><div class="text_title">FAVORITE MOVIES</div><a class="insertAbout">Add your favorite movies</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
               <textarea class="editbox" cols="23" rows="3" name="fav_movies"></textarea>
              </div></div>';
                } else {
                    $content .= '<div class="aboutTitle"><span>FAVORITES</span><div class="mainbox"><div class="text_title">FAVORITE MOVIES</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['fav_movies'] . '</div>
              <div class="edit" style="display:none">
               <textarea class="editbox" cols="23" rows="3" name="fav_movies"></textarea>
              </div></div>';
                }
                if ($k['fav_books'] == "") {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE BOOKS</div><a class="insertAbout">Add your favorite books</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <textarea class="editbox" cols="23" rows="3" name="fav_books"></textarea>
              </div></div>';
                } else {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE BOOKS</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['fav_books'] . '</div>
                  <div class="edit" style="display:none">
                    <textarea class="editbox" cols="23" rows="3" name="fav_books"></textarea>
               </div></div>';
                }
                if ($k['fav_animals'] == "") {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE ANIMALS</div><a class="insertAbout">Add your favorite animals</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <textarea class="editbox" cols="23" rows="3" name="fav_animals"></textarea>
              </div></div>';
                } else {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE ANIMALS</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['fav_animals'] . '</div>
                  <div class="edit" style="display:none">
                    <textarea class="editbox" cols="23" rows="3" name="fav_animals"></textarea>
               </div></div>';
                }
                if ($k['fav_artists'] == "") {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE ARTISTS</div><a class="insertAbout">Add your favorite artists</a><a href="#" class="edit_link" style="display:none" title="Edit">Edit</a><div class="text_wrapper1"></div>
              <div class="edit" style="display:none">
                <textarea class="editbox" cols="23" rows="3" name="fav_artists"></textarea>
              </div></div></div>';
                } else {
                    $content .= '<div class="mainbox"><div class="text_title">FAVORITE ARTISTS</div><a href="#" class="edit_link" title="Edit">Edit</a><div class="text_wrapper1">' . $k['fav_artists'] . '</div>
                  <div class="edit" style="display:none">
                    <textarea class="editbox" cols="23" rows="3" name="fav_artists"></textarea>
               </div></div></div>';
                }
            }
        }
        echo $content;
    }
    
    public function updateInfo() {
        $em      = $this->doctrine->em;
        $check   = $this->input->post('name');
        $data    = $this->input->post('data');
        $email   = $this->input->post('email');
        $profile = new Entity\ProfileDAO($em);
        switch ($check) {
            case 'education':
                $profile->suaEducation($email, $data);
                break;
            case 'religion':
                $profile->suaReligion($email, $data);
                break;
            case 'phone':
                $profile->suaPhone($email, $data);
                break;
            case 'birthday':
                $profile->suaBirthday($email, $data);
                break;
            case 'gender':
                $profile->suaGender($email, $data);
                break;
            case 'language':
                $profile->suaLanguage($email, $data);
                break;
            case 'aboutme':
                $profile->suaAbout($email, $data);
                break;
            case 'nickname':
                $profile->suaNickname($email, $data);
                break;
            case 'everything_else':
                $profile->suaEverything_else($email, $data);
                break;
            case 'hobbies':
                $profile->suaHobbies($email, $data);
                break;
            case 'fav_movies':
                $profile->suaMovie($email, $data);
                break;
            case 'fav_books':
                $profile->suaBook($email, $data);
                break;
            case 'fav_animals':
                $profile->suaAnimal($email, $data);
                break;
            case 'fav_artists':
                $profile->suaArtist($email, $data);
                break;
            default:
                break;
        }
    }

    
}
?>