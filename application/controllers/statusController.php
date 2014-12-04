<?php
class StatusController extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    function index() {
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->getStatus($this->session->userdata('email'));
        echo json_encode($result);
    }
    
    function GetFamousStatus() {
        $sdate  = $_POST['sdate'];
        $edate  = $_POST['edate'];
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->GetFamousStatus($sdate, $edate);
        $this->smarty->assign('items', json_encode($result));
        $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
        $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
        $this->smarty->assign('userLogin', $this->session->userdata('email'));
        $this->smarty->view('reportMusic');
    }
    
    function getNextStatus() {
        $id     = $this->input->post('status_id');
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->getNextStatus($this->session->userdata('email'), $id);
        echo json_encode($result);
    }
    
    function getNextWallStatus() {
        $id     = $this->input->post('status_id');
        $email  = $this->input->post('email');
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->layDSNextWallStatus($email, $id);
        echo json_encode($result);
    }
    
    function layDSWallStatus($email) {
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->layDSWallStatus($email);
        $result = json_encode($result);
        $friend  = new Entity\FriendDAO($em);
        $user     = new Entity\UserDAO($em);
        $userInfo = $user->getUser($email);
        if ($friend->checkFriend($this->session->userdata('email'), $email) > 0) {
            $checkAcceptFriend = $friend->checkAcceptFriend($this->session->userdata('email'), $email);
            if ($checkAcceptFriend[0]['accept'] > 0) {
                $this->smarty->assign('relation', 1);
            }else{
                $this->smarty->assign('relation', 2);
            }
        }else{
            if (strcmp($email, $this->session->userdata('email')) == 0) {
                $this->smarty->assign('relation', 1);
            }else{
                $this->smarty->assign('relation', 0);
            }
            
        }
        $this->smarty->assign('items', $result);
        $this->smarty->assign('userLoginWall', $email);
        $this->smarty->assign('userNameWall', $userInfo[0]['first_name'] . ' ' . $userInfo[0]['last_name']);
        $this->smarty->assign('userPicCmtWall', $userInfo[0]['picture']);
        $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
        $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
        $this->smarty->assign('userLogin', $this->session->userdata('email'));
        $cover = "";
        if ($userInfo[0]['coverImg'] != "") {
            $cover = $userInfo[0]['coverImg'];
        } else {
            $cover = 'musicCover.jpg';
        }
        $this->smarty->assign('profileCover', $cover);
        $this->smarty->view('userWall');
    }
    
    function layDSFanclubStatus($fanclubid) {
        $em      = $this->doctrine->em;
        $status  = new Entity\statusDAO($em);
        $fanclub = new Entity\fanClubDAO($em);
        $result  = $status->layDSFanclubStatus($fanclubid);
        $result  = json_encode($result);
        
        $fanclubInfo = $fanclub->getFanclubByID($fanclubid);
        $checkCreate = $fanclub->checkUserCreateGroup($this->session->userdata('email'), $fanclubid);
        $checkIn     = $fanclub->checkUserMemberGroup($this->session->userdata('email'), $fanclubid);
        $cover       = "";
        if ($fanclubInfo[0]['coverImg'] != "") {
            $cover = $fanclubInfo[0]['coverImg'];
        } else {
            $cover = 'musicCover.jpg';
        }
        $this->smarty->assign('profileCover', $cover);
        if ($checkCreate[0]['checked'] == 0 && $checkIn[0]['checked'] == 0) {
            $this->smarty->assign('fanclubName', $fanclubInfo[0]['fanclub_name']);
            $this->smarty->assign('fanclubDesc', $fanclubInfo[0]['fanclub_desc']);
            $this->smarty->assign('items', $result);
            $this->smarty->assign('fanclub', $fanclubid);
            $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
            $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
            $this->smarty->assign('userLogin', $this->session->userdata('email'));
            
            $this->smarty->assign('profileCover', $cover);
            $this->smarty->view('unregisteredFanclub');
        } else {
            $this->smarty->assign('fanclubName', $fanclubInfo[0]['fanclub_name']);
            $this->smarty->assign('fanclubDesc', $fanclubInfo[0]['fanclub_desc']);
            $this->smarty->assign('items', $result);
            $this->smarty->assign('fanclub', $fanclubid);
            $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
            $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
            $this->smarty->assign('userLogin', $this->session->userdata('email'));
            $this->smarty->view('fanclub');
        }
    }
    
    public function chooseMusic() {
        if (@$_POST['music_name']) {
            $music    = $_POST["music_name"];
            $music    = str_replace(' ', '+', $music);
            $urlMusic = "http://j.ginggong.com/jOut.ashx?k=" . $music . "&h=mp3.zing.vn&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
            $json     = file_get_contents($urlMusic);
            $result   = json_decode($json, true);
            $statuses = "";
            if (count($result) > 0) {
                foreach ($result as $k) {
                    $statuses .= '<li class="result"><a href="#" onclick="playSelectedSong(' . "'" . $k['UrlJunDownload'] . "','" . $k['Title'] . "'" . ')">' . $k['Title'] . '</a></li>';
                }
            } else {
                $statuses .= "<b>No Data Found</b>";
            }
            echo $statuses;
        }
    }
    
    public function xoaStatus() {
        $id      = $this->input->post('status_id');
        $em      = $this->doctrine->em;
        $status  = new Entity\statusDAO($em);
        $linkUrl = FCPATH . 'uploads/';
        $status->xoaStatus($id, $linkUrl);
    }
    
    public function suaStatus() {
        $id     = $this->input->post('status_id');
        $msg    = $this->input->post('msg');
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $status->suaStatus($id, $msg);
    }
    
    public function updateStatus() {
        $data['status']  = "";
        $data['music']   = "";
        $data['privacy'] = "";
        if (trim($_POST['status']) != '') {
            $data['status'] = $_POST["status"];
            $data['music']  = $_POST["music_url"];
            $data['title']  = $_POST["title"];
        } else if (trim($_POST['status3']) != '') {
            $data['status'] = $_POST["status3"];
            $data['music']  = $_POST["playlist_id"];
            $data['title']  = "";
        } else {
            if ($_FILES['musicFile']['error'] != 4) {
                $data['title']           = $_FILES['musicFile']['name'];
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '10240';
                $config['file_name']     = uniqid() . '.mp3';
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload("musicFile")) {
                    /*$error = $this->upload->display_errors();
                    $this->smarty->assign('error',$error);
                    $this->smarty->view('upload');*/
                } else {
                    $uploaded       = array(
                        'upload_data' => $this->upload->data()
                    );
                    $data['status'] = $_POST["status2"];
                    $data['music']  = $config['file_name'];
                }
            }
        }
        $data['privacy'] = $_POST["privacy"];
        $data['email']   = $this->session->userdata('email');
        $em              = $this->doctrine->em;
        $status          = new Entity\statusDAO($em);
        $status->themStatus($data);
        redirect('/main/homePage/', 'refresh');
    }
    
    public function themFanclubStatus() {
        $data['status']  = "";
        $data['music']   = "";
        $data['privacy'] = "";
        if (trim($_POST['status']) != '') {
            $data['status'] = $_POST["status"];
            $data['music']  = $_POST["music_url"];
            $data['title']  = $_POST["title"];
        } else if (trim($_POST['status3']) != '') {
            $data['status'] = $_POST["status3"];
            $data['music']  = $_POST["playlist_id"];
            $data['title']  = "";
        } else {
            if ($_FILES['musicFile']['error'] != 4) {
                $data['title']           = $_FILES['musicFile']['name'];
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '10240';
                $config['file_name']     = uniqid() . '.mp3';
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload("musicFile")) {
                } else {
                    $uploaded       = array(
                        'upload_data' => $this->upload->data()
                    );
                    $data['status'] = $_POST["status2"];
                    $data['music']  = $config['file_name'];
                }
            }
        }
        $data['fanclub_id'] = $_POST["fanclub_id"];
        $data['privacy']    = $_POST["privacy"];
        $data['email']      = $this->session->userdata('email');
        $em                 = $this->doctrine->em;
        $status             = new Entity\statusDAO($em);
        $data['status_id']  = $status->themStatus($data);
        $fanclub            = new Entity\fanclubDAO($em);
        $fanclub->themFanclubUpdate($data);
        redirect('/statusController/layDSFanclubStatus/' . $data['fanclub_id'] . '/', 'refresh');
    }
    
    public function hienThiNotiStatus($statusParam, $noti_id = -1) {
        $em = $this->doctrine->em;
        if ($noti_id != -1) {
            $noti = new Entity\NotificationDAO($em);
            $noti->setNotifyIsRead($noti_id);
        }
        $status = new Entity\statusDAO($em);
        $result = $status->laySingleStatus($statusParam);
        $result = json_encode($result);
        $this->smarty->assign('items', $result);
        $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
        $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
        $this->smarty->assign('userLogin', $this->session->userdata('email'));
        $this->smarty->view('notiStatus');
    }
    
    public function hienThiShareStatus($statusParam) {
        $em     = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result = $status->laySingleStatus($statusParam);
        $result = json_encode($result);
        $this->smarty->assign('items', $result);
        $this->smarty->assign('userPicCmt', $this->session->userdata('pic'));
        $this->smarty->assign('userName', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'));
        $this->smarty->assign('userLogin', $this->session->userdata('email'));
        $this->smarty->view('shareWindow');
    }
}
?>