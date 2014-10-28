<?php
class CommentController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

	public function themComment(){
        if(@$_POST['textcontent']) {
            $data['message']=$_POST["textcontent"];
            $data['status']=$_POST["com_msgid"];
            $data['email'] = $this->session->userdata('email');
            $img=uploads_url().'img/'.$this->session->userdata('pic');
            $em = $this->doctrine->em;
            $comment = new Entity\CommentDAO($em);
            $comment_id=$comment->themComment($data);
            echo '<div class="load_comment"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px" src="'.$img.'"/><span>'.$_POST["textcontent"].'</span><a href="#" id="'.$comment_id.'" class="delete_button"></a></div>';
        }
    }
    public function layComment(){
        $status_id=$_POST["status_id"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->layComment($status_id);
        echo json_encode($result);
    }

    public function layLastComment(){
        $status_id=$_POST["status_id"];
        $count=$_POST["count"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->layLastComment($status_id,$count);
        echo json_encode($result);
        
    }

    public function xoaComment(){
        $comment_id=$_POST["id"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->xoaComment($comment_id);
    }
}
?>