<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
class CommentController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //add new comment by ajax
    public function themComment() {
        if (@$_POST['textcontent']) {
            //get message
            $data['message'] = $_POST["textcontent"];

            //get status user comment on
            $data['status']  = $_POST["com_msgid"];

            //get user email in session
            $data['email']   = $this->session->userdata('email');
            $img             = uploads_url() . 'img/' . $this->session->userdata('pic');
            $em              = $this->doctrine->em;
            $comment         = new Entity\CommentDAO($em);
            $comment_id      = $comment->themComment($data);

            //ajax add comment to status
            echo '<li class="load_comment"><img class="loginUser" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . $img . '"/><span>' . $_POST["textcontent"] . '</span><a href="#" id="' . $comment_id . '" class="delete_button"></a><br/><abbr class="timeago" title="' . date('Y-m-d H:i:s') . '"></abbr></li>';
        }
    }
    
    //get all the comment in status
    public function layAllComment() {
        //get status by POST method
        $status_id = $_POST["status_id"];
        $em        = $this->doctrine->em;
        $comment   = new Entity\CommentDAO($em);
        $result    = $comment->layComment($status_id);
        $comments  = "";
        //loop through each comment in status
        foreach ($result as $k) {
            $is_delete = "";

            //check if current user create comment so they can delete comment
            if ($k['email'] == $this->session->userdata('email')) {
                $is_delete = "delete_button";
                $id="loginUser";
            }else{
                $id="friend";
            }

            //ajax add comment 
            $comments .= '<li class="load_comment"><span id="' . $k['name'] . '"></span><img class="' . $id. '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span>' . $k['message'] . '</span><a href="#" id="' . $k['comment_id'] . '" class="' . $is_delete . '"></a><br/><abbr class="timeago" title="' . $k['created_at'] . '"></abbr></li>';
        }
        echo $comments;
    }
    
    //get comment in the status
    public function layComment() {
        //get status by POST method
        $status_id = $_POST["status_id"];
        $em        = $this->doctrine->em;
        $comment   = new Entity\CommentDAO($em);
        $result    = $comment->layComment($status_id);
        $comments  = "";
        if (count($result) > 0) {
            //check if comment in status <=3
            if (count($result) <= 3) {
                //loop through each comment
                foreach ($result as $k) {
                    $is_delete = "";
                     //check if current user create comment so they can delete comment
                    if ($k['email'] == $this->session->userdata('email')) {
                        $is_delete = "delete_button";
                        $id="loginUser";
                    }else{
                        $id="friend";
                    }
                    //ajax add comment 
                    $comments .= '<li class="load_comment"><span id="' . $k['name'] . '"></span><img class="' . $id. '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span>' . $k['message'] . '</span><a href="#" id="' . $k['comment_id'] . '" class="' . $is_delete . '"></a><br/><abbr class="timeago" title="' . $k['created_at'] . '"></abbr></li>';
                }
            // if comment in status >3
            } else {
                //save number of more comment
                $second_count = count($result) - 3;
                //add a link to view all comments of the status
                $comments     = $second_count . '<div class="comment_ui"><a class="view_comments" id="' . $status_id . '">View ' . $second_count . ' more comments</a></div>';
            }
        }
        echo $comments;
    }
    
    //get the latest comment in status if greater than 3
    public function layLastComment() {
        //get status by POST method
        $status_id = $_POST["status_id"];
        //get second count
        $count     = $_POST["count"];

        $em        = $this->doctrine->em;
        $comment   = new Entity\CommentDAO($em);
        $result    = $comment->layLastComment($status_id, $count);
        $comments  = "";
        foreach ($result as $k) {
            $is_delete = "";
            //check if current user create comment so they can delete comment
            if ($k['email'] == $this->session->userdata('email')) {
                $is_delete = "delete_button";
                $id="loginUser";
            }else{
                $id="friend";
            }
            //ajax add comment 
            $comments .= '<li class="load_comment"><span id="' . $k['name'] . '"></span><img class="' . $id. '" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span>' . $k['message'] . '</span><a href="#" id="' . $k['comment_id'] . '" class="' . $is_delete . '"></a><br/><abbr class="timeago" title="' . $k['created_at'] . '"></abbr></li>';
        }
        echo $comments;
    }
    
    //ajax delete comment
    public function xoaComment() {
        $comment_id = $_POST["id"];
        $em         = $this->doctrine->em;
        $comment    = new Entity\CommentDAO($em);
        $result     = $comment->xoaComment($comment_id);
    }
}
?>