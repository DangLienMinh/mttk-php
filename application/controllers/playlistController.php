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

    function getDSSongs(){
        $id=$this->input->post('playlist_id');
        $em = $this->doctrine->em;
        $playlist = new Entity\Playlist_detailDAO($em);
        $result=$playlist->layPlaylistSongs($id);
        echo json_encode($result);
    }

    function createPlaylist(){
        $em = $this->doctrine->em;
        $playlist = new Entity\PlaylistDAO($em);
        $data['playlistName']=$this->input->post('playlistName');
        $data['email']=$this->session->userdata('email');
        $data['privacy']=1;
        $playlist->createPlaylist($data);
    }

    function addMusic(){
        $em = $this->doctrine->em;
        $playlist_detail = new Entity\Playlist_detailDAO($em);
        if(!empty($this->input->post('h'))){
            $data['id']=$this->input->post('playlist_id');
            $data['title']=$this->input->post('title');
            $data['music']=$this->input->post('music').'&h='.$this->input->post('h');
        }else{
            $data['id']=$this->input->post('playlist_id');
            $data['title']=$this->input->post('title');
            $data['music']=$this->input->post('music');
        }
        
        $playlist_detail->addMusic($data);
    }

    function viewPlaylist(){
        $this->smarty->view('createPlaylist');
    }

}
?>