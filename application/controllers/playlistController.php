<?php

class PlaylistController extends CI_Controller {

	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

    function getDSPlaylist(){
        $em = $this->doctrine->em;
        $playlist = new Entity\PlaylistDAO($em);
        $result=$playlist->layDSPlaylist($this->session->userdata('email'));
        echo json_encode($result);
    }

}
?>