<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class UserController extends CI_Controller {
    function index() {
        $this->smarty->view('login');
    }
    
    public function login1() {
        $this->form_validation->set_rules('email_login', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass_login', 'Password', 'trim|required|md5|callback_checkLoginInfo');
        
        if ($this->form_validation->run() == FALSE) {
            $this->smarty->view('login');
        }
    }
    public function logout() {
        $em    = $this->doctrine->em;
        $user  = new Entity\UserDAO($em);
        $email = $this->session->userdata('email');
        $user->capNhatLastLogin($email);
        $this->session->sess_destroy();
        redirect('/userController/index', 'refresh');
    }
    public function register() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        $this->form_validation->set_rules('re_password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('first_name', 'First_name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last_name', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->smarty->view('login');
        } else {
            $data['email']      = $this->input->post('email');
            $data['password']   = $this->input->post('password');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name']  = $this->input->post('last_name');
            $data['birthday']   = $this->input->post('birthday');
            $em                 = $this->doctrine->em;
            $user               = new Entity\UserDAO($em);
            $user->themUser($data);
            $data = array(
                'email' => $data['email'],
                'is_logged_in' => true,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'birth_date' => $data['birthday']
            );
            $this->session->set_userdata($data);
            redirect('/main/firstTime', 'refresh');
        }
    }
    
    public function email_check($str) {
        $em       = $this->doctrine->em;
        $user     = new Entity\UserDAO($em);
        $userInfo = $user->getUser($str);
        
        if (empty($userInfo)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', 'The %s is already registered');
            return FALSE;
        }
    }
    
    public function checkLoginInfo() {
        $data['email']    = $this->input->post('email_login');
        $data['password'] = $this->input->post('pass_login');
        $em               = $this->doctrine->em;
        $user             = new Entity\UserDAO($em);
        $result           = $user->timUserLogin($data);
        if (count($result) > 0) {
            $data = array(
                'email' => $data['email'],
                'is_logged_in' => true,
                'first_name' => $result[0]['first_name'],
                'pic' => $result[0]['picture'],
                'last_name' => $result[0]['last_name'],
                'birth_date' => $result[0]['birthday']
            );
            
            $this->session->set_userdata($data);
            if ($result[0]['picture'] != '')
                redirect('/main/homePage', 'refresh');
            else
                redirect('/main/firstTime', 'refresh');
            return TRUE;
        } else {
            $this->form_validation->set_message('checkLoginInfo', 'Sorry your email or password is not correct');
            return FALSE;
        }
    }
}
?>