<?php

class AddressProfile extends CI_Controller {

	public function address()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
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

			//$user = $this->em->getReference('Entity\User', $data['username']);
			//$user->setPassword( $data['password']);
			//$this->em->remove($user);
			//$this->em->merge($user);
		  $this->em->persist($profile);
		  $this->em->flush();
			//$this->smarty->assign('data', $data); 
			//$this->smarty->view('index');
		}
	}
}
?>