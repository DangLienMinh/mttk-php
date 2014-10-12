<?php
class StatusController extends CI_Controller {
    private $musicURL;

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
        $musicURL="";
    }

	function index()
	{
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $status->layDSStatus($this->session->userdata('email'));
	}

	public function chooseMusic(){
        $musicLink="";
        if(@$_POST['music_name']) {
            $music=$_POST["music_name"];
            $music = str_replace(' ', '+', $music);
            $urlMusic="http://j.ginggong.com/jOut.ashx?k=".$music."&h=mp3.zing.vn&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
            $json = file_get_contents($urlMusic);
            echo $json;
        }
    }

    /*public function chooseMusic(){
        $musicLink="";
        if(@$_POST['music_name']) {
            $music=$_POST["music_name"];
            $music = str_replace(' ', '+', $music);
            $urlMusic="http://j.ginggong.com/jOut.ashx?k=em"."&h=nhacso.net&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
            $json = file_get_contents($urlMusic);
            $json = json_decode($content, true);
            foreach($json as $i){
                echo $i['UrlJunDownload'];
            }
        }
    }*/

    public function updateStatus()
    {
        $data['status']="";
        $data['music']="";
        $data['privacy']="";
        if(trim($_POST['status'])!='')
        {
            $data['status']=$_POST["status"];
            $data['music']=$_POST["music_url"];
        }
        else
        {
            if ($_FILES['musicFile']['error'] != 4) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'mp3';
                $config['max_size'] = '10240';

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
                    $data['music']=$uploaded['upload_data']['full_path'];
                }
            }
        }
        $data['privacy']=$_POST["privacy"];
        $data['email'] = $this->session->userdata('email');
        $em = $this->doctrine->em;
        $status = new Entity\statusDAO($em);
        $status->themStatus($data);
    }
}
?>