<?php

class Form extends CI_Controller {

	public function login()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->smarty->view('myform');
	}
	public function search()
	{
		$this->smarty->view('searchFriend');
	}
	public function seeWall($id)
	{
		echo $id;
	}
	public function login1(){
		$this->load->helper('url');
		if($this->input->post('email_login')=='minh'){
			$this->load->view('formsuccess');
		}else{
			/*$data = array('email'=>$this->input->post('email'),
                         'is_logged_in'=>true,
                         'first_name'=>$result[0]->first_name,
                         'last_name'=>$result[0]->last_name,
                         'gender'=>$result[0]->gender,
                         'birth_date'=>$result[0]->birth_date
                      );
           
           $this->session->set_userdata($data);
           redirect('profile');*/
		}
	}
	public function logout()
	{
		/*$this->session->sess_destroy();
        $data['main_content'] = 'login';
        $this->load->view('includes/template',$data);
		*/
	}
	function is_logged_in()
        {
            $is_logged_in = $this->session->userdata('is_logged_in');
            if(!isset($is_logged_in) || $is_logged_in!=true){
                echo "<h3>You don't have permission to access this page.</h3>";
                die;
            }
        }
	public function register()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

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
		  //$user->xoaUser('a@gmail.com');

		  

			//$user = $this->em->getReference('Entity\User', $data['username']);
			//$user->setPassword( $data['password']);
			//$this->em->remove($user);
			//$this->em->merge($user);
		  //$this->em->persist($user);
		  //$this->em->flush();
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