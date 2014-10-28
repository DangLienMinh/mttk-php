<?php

class ProfileController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
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
  }
?>