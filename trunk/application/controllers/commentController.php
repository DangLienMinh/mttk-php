<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
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
            //echo '<div class="load_comment"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px" src="'.$img.'"/><span>'.$_POST["textcontent"].'</span><a href="#" id="'.$comment_id.'" class="delete_button"></a></div>';
            echo '<li class="load_comment"><img id="' . $data['email'] . '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.$img.'"/><span>'.$_POST["textcontent"].'</span><a href="#" id="'.$comment_id.'" class="delete_button"></a><br/><abbr class="timeago" title="'.date('Y-m-d H:i:s').'"></abbr></li>';
        }
    }

    public function layAllComment(){
        $status_id=$_POST["status_id"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->layComment($status_id);
        $comments="";
        foreach($result as $k)
        {
            $is_delete = "";
            if ($k['email'] == $this->session->userdata('email')) {
                $is_delete = "delete_button";
            }
            $comments.='<li class="load_comment"><span id="' . $k['name'] . '"></span><img id="' . $k['email'] . '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.base_url().'uploads/img/'.$k['picture'].'"/><span>'.$k['message'].'</span><a href="#" id="'.$k['comment_id'].'" class="'.$is_delete.'"></a><br/><abbr class="timeago" title="'.$k['created_at'].'"></abbr></li>';
        }
        echo $comments;
    }

    public function layComment(){
        $status_id=$_POST["status_id"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->layComment($status_id);
        $comments="";
        if (count($result) > 0) {
        if(count($result)<=3){
            foreach($result as $k)
            {
                $is_delete = "";
                if ($k['email'] == $this->session->userdata('email')) {
                    $is_delete = "delete_button";
                }
                $comments.='<li class="load_comment"><span id="' . $k['name'] . '"></span><img id="' . $k['email'] . '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.base_url().'uploads/img/'.$k['picture'].'"/><span>'.$k['message'].'</span><a href="#" id="'.$k['comment_id'].'" class="'.$is_delete.'"></a><br/><abbr class="timeago" title="'.$k['created_at'].'"></abbr></li>';
            }
        }else{
            $second_count=count($result)-3;
            //$("#loadplace" + status).append('<div class="comment_ui"><a class="view_comments" id="'+status+'">View '+second_count+' more comments</a></div>');
            $comments=$second_count.'<div class="comment_ui"><a class="view_comments" id="'.$status_id.'">View '.$second_count.' more comments</a></div>';
          }
      }
      echo $comments;
        //echo json_encode($result);
    }

    public function layLastComment(){
        $status_id=$_POST["status_id"];
        $count=$_POST["count"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->layLastComment($status_id,$count);
        $comments="";
        foreach($result as $k)
        {
            $is_delete = "";
            if ($k['email'] == $this->session->userdata('email')) {
                $is_delete = "delete_button";
            }
            $comments.='<li class="load_comment"><span id="' . $k['name'] . '"></span><img id="' . $k['email'] . '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.base_url().'uploads/img/'.$k['picture'].'"/><span>'.$k['message'].'</span><a href="#" id="'.$k['comment_id'].'" class="'.$is_delete.'"></a><br/><abbr class="timeago" title="'.$k['created_at'].'"></abbr></li>';
        }
        echo $comments;
    }

    public function xoaComment(){
        $comment_id=$_POST["id"];
        $em = $this->doctrine->em;
        $comment = new Entity\CommentDAO($em);
        $result=$comment->xoaComment($comment_id);
    }
}
?>