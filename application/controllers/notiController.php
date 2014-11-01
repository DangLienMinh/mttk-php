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
        $dem=0;
        $notiNumber=count($noti->getNewNotify($this->session->userdata('email')));
        $notify="";
        foreach($result as $k)
        {
            $noti_icon = "";
            if ($k['type'] == "1") {
                $notiIcon = "noti_like";
            } else {
                $notiIcon = "noti_comment";
            }
            if ($dem < 5) {
                if ($notiNumber > 0) {
                    $notify.='<li style="background:#f4f6f9"  class="noti"><a href="' .site_url('statusController/hienThiNotiStatus/'). "/" . $k['status_id'] . "/" . $k['notification_id'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.base_url().'uploads/img/'.$k['picture'].'"/><span>' . $k['msg'] . '</span><br/><abbr class="timeago ' . $notiIcon . '" title="' . $k['created_at'] . '"></abbr></a></li>';
                    $notiNumber = $notiNumber - 1;
                    $dem=$dem+1;
                } else {
                    $notify.='<li class="noti"><a href="'.site_url('statusController/hienThiNotiStatus/'). "/" . $k['status_id'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span>' . $k['msg'] . '</span><br/><abbr class="timeago ' .$notiIcon . '" title="'.$k['created_at'] . '"></abbr></a></li>';
                    $dem=$dem+1;
                }
            }
        }
        //echo json_encode($result);
        echo $notify;
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