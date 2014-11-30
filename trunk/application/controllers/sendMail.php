<?php
class sendMail extends CI_Controller {
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    public function mail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'mymusicsocial@gmail.com',
            'smtp_pass' => 'danglienminh',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $length = 6;
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        $this->email->to('danglienminh93@gmail.com');
        $this->email->from('mymusicsocial@gmail.com');
        $this->email->subject('Here is your info ');
        $this->email->message('Hi  Here is the info you requested.'.$randomString);
         if($this->email->send())
         {
          echo 'Email sent.';
         }
         else
        {
         show_error($this->email->print_debugger());
        }
    }
}
?>