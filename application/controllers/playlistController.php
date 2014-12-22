<?php

class PlaylistController extends CI_Controller {
    
    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //get all playlists name of user
    function getDSPlaylist() {
        $em        = $this->doctrine->em;
        $playlist  = new Entity\PlaylistDAO($em);
        $result    = $playlist->layDSPlaylist($this->session->userdata('email'));
        $playlists = "";
        foreach ($result as $k) {
            $playlists .= '<option value="' . $k['Playlist_id'] . '">' . $k['Playlist_name'] . '</option>';
        }
        echo $playlists;
    }

    //playlist report
    function getPlaylistReport() {
        $em        = $this->doctrine->em;
        $playlist  = new Entity\PlaylistDAO($em);
        $result    = $playlist->layDSPlaylist($this->session->userdata('email'));
        $playlists = "";
        //$playlists.='<div class="fanclubUserBox" align="left"><a href="http://localhost:81/mttk-php/fanclubController/createFanclub" class="iframe cboxElement">Create new fanclub</a></div>';
        foreach ($result as $k) {
            $playlists .= '<div class="playlistReportBox" align="left"><img src="' . base_url() . 'assets/img/playlistIconSmall.png" style="width:15px; height:15px; float:left; margin-right:6px" /><a href="#">' . $k['Playlist_name'] . '</a></div>';
            //$playlists .= '<option value="' . $k['Playlist_id'] . '">' . $k['Playlist_name'] . '</option>';
        }
        echo $playlists;
    }
    
    //get all playlist with songs in user wall
    function wallDsPlaylist() {
        $em       = $this->doctrine->em;
        $playlist = new Entity\PlaylistDAO($em);
        $result   = $playlist->layDSPlaylist($this->input->post('email'));
        echo json_encode($result);
    }
    
    //get all songs of playlist
    function getDSSongs() {
        $id       = $this->input->post('playlist_id');
        $em       = $this->doctrine->em;
        $playlist = new Entity\Playlist_detailDAO($em);
        $result   = $playlist->layPlaylistSongs($id);
        echo json_encode($result);
    }
    
    //create new playlist
    function createPlaylist() {
        $em                   = $this->doctrine->em;
        $playlist             = new Entity\PlaylistDAO($em);
        $data['playlistName'] = $this->input->post('playlistName');
        $data['email']        = $this->session->userdata('email');
        $data['privacy']      = 1;
        $playlist->createPlaylist($data);
        echo base_url('/');
    }
    
    //remove a playlist
    function removePlaylist() {
        $em          = $this->doctrine->em;
        $playlist    = new Entity\PlaylistDAO($em);
        $playlist_id = $this->input->post('playlist_id');
        $playlist->removePlaylist($playlist_id);
    }
    
    //add new song to playlist
    function addMusic() {
        $em              = $this->doctrine->em;
        $playlist_detail = new Entity\Playlist_detailDAO($em);
        //check if song  is a link from other site
        if (!empty($this->input->post('h'))) {
            $data['id']    = $this->input->post('playlist_id');
            $data['title'] = $this->input->post('title');
            $data['music'] = $this->input->post('music') . '&h=' . $this->input->post('h');
        } else {
            $data['id']    = $this->input->post('playlist_id');
            $data['title'] = $this->input->post('title');
            $data['music'] = $this->input->post('music');
        }
        $playlist_detail->addMusic($data);
    }
    
    //view create playlist site
    function viewPlaylist() {
        $this->smarty->view('createPlaylist');
    }
    
}
?>