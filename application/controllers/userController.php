<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class UserController extends CI_Controller {

    //check if user have logged in
    function index() {
        if($this->session->userdata('email')!=""){
            redirect('/','refresh');
        }else{
            $this->smarty->view('login');
        }
        //echo FCPATH;
    }

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    //login
    public function login1() {
        $this->form_validation->set_rules('email_login', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass_login', 'Password', 'trim|required|md5|callback_checkLoginInfo');
        
        if ($this->form_validation->run() == FALSE) {
            $this->smarty->view('login');
        }
    }
    
    //logout
    public function logout() {
        $em    = $this->doctrine->em;
        $user  = new Entity\UserDAO($em);
        $email = $this->session->userdata('email');
        $user->capNhatLastLogin($email);
        $this->session->sess_destroy();
        redirect('/userController/index', 'refresh');
    }
    public function register() {
         if($this->session->userdata('email')!=""){
            redirect('/','refresh');
        }else{
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
                    'password' => $data['password'],
                    'birth_date' => $data['birthday']
                );
                
                $this->session->set_userdata($data);
                redirect('/main/firstTime', 'refresh');
            }
        }
    }
    
    //check email
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

    //change password
    public function suaPassword(){
        $pass=$this->input->post('pass');
        $em               = $this->doctrine->em;
        $user             = new Entity\UserDAO($em);
        $user->suaPassword($this->session->userdata('email'),md5($pass));
    }

    //view change password page
    public function viewSuaPassword()
    {
        $this->smarty->assign('password', $this->session->userdata('password'));
        $this->smarty->view('changePassword');
    }

    //check login information ->form validation
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
                'password' => $data['password'],
                'birth_date' => $result[0]['birthday']
            );

            $this->session->set_userdata($data);
            if($result[0]['email']=='admin@socialmusic.com'){
                redirect('/reportadminController/viewAdminPanel', 'refresh');
            }else{
                if ($result[0]['picture'] != '')
                    redirect('/', 'refresh');
                else
                    redirect('/main/firstTime', 'refresh');
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('checkLoginInfo', 'Sorry your email or password is not correct');
            return FALSE;
        }
    }
}
?>