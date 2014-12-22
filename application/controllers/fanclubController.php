<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class FanclubController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //add new fanclub
    public function themFanclub() {
        $data['name']  = $_POST["name"];
        $data['desc']  = $_POST["desc"];
        $data['email'] = $this->session->userdata('email');
        $em            = $this->doctrine->em;
        $fanclub       = new Entity\FanclubDAO($em);
        $fanclub->themFanclub($data);

        //refresh page
        echo base_url('/');
    }
    
    //add new user to fanclub
    public function themFanclubUser() {
        $data['user']       = $this->input->post('user');
        $data['fanclub_id'] = $this->input->post('fanclub_id');
        $data['email']      = $this->session->userdata('email');
        $em                 = $this->doctrine->em;
        $fanclub            = new Entity\FanclubDAO($em);
        $friend       = new Entity\FriendDAO($em);
        $fanclub->themFanclubUser($data);
        $result       = $fanclub->getMembers($data['fanclub_id']);
        $friends      = "";
        
        $checked      = $fanclub->checkUserCreateGroup($this->session->userdata('email'), $data['fanclub_id']);
        $removeOption = "";
        //add remove option to admin
        if ($checked[0]['checked'] > 0) {
            $removeOption = "<a class='removeMember'></a>";
        }
        //loop through member results
        foreach ($result as $k) {
            //check if user logged in is the same in this row
            if (strcmp($this->session->userdata('email'), $k['email']) == 0) {
                $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a></li>';
            } else {
                //check friend if is friend the button is unfriend
                if ($friend->checkFriend($this->session->userdata('email'), $k['email']) > 0) {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Unfriend</button>' . $removeOption . '</li>';
                //else the button is add friend
                } else {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="addFriend" value="' . $k['email'] . '">Add Friend</button>' . $removeOption . '</li>';
                }
            }
        }
        echo $friends;
    }
    
    //user add themself to fanclub
    public function tuThemVaoFanclub() {
        $data['email']      = $this->session->userdata('email');
        $data['fanclub_id'] = $this->input->post('fanclub_id');
        $em                 = $this->doctrine->em;
        $fanclub            = new Entity\FanclubDAO($em);
        $fanclub->tuThemVaoFanclub($data);
    }
    
    //user leave fanclub
    public function tuRemoveKhoiFanlub() {
        $email      = $this->session->userdata('email');
        $fanclub_id = $this->input->post('fanclub_id');
        $em         = $this->doctrine->em;
        $fanclub    = new Entity\FanclubDAO($em);
        $checked    = $fanclub->checkUserCreateGroup($email, $fanclub_id);
        if ($checked[0]['checked'] > 0) {
            $fanclub->removeFanclub($email, $fanclub_id);
        } else {
            $fanclub->removeMember($email, $fanclub_id);
        }
    }
    
    //check if user is the admin of the fanclub
    public function checkFanlubAdmin() {
        $email      = $this->session->userdata('email');
        $fanclub_id = $this->input->post('fanclub_id');
        $em         = $this->doctrine->em;
        $fanclub    = new Entity\FanclubDAO($em);
        $checked    = $fanclub->checkUserCreateGroup($email, $fanclub_id);
        echo $checked[0]['checked'];
    }
    
    //admin remove member from fanclub
    public function removeMember() {
        $email      = $this->input->post('email');
        $fanclub_id = $this->input->post('fanclub_id');
        $em         = $this->doctrine->em;
        $fanclub    = new Entity\FanclubDAO($em);
        $fanclub->removeMember($email, $fanclub_id);
    }
    
    //get fanclub of user
    public function getFanclub() {
        $email   = $this->session->userdata('email');
        $em      = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $result  = $fanclub->getFanclub($email);
        $data    = "";
        //loop through fanclub
        foreach ($result as $k) {
            $data .= '<div class="fanclubUserBox" align="left"><img src="' . base_url() . 'assets/img/groupIcon.png" style="width:15px; height:15px; float:left; margin-right:6px" /><a href="' . site_url('statusController/layDSFanclubStatus/') . '/' . $k['fanclub_id'] . '">' . $k['fanclub_name'] . '</a></div>';
        }
        echo $data;
    }
    
    //search fanclub by name
    public function searchFanclub() {
        $em      = $this->doctrine->em;
        $email   = $this->session->userdata('email');
        $user    = new Entity\UserDAO($em);
        $search  = $this->input->post('search');
        $fanclub = $this->input->post('fanclub');
        $result  = $user->timUserFriend($search, $email, $fanclub);
        $friends = "";
        if (count($result) > 0) {
            //loop through search fanclub
            foreach ($result as $k) {
                $friends .= '<div class="display_box" align="left"><img src="' . base_url() . 'uploads/img/' . $k['picture'] . '" style="width:25px; height:25px; float:left; margin-right:6px" /><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '">' . $k['first_name'] . " " . $k['last_name'] . '</a><button type="button" class="addMember" value="' . $k['email'] . '">' . 'Add member</button></div>';
            }
        } else {
            $friends .= "<b>No Data Found</b>";
        }
        echo $friends;
    }
    
    //view create fanclub view
    function createFanclub() {
        $this->smarty->view('addFanclub');
    }
    
    //get all the member in fanclub
    public function getAllMembers() {
        $em           = $this->doctrine->em;
        $fanclub_id   = $this->input->post('fanclub_id');
        $fanclub      = new Entity\FanclubDAO($em);
        $friend       = new Entity\FriendDAO($em);
        $result       = $fanclub->getMembers($fanclub_id);
        $friends      = "";
        //check if user is fanclub owner
        $checked      = $fanclub->checkUserCreateGroup($this->session->userdata('email'), $fanclub_id);
        $removeOption = "";
        //add remove option to admin
        if ($checked[0]['checked'] > 0) {
            $removeOption = "<a class='removeMember'></a>";
        }
        //loop through member results
        foreach ($result as $k) {
            //check if user logged in is the same in this row
            if (strcmp($this->session->userdata('email'), $k['email']) == 0) {
                $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a></li>';
            } else {
                //check friend if is friend the button is unfriend
                if ($friend->checkFriend($this->session->userdata('email'), $k['email']) > 0) {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Unfriend</button>' . $removeOption . '</li>';
                //else the button is add friend
                } else {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="addFriend" value="' . $k['email'] . '">Add Friend</button>' . $removeOption . '</li>';
                }
            }
        }

        //return html ajax result
        echo $friends;
    }
    
    //alter fanclub cover image
    function suaFanclubCover() {
        $fanclub_id         = $this->input->post('fanclub');
        $em                 = $this->doctrine->em;
        $fanclub            = new Entity\FanclubDAO($em);
        $data['fanclub_id'] = $fanclub_id;
        if (file_exists(FCPATH . '/uploads/img/' . $fanclub->getPreviousProfileCover($data['fanclub_id']))) {
            unlink(FCPATH . '/uploads/img/' . $fanclub->getPreviousProfileCover($data['fanclub_id']));
        }
        $img         = $this->input->post('image');
        $parts       = explode(',', $img);
        $pic         = base64_decode($parts[1]);
        $data['pic'] = uniqid() . '.png';
        $file        = FCPATH . 'uploads\\img\\' . $data['pic'];
        $success     = file_put_contents($file, $pic);
        $fanclub->suaProfileCover($data);
        echo $data['pic'];
    }
    
}
?>