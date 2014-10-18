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

	public function themShare(){
        if(@$_POST['status_id']) {
            $action=$_POST["rel"];
            $data['status']=$_POST["status_id"];
            $data['email'] = $this->session->userdata('email');
            $em = $this->doctrine->em;
            $like = new Entity\Thumb_up_downDAO($em);
            if(strcmp($action,"Like")==0){
                $like->themLike($data);
            }else{
                $like->xoaLike($data);
            }
        }
    }

    public function kiemTraShare(){
        $status_id=$_POST["status_id"];
        $user=$this->session->userdata('email');
        $em = $this->doctrine->em;
        $like = new Entity\Thumb_up_downDAO($em);
        $result=$like->layLikeUser($status_id,$user);
        echo json_encode($result);
    }

    public function layLike(){
        $status_id=$_POST["status_id"];
        $em = $this->doctrine->em;
        $like = new Entity\Thumb_up_downDAO($em);
        $result=$like->layLike($status_id);
        echo json_encode($result);
    }
}
?>