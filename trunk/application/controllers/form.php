<?php

class Form extends CI_Controller {

	public function login()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->smarty->view('myform');
		
	}
	public function login1(){
		$this->load->helper('url');
		if($this->input->post('email_login')=='minh'){
			$this->load->view('formsuccess');
		}else{
			echo $this->input->post('pass_login');
		}
	}
	public function register()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
		$this->form_validation->set_rules('first_name', 'First_name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last_name', 'trim|required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			 $this->smarty->view('myform');
		}
		else
		{
		  $data['email']=$this->input->post('email');
		  $data['password']=$this->input->post('password');
		  $data['first_name']=$this->input->post('first_name');
		  $data['last_name']=$this->input->post('last_name');
		  $data['birthday']=$this->input->post('birthday');
		  $this->em = $this->doctrine->em;

	      $user = new Entity\User;

		  $user->setEmail($data['email']);
		  $user->setPassword($data['password']);
		  $user->setFirst_name($data['first_name']);
		  $user->setLast_name($data['last_name']);
		  $user->setBirthday($data['birthday']);

			//$user = $this->em->getReference('Entity\User', $data['username']);
			//$user->setPassword( $data['password']);
			//$this->em->remove($user);
			//$this->em->merge($user);
		  $this->em->persist($user);
		  $this->em->flush();
			//$this->smarty->assign('data', $data); 
			//$this->smarty->view('index');
		}
	}

	/*public function username_check($str)
	{
		if ($str == 'test')
		{
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}*/

}
?>