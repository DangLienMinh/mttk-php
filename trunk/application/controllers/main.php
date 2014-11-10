<?php

class Main extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

    function clearCache(){
    	$this->smarty->clearAllCache();
    }

	function firstTime()
	{
		$this->smarty->view('signUpInfo');
	}

	function player()
	{
		$this->smarty->view('addFanclub');
	}
	public function search()
	{
		$this->smarty->view('searchFriend');
	}
	public function chat()
	{
		$this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
		$this->smarty->assign('userLogin',$this->session->userdata('email'));
		$this->smarty->assign('userName',$this->session->userdata('first_name').' '.$this->session->userdata('last_name'));
		$this->smarty->view('chat');
	}
	public function testPlayer()
	{
		$this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
		$this->smarty->assign('userName',$this->session->userdata('first_name').' '.$this->session->userdata('last_name'));
		$this->smarty->assign('userLogin',$this->session->userdata('email'));
		$this->smarty->view('testPlayerLink');
	}
	public function seeWall($id)
	{
		echo $id;
	}
}
?>