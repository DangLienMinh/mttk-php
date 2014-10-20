<?php

class ProfileController extends CI_Controller {

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

    function firstTime()
    {
          $data['address']=$this->input->post('address');
          $img=$this->input->post('image');
          $parts = explode(',',$img);
          $pic = base64_decode($parts[1]);
          $data['pic']=uniqid() . '.png';
          $file=FCPATH.'uploads\\img\\'.$data['pic'];
          $success = file_put_contents($file,$pic);
          $data['email'] = $this->session->userdata('email');
          $em = $this->doctrine->em;
          $profile = new Entity\ProfileDAO($em);
          $profile->themProfile($data);
          $this->session->set_userdata('pic', $data['pic']);
          echo base_url('/main/player');
    }
    /*private function upload_pic($img)
    {
        $config['upload_path'] = './uploads/img';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width']  = '1024';
        $config['max_height']  = '1024';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;
        if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload($img))
            {
                return $this->upload->display_errors();
            }
            else
            {
                $uploaded = array('upload_data' => $this->upload->data());
                return $this->config->base_url().'uploads/img/'.$uploaded['upload_data']['file_name'];
            }
    }*/
}
?>