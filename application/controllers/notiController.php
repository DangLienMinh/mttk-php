<?php

class NotiController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

    function getNewNotifyNumber(){
        //group the same notify????
        $em = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $result=$noti->getNewNotify($this->session->userdata('email'));
        echo count($result);
    }

    function setNotifyOff(){
        $em = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $noti->setOffNotify($this->session->userdata('email'));
    }

    function getOldNotify(){
        $em = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $result=$noti->getOldNotify($this->session->userdata('email'));
        echo json_encode($result);
    }

    function getNotifyList(){
        $em = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $result=$noti->getOldNotify($this->session->userdata('email'));
        $this->smarty->assign('items',$result);
        $this->smarty->view('notiList');
    }
}
?>