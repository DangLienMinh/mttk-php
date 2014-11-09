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

    
}
?>