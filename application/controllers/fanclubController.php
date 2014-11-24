<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class FanclubController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

	public function themFanclub(){
        $data['name']=$_POST["name"];
        $data['desc']=$_POST["desc"];
        $data['email'] = $this->session->userdata('email');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $fanclub->themFanclub($data);
        echo base_url('main/homePage/');
    }

    public function themFanclubUser(){
        $data['user']=$this->input->post('user');
        $data['fanclub_id']=$this->input->post('fanclub_id');
        $data['email'] = $this->session->userdata('email');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $fanclub->themFanclubUser($data);
    }

    public function tuThemVaoFanclub(){
        $data['email']=$this->session->userdata('email');
        $data['fanclub_id']=$this->input->post('fanclub_id');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $fanclub->tuThemVaoFanclub($data);
    }

    public function tuRemoveKhoiFanlub(){
        $email=$this->session->userdata('email');
        $fanclub_id=$this->input->post('fanclub_id');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $checked=$fanclub->checkUserCreateGroup($email,$fanclub_id);
        if($checked[0]['checked']>0){
            $fanclub->removeFanclub($email,$fanclub_id);
        }else{
            $fanclub->removeMember($email,$fanclub_id);
        }
    }

    public function checkFanlubAdmin(){
        $email=$this->session->userdata('email');
        $fanclub_id=$this->input->post('fanclub_id');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $checked=$fanclub->checkUserCreateGroup($email,$fanclub_id);
        echo $checked[0]['checked'];
    }

    public function removeMember(){
        $email=$this->input->post('email');
        $fanclub_id=$this->input->post('fanclub_id');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $fanclub->removeMember($email,$fanclub_id);
    }

    public function getFanclub(){
        $email = $this->session->userdata('email');
        $em = $this->doctrine->em;
        $fanclub = new Entity\FanclubDAO($em);
        $result=$fanclub->getFanclub($email);
        $data="";
        foreach($result as $k)
        {
            $data.='<div class="fanclubUserBox" align="left"><div class="leaveClub"><a></a></div><img src="'.base_url().'assets/img/groupIcon.png" style="width:15px; height:15px; float:left; margin-right:6px" /><a href="'.site_url('statusController/layDSFanclubStatus/').'/'.$k['fanclub_id'].'">' . $k['fanclub_name']. '</a></div>';
        }
        echo $data;
    }

    public function searchFanclub(){
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
        $user = new Entity\UserDAO($em);
        $search=  $this->input->post('search');
        $fanclub=  $this->input->post('fanclub');
        $result=$user->timUserFriend($search,$email,$fanclub);
        $friends="";
        if(count($result)>0){
            foreach($result as $k)
            {
                $friends.='<div class="display_box" align="left"><img src="'.base_url().'uploads/img/'.$k['picture'].'" style="width:25px; height:25px; float:left; margin-right:6px" /><a href="'.site_url('statusController/layDSWallStatus/').'/'. $k['email'] . '">' . $k['first_name']." ".$k['last_name'] . '</a><button type="button" class="addMember" value="' . $k['email'] . '">'.'Add member</button></div>';
            }
        }else{
            $friends.="<b>No Data Found</b>";
        }
        echo $friends;
    }

    function createFanclub(){
        $this->smarty->view('addFanclub');
    }

    public function getAllMembers()
    {
        $em = $this->doctrine->em;
        $fanclub_id = $this->input->post('fanclub_id');
        $fanclub = new Entity\FanclubDAO($em);
        $friend = new Entity\FriendDAO($em);
        $result=$fanclub->getMembers($fanclub_id);
        //echo json_encode($result);
        $friends="";
        $checked=$fanclub->checkUserCreateGroup($this->session->userdata('email'),$fanclub_id);
        $removeOption="";
        if($checked[0]['checked']>0){

            $removeOption="<a class='removeMember'></a>";
        }
            foreach($result as $k)
            {
                if(strcmp($this->session->userdata('email'), $k['email'])==0){
                    $friends.='<li><a href="'.site_url('statusController/layDSWallStatus/').'/'.$k['email'].'"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a><button value="'.$k['email'].'">Following</button>'.$removeOption.'</li>';
                }else{
                    if($friend->checkFriend($this->session->userdata('email'),$k['email'])>0){
                    $friends.='<li><a href="'.site_url('statusController/layDSWallStatus/').'/'.$k['email'].'"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a><button class="unFriend" value="'.$k['email'].'">Unfriend</button>'.$removeOption.'</li>';
                    }else{
                        $friends.='<li><a href="'.site_url('statusController/layDSWallStatus/').'/'.$k['email'].'"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a><button class="addFriend" value="'.$k['email'].'">Add Friend</button>'.$removeOption.'</li>';
                    }
                }
            }
        echo $friends;
    }



}
?>