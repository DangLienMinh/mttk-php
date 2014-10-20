<?php

class NotiController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	function index()
	{
	}

    function getNewNotify(){
        //group the same notify????
        $em = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $result=$noti->getNewNotify($this->session->userdata('email'));
        echo json_encode($result);
    }
}
?>