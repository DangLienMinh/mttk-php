<?php

class Form extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->load->view('myform');
			$this->smarty->assign('errors',validation_errors()); 
			 $this->smarty->view('myform');
		}
		else
		{
		  $data['username']=$this->input->post('username');
		  $data['password']=$this->input->post('password');
		  $this->em = $this->doctrine->em;

	        $user = new Entity\User;

			$user->setUsername($data['username']);
			$user->setPassword( $data['password']);
			$this->em->persist($user);
			$this->em->flush();
			$this->smarty->view('index');
		}
	}

	public function username_check($str)
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
	}

}
?>