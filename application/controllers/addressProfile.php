<?php

class AddressProfile extends CI_Controller {

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
			//$this->smarty->assign('data', $data); 
			//$this->smarty->view('index');
		}
	}
}
?>