<?php
class Thumb_up_downController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //add or remove like
    public function themXoaLike() {
        if (@$_POST['status_id']) {
            $action         = $_POST["rel"];
            $data['status'] = $_POST["status_id"];
            $data['email']  = $this->session->userdata('email');
            $em             = $this->doctrine->em;
            $like           = new Entity\Thumb_up_downDAO($em);
            if (strcmp($action, "Like") == 0) {
                $like->themLike($data);
            } else {
                $like->xoaLike($data);
            }
        }
    }
    
    //check if user like the status
    public function layLikeUser() {
        $status_id = $_POST["status_id"];
        $user      = $this->session->userdata('email');
        $em        = $this->doctrine->em;
        $like      = new Entity\Thumb_up_downDAO($em);
        $result    = $like->layLikeUser($status_id, $user);
        echo json_encode($result);
    }
    
    //get all the like of the status
    public function layLike() {
        $status_id = $_POST["status_id"];
        $user      = $this->session->userdata('email');
        $em        = $this->doctrine->em;
        $like      = new Entity\Thumb_up_downDAO($em);
        $result    = $like->layLike($status_id, $user);
        echo json_encode($result);
    }
}
?>