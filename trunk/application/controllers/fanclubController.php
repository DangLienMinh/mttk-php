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
        $result=$user->timUserFriend($search,$email);
        $friends="";
        if(count($result)>0){
            $friends.='<div class="searchUserTtile"><h3>People</h3></div>';
            foreach($result as $k)
            {
                $friends.='<div class="searchUserBox" align="left"><img src="'.base_url().'uploads/img/'.$k['picture'].'" style="width:40px; height:40px; float:left; margin-right:6px" /><a href="seeWall/'. $k['email'] . '">' . $k['first_name']." ".$k['last_name'] . '</a></div>';
            }
        }else{
            $friends.="<b>No Data Found</b>";
        }
        echo $friends;
    }

}
?>