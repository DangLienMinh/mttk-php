<?php
class StatusController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

	function index()
	{
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result=$status->getStatus($this->session->userdata('email'));
        /*$friends="";
        foreach($result as $k)
        {
            if (!$k['picture']) {
                $k['picture'] = base_url().'uploads/img/profilePic.jpg';
            }
            if ($k['email'] == $this->session->userdata('email')) {
                $is_delete = "stdelete";
            }
            $checkPlaylist=(int)$k['music'];
            $friends.='<li><a class="inline" href="#inline_content"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a></li>';
        }
        echo $friends;
*/
        echo json_encode($result);
	}

    function getNextStatus()
    {
        $id=$this->input->post('status_id');
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result=$status->getNextStatus($this->session->userdata('email'),$id);
        echo json_encode($result);
    }

    function layDSWallStatus($email)
    {
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $result=$status->layDSWallStatus($email);
        $result= json_encode($result);
        $this->smarty->assign('items',$result);
        $this->smarty->assign('userName',$this->session->userdata('first_name').' '.$this->session->userdata('last_name'));
        $this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
        $this->smarty->assign('userLogin',$this->session->userdata('email'));
        $this->smarty->view('userWall');
    }

	public function chooseMusic(){
        if(@$_POST['music_name']) {
            $music=$_POST["music_name"];
            $music = str_replace(' ', '+', $music);
            $urlMusic="http://j.ginggong.com/jOut.ashx?k=".$music."&h=mp3.zing.vn&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
            $json = file_get_contents($urlMusic);
            $result=json_decode($json, true);
            $statuses="";
            if(count($result)>0){
                foreach($result as $k)
                {
                    $statuses.='<li class="result"><a href="#" onclick="playSelectedSong('  ."'". $k['UrlJunDownload'] ."','".$k['Title']."'". ')">' .$k['Title']. '</a></li>';
                }
            }else{
                $statuses.="<b>No Data Found</b>";
            }
            echo $statuses;
        }
    }

    public function xoaStatus(){
        $id=$this->input->post('status_id');
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $linkUrl=FCPATH.'uploads/';
        $status->xoaStatus($id,$linkUrl);
    }

    public function suaStatus(){
        $id=$this->input->post('status_id');
        $msg=$this->input->post('msg');
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $status->suaStatus($id,$msg);
    }

    public function updateStatus()
    {
        $data['status']="";
        $data['music']="";
        $data['privacy']="";
        if(trim($_POST['status'])!='')
        {
            $data['status']=$_POST["status"];
            $data['music']=$_POST["music_url"];
            $data['title']=$_POST["title"];
        }else if(trim($_POST['status3'])!=''){
            $data['status']=$_POST["status3"];
            $data['music']=$_POST["playlist_id"];
            $data['title']="";
        }
        else
        {
            if ($_FILES['musicFile']['error'] != 4) {
                $data['title']=$_FILES['musicFile']['name'];
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'mp3';
                $config['max_size'] = '10240';
                $config['file_name']  = uniqid().'.mp3'; 
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("musicFile"))
                {
                    /*$error = $this->upload->display_errors();
                    $this->smarty->assign('error',$error);
                    $this->smarty->view('upload');*/
                }
                else
                {
                    $uploaded = array('upload_data' => $this->upload->data());
                    $data['status']=$_POST["status2"];

                    //$newfilename = uniqid().$uploaded['upload_data']['file_ext'];
                    //$newFileUrl=$uploaded['upload_data']['file_path'].$newfilename;
                    //move_uploaded_file($uploaded['upload_data']["full_path"], $newFileUrl);
                    $data['music']= $config['file_name'];
                    //$data['music']=$this->config->base_url().'uploads/'.$uploaded['upload_data']['file_name'];
                }
            }
        }
        $data['privacy']=$_POST["privacy"];
        $data['email'] = $this->session->userdata('email');
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $status->themStatus($data);
        $this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
        $this->smarty->assign('userName',$this->session->userdata('first_name').' '.$this->session->userdata('last_name'));
        $this->smarty->assign('userLogin',$this->session->userdata('email'));
        $this->smarty->view('testPlayerLink');
    }

    public function hienThiNotiStatus($statusParam,$noti_id=-1){
        $em = $this->doctrine->em;
        if($noti_id!=-1){
           $noti = new Entity\NotificationDAO($em);
           $noti->setNotifyIsRead($noti_id);
        }
        $status = new Entity\statusDAO($em);
        $result=$status->laySingleStatus($statusParam);
        $result= json_encode($result);
        $this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
        $this->smarty->assign('userLogin',$this->session->userdata('email'));
        $this->smarty->assign('items',$result);
        $this->smarty->view('notiStatus');
    }
}
?>