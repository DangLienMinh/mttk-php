<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
	}

	function player()
	{
		$this->smarty->view('updatestatus');
	}

	public function chooseMusic(){
		$musicLink="";
		if(@$_POST['music_name']) {
			$music=$_POST["music_name"];
			$music = str_replace(' ', '+', $music);
			$urlMusic="http://j.ginggong.com/jOut.ashx?k=".$music."&h=nhacso.net&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
			$json = file_get_contents($urlMusic);
			echo $json;
			/*$obj = json_decode($json);
			
			foreach ($obj as $value) {
				$new=$value->UrlJunDownload;
		  	 	$musicLink.= "<a id='a' href='#'  onclick='testXem(".json_encode($new).")'>".$value->Title."</a>";
		  	 	$musicLink.= "<br>";
			}*/
		}
		/*$this->smarty->assign('musicLink',$musicLink); 
		$this->smarty->view('player');*/
	}

	public function updateStatus()
	{
		//$music=$_POST["music_url"];
		if ($_FILES['musicFile']['error'] != 4) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'mp3';
			$config['max_size']	= '10240';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("musicFile"))
			{
				/*$error = $this->upload->display_errors();
				$this->smarty->assign('error',$error); 
				$this->smarty->view('upload');*/
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				echo $data['upload_data']['full_path'];
			}
		}
		//echo $music;
	}
}
?>