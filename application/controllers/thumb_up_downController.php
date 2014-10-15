<?php
class Thumb_up_downController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	public function themLike(){
        if(@$_POST['textcontent']) {
            $data['message']=$_POST["textcontent"];
            $data['status']=$_POST["com_msgid"];
            $data['email'] = $this->session->userdata('email');
            $em = $this->doctrine->em;
            $comment = new Entity\CommentDAO($em);
            $comment_id=$comment->themComment($data);
            echo "<div class='load_comment'>".$_POST["textcontent"].'<a href="#" id="'.$comment_id.'" class="delete_button">X</a></div>';
        }
    }
    public function layLikeUser(){
        $status_id=$_POST["status_id"];
        $user=$this->session->userdata('email');
        $em = $this->doctrine->em;
        $like = new Entity\Thumb_up_downDAO($em);
        $result=$like->layLikeUser($status_id,$user);
        echo json_encode($result);
        //print_r($comment->layComment($status_id));
        
    }
    public function xoaLike(){
        $comment_id=$_POST["id"];
        $em = $this->doctrine->em;
        $comment = new Entity\Thumb_up_downDAO($em);
        $result=$comment->xoaComment($comment_id);
    }
}
?>