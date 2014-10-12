<?php

class Main extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	function firstTime()
	{
		$this->smarty->view('signUpInfo');
	}

	function player()
	{
		$this->smarty->view('updatestatus');
	}
	public function search()
	{
		$this->smarty->view('searchFriend');
	}
	public function seeWall($id)
	{
		echo $id;
	}
}
?>