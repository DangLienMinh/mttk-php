<?php

class NotiController extends CI_Controller {
    
    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //get new notify number
    function getNewNotifyNumber() {
        $em     = $this->doctrine->em;
        $noti   = new Entity\NotificationDAO($em);
        $result = $noti->getNewNotify($this->session->userdata('email'));
        echo count($result);
    }
    
    //mark all notifications as read
    function setAllNotifyIsRead() {
        $em   = $this->doctrine->em;
        $noti = new Entity\NotificationDAO($em);
        $noti->setAllNotifyIsRead($this->session->userdata('email'));
    }
    
    //get first 6 notification
    function getOldNotify() {
        $em         = $this->doctrine->em;
        $noti       = new Entity\NotificationDAO($em);
        $result     = $noti->getOldNotify($this->session->userdata('email'));
        $notiNumber = count($noti->getNewNotify($this->session->userdata('email')));
        $notify     = "";
        foreach ($result as $k) {
            $noti_icon = "";
            if ($k['type'] == "1") {
                $notiIcon = "noti_like";
            } else {
                $notiIcon = "noti_comment";
            }
            if ($notiNumber > 0) {
                $notify .= '<li style="background-color:#f4f6f9"  class="noti" id="noti' . $k['notification_id'] . '"><a href="' . site_url('statusController/hienThiNotiStatus/') . "/" . $k['status_id'] . "/" . $k['notification_id'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span>' . $k['msg'] . '</span><br/><abbr class="timeago ' . $notiIcon . '" title="' . $k['created_at'] . '"></abbr></a></li>';
                $notiNumber = $notiNumber - 1;
            } else {
                $notify .= '<li class="noti" id="noti' . $k['notification_id'] . '"><a href="' . site_url('statusController/hienThiNotiStatus/') . "/" . $k['status_id'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="vietHoaTen">' . $k['msg'] . '</span><br/><abbr class="timeago ' . $notiIcon . '" title="' . $k['created_at'] . '"></abbr></a></li>';
            }
        }
        echo $notify;
    }
    
    //get next 5 notifications
    function getNextOldNotify() {
        $id     = $this->input->post('noti_id');
        $em     = $this->doctrine->em;
        $noti   = new Entity\NotificationDAO($em);
        $result = $noti->getNextOldNotify($this->session->userdata('email'), $id);
        $notify = "";
        foreach ($result as $k) {
            $noti_icon = "";
            if ($k['type'] == "1") {
                $notiIcon = "noti_like";
            } else {
                $notiIcon = "noti_comment";
            }
            $notify .= '<li class="noti" id="noti' . $k['notification_id'] . '"><a href="' . site_url('statusController/hienThiNotiStatus/') . "/" . $k['status_id'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="vietHoaTen">' . $k['msg'] . '</span><br/><abbr class="timeago ' . $notiIcon . '" title="' . $k['created_at'] . '"></abbr></a></li>';
        }
        echo $notify;
    }
}
?>