<?php

class AddressProfile extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }
	public function address()
	{
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->smarty->view('address');
		}
		else{

		  $data['address']=$this->input->post('address');
		  $this->em = $this->doctrine->em;
		  $user = $this->em->getReference('Entity\User', 'minh');
		  $privacy = $this->em->getReference('Entity\Privacy_type', 2);
	      $profile = new Entity\Profile;

		  $profile->setEmail($user);
		  $profile->setPrivacy_type_id($privacy);
		  $profile->setAddress($data['address']);

		  $this->em->persist($profile);
		  $this->em->flush();
		}
	}
}
?>