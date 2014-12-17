<?php
class ShareController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //add new share status
    public function themShare() {
        if (@$_POST['status_id']) {
            $data['status']    = $_POST["status_id"];
            $data['message']   = $_POST["message"];
            $data['email']     = $this->session->userdata('email');
            $em                = $this->doctrine->em;
            $share             = new Entity\StatusDAO($em);
            $newStatus         = $share->themShareStatus($data);
            $data['newStatus'] = $newStatus;
            $share->notifyShare($data);
        }
    }
}
?>