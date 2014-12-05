 <?php
class ReportadminController extends CI_Controller {
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    public function addReportStatus() {
        $data['status_id']      = $_POST['status_id'];
        $data['email']    = $this->session->userdata('email');
        $data['reason'] = $_POST['reason'];
        $em              = $this->doctrine->em;
        $report         = new Entity\ReportadminDAO($em);
        $message_id      = $report->addReportStatus($data);
    }

    function viewReport($email,$name,$pic,$status) {
        $this->smarty->assign('pic', $pic);
        $result=str_replace("%20"," ",$name);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('name', $result);
        $this->smarty->assign('email', $email);
        $this->smarty->view('reportStatus');
    }

    function viewAdminPanel() {
       /* $this->smarty->assign('pic', $pic);
        $result=str_replace("%20"," ",$name);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('name', $result);
        $this->smarty->assign('email', $email);*/
        $this->smarty->view('admin');
    }

    public function getReportStatus() {
        $em           = $this->doctrine->em;
        $report      = new Entity\ReportadminDAO($em);
        $result       = $report->getReportStatus();
        $data="";
        $i=1;
        foreach ($result as $k) {
            $data .= '<tr><td>'.$i.'</td><td><a href="' . site_url('statusController/hienThiNotiStatus/') . "/" . $k['status_id'] . '">'.$k['status_id'].'</a></td><td>'.$k['email'].'</td><td>'.$k['reason'].'</td><td>'.$k['created_at'].'</td><td><a class="delete_button" rel="'.$k['report_id'].'" href="#"></a><a rel="'.$k['report_id'].'" class="accept_button" href="#"></a></td></tr>';
            $i+=1;
        }
        echo $data;
    }

    public function acceptReportRequest(){
        $report_id      = $_POST['report_id'];
        $status_id      = $_POST['status_id'];
        $user_make_report = $_POST['user'];
        $em           = $this->doctrine->em;
        $status  = new Entity\statusDAO($em);
        $linkUrl = FCPATH . 'uploads/';
        $report      = new Entity\ReportadminDAO($em);
        $report->notifyAcceptReport($status_id,$user_make_report);
        $report->solvedUserReport($report_id);
        $status->xoaStatus($status_id, $linkUrl);
    }

    public function cancelReportRequest(){
        $report_id      = $_POST['report_id'];
        $status_id      = $_POST['status_id'];
        $user_make_report = $_POST['user'];
        $em           = $this->doctrine->em;
        $report      = new Entity\ReportadminDAO($em);
        $report->notifyCancelReport($status_id,$user_make_report);
        $report->solvedUserReport($report_id);
    }
    
    /*public function getMoreMessages() {
        $em              = $this->doctrine->em;
        $data['to']      = $this->input->post('email');
        $data['from']    = $this->session->userdata('email');
        $data['started'] = $this->input->post('started');
        $message         = new Entity\MessageDAO($em);
        $result          = $message->getMoreMessages($data);
        echo json_encode($result);
    }*/
}

?>