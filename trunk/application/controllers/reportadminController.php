 <?php
class ReportadminController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
        $this->load->library('pagination');
    }
    
    //add new status report
    public function addReportStatus() {
        $data['status_id']      = $_POST['status_id'];
        $data['email']    = $this->session->userdata('email');
        $data['reason'] = $_POST['reason'];
        $em              = $this->doctrine->em;
        $report         = new Entity\ReportadminDAO($em);
        $message_id      = $report->addReportStatus($data);
    }

    //view report status site
    function viewReport($email,$name,$pic,$status) {
        $this->smarty->assign('pic', $pic);
        $result=str_replace("%20"," ",$name);
        $this->smarty->assign('status', $status);
        $this->smarty->assign('name', $result);
        $this->smarty->assign('email', $email);
        $this->smarty->view('reportStatus');
    }

    //view admin panel site
    function viewAdminPanel() {
        $em              = $this->doctrine->em;
        $report         = new Entity\ReportadminDAO($em);
        $userNumber    = $report->getDayNewUser();
        $reportNumber    = $report->getDayNewReport();
        $statusNumber    = $report->getDayNewStatus();
        $fanclubNumber    = $report->getDayNewFanclub();
        $userGraph      =$report->getUserGraph();
        $fanclubGraph      =$report->getFanclubGraph();
        $statusGraph      =$report->getStatusGraph();
        $genderGraph      =$report->getGenderGraph();
        $this->smarty->assign('statusReportUrl',site_url('reportadminController/viewAdminReportStatus'));
        $this->smarty->assign('userReportUrl',site_url('reportadminController/viewAdminUserReport'));
        $this->smarty->assign('indexReportUrl',site_url('reportadminController/viewAdminPanel'));
        $this->smarty->assign('logout',site_url('userController/logout'));
        $this->smarty->assign('userGraph',json_encode($userGraph));
        $this->smarty->assign('fanclubGraph',json_encode($fanclubGraph));
        $this->smarty->assign('statusGraph',json_encode($statusGraph));
        $this->smarty->assign('genderGraph',json_encode($genderGraph));
        $this->smarty->assign('userNumber',$userNumber[0]['soUser']);
        $this->smarty->assign('reportNumber',$reportNumber[0]['soReport']);
        $this->smarty->assign('statusNumber',$statusNumber[0]['soStatus']);
        $this->smarty->assign('fanclubNumber',$fanclubNumber[0]['soFanclub']);
        $this->smarty->view('adminIndex');
    }

    //view admin report status site
    public function viewAdminReportStatus(){
        $em           = $this->doctrine->em;
        $report      = new Entity\ReportadminDAO($em);

        $config['base_url'] = base_url()."reportadminController/viewAdminReportStatus";
        $config['total_rows'] = $report->count_report();
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $choice =$config['total_rows'] / $config['per_page'];
        $config['num_links'] = $choice;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page=0;
        if($this->uri->segment(3)!=""){
            $page=$this->uri->segment(3);
        }else{
            $page=0;
        }
        
        $result=$report->fetch_report_pagination($page,$config["per_page"]);
        $data="";
        $i=$page+1;
        foreach ($result as $k) {
            $data .= '<tr><td>'.$i.'</td><td><a href="' . site_url('statusController/hienThiNotiStatus/') . "/" . $k->getStatus_id()->getStatus_id() . '">'.$k->getStatus_id()->getStatus_id().'</a></td><td>'.$k->getEmail()->getEmail().'</td><td>'.$k->getReason().'</td><td>'.$k->getCreated_at()->format('Y-m-d H:i:s').'</td><td><a class="delete_button" rel="'.$k->getReport_id().'" href="#"></a><a rel="'.$k->getReport_id().'" class="accept_button" href="#"></a></td></tr>';
            $i+=1;
        }
        $this->smarty->assign('statusReportUrl',site_url('reportadminController/viewAdminReportStatus'));
        $this->smarty->assign('userReportUrl',site_url('reportadminController/viewAdminUserReport'));
        $this->smarty->assign('indexReportUrl',site_url('reportadminController/viewAdminPanel'));
        $this->smarty->assign('logout',site_url('userController/logout'));
        $this->smarty->assign('results',$data);
        $this->smarty->assign('links',$this->pagination->create_links());
        $this->smarty->view('admin');
        
    }

    //accept user report status
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

    //cancel user report status
    public function cancelReportRequest(){
        $report_id      = $_POST['report_id'];
        $status_id      = $_POST['status_id'];
        $user_make_report = $_POST['user'];
        $em           = $this->doctrine->em;
        $report      = new Entity\ReportadminDAO($em);
        $report->notifyCancelReport($status_id,$user_make_report);
        $report->solvedUserReport($report_id);
    }

    //remove user
    public function removeUser(){
        $email = $_POST['email'];
        $em           = $this->doctrine->em;
        $user      = new Entity\UserDAO($em);
        $user->xoaUser($email);
    }

    //;view user mange site
    public function viewAdminUserReport(){
        $em           = $this->doctrine->em;
        $report      = new Entity\ReportadminDAO($em);

        $config['base_url'] = base_url()."reportadminController/viewAdminUserReport";
        $config['total_rows'] = $report->count_user();
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $choice =$config['total_rows'] / $config['per_page'];
        $config['num_links'] = $choice;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page=0;
        if($this->uri->segment(3)!=""){
            $page=$this->uri->segment(3);
        }else{
            $page=0;
        }
        
        $result=$report->fetch_user_pagination($page,$config["per_page"]);
        $data="";
        $i=$page+1;
        foreach ($result as $k) {
            $data .= '<tr><td>'.$i.'</td><td><a href="' . site_url('statusController/layDSWallStatus/') . "/" . $k->getEmail(). '">'.$k->getEmail().'</a></td><td>'.$k->getFirst_name().' '.$k->getLast_name().'</td><td>'.$k->getCreated_at()->format('Y-m-d H:i:s').'</td><td>'.$k->getLast_login()->format('Y-m-d H:i:s').'</td><td><a class="delete_button" rel="'.$k->getEmail().'" href="#"></a><a rel="'.$k->getEmail().'" class="accept_button" href="#"></a></td></tr>';
            $i+=1;
        }
        $this->smarty->assign('statusReportUrl',site_url('reportadminController/viewAdminReportStatus'));
        $this->smarty->assign('userReportUrl',site_url('reportadminController/viewAdminUserReport'));
        $this->smarty->assign('indexReportUrl',site_url('reportadminController/viewAdminPanel'));
        $this->smarty->assign('logout',site_url('userController/logout'));
        $this->smarty->assign('results',$data);
        $this->smarty->assign('links',$this->pagination->create_links());
        $this->smarty->view('userReport');
    }
}
?>