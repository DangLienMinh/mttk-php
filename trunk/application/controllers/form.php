<?php

class Form extends CI_Controller {

	public function login()
	{
		$this->smarty->view('myform');
	}
	public function search()
	{
		$this->is_logged_in();
		$this->smarty->view('searchFriend');
	}
	public function seeWall($id)
	{
		echo $id;
	}
	public function login1()
	{
		$em = $this->doctrine->em;
		$user = new Entity\UserDAO($em);
		$data['email']=$this->input->post('email_login');
		$data['password']=$this->input->post('pass_login');
		$result=$user->timUserLogin($data);
		if(count($result)>0)
		{
			$data = array('email'=>$data['email'],
                         'is_logged_in'=>true,
                         'first_name'=>$result[0]['first_name'],
                         'last_name'=>$result[0]['last_name'],
                         'birth_date'=>$result[0]['birthday']
                      );

           $this->session->set_userdata($data);
           redirect('/form/search', 'refresh');
		}
	}
	public function logout()
	{
		$this->is_logged_in();
        //$data['main_content'] = 'login';
        //$this->load->view('includes/template',$data);
        $em = $this->doctrine->em;
		$user = new Entity\UserDAO($em);
        $email = $this->session->userdata('email');
        $user->capNhatLastLogin($email);
        $this->session->sess_destroy();
        redirect('/form/login', 'refresh');
	}
	function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            echo "<h3>You don't have permission to access this page.</h3>";
            die;
        }
    }
	public function register()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		//$this->form_validation->set_rules('re_email','Confirm Email','trim|required|matches[email]');
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
		  $em = $this->doctrine->em;
		  $user = new Entity\UserDAO($em);
		  $user->themUser($data);
		}
	}
}
?>