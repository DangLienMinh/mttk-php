<?php
class CommentController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	public function themComment(){
        if(@$_POST['textcontent']) {
            $data['message']=$_POST["textcontent"];
            $data['status']=$_POST["com_msgid"];
            $data['email'] = $this->session->userdata('email');
            $em = $this->doctrine->em;
            $comment = new Entity\CommentDAO($em);
            //$comment->themComment($data);
            echo "<div class='load_comment'>".$_POST["textcontent"]."</div>";
        }
    }
}
?>