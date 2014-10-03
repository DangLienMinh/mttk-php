<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->smarty->assign('error',' ' ); 
		$this->smarty->view('upload');
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'mp3';
		$config['max_size']	= '10240';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = $this->upload->display_errors();
			$this->smarty->assign('error',$error); 
			$this->smarty->view('upload');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			echo $data['upload_data']['full_path'];
			
		}
	}
}
?>