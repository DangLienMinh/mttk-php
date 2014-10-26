 <?php
	class MessageController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	public function index(){
	}

	public function addMessage(){
		$data['to']=$this->input->post('email');
		$data['from'] = $this->session->userdata('email');
		$data['message'] = $this->input->post('message');
		$img=uploads_url().'img/'.$this->session->userdata('pic');
		$name=$this->session->userdata('first_name').' '.$this->session->userdata('last_name');
		$em = $this->doctrine->em;
		$message = new Entity\MessageDAO($em);
		$message_id=$message->addMessage($data); 
		echo '<li  id="'.$message_id.'"><img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="'.$img.'"/><b>'.$name."</b>: ".$data['message']."</li>";

	}

	public function getFirstMessages()
	{
        $em = $this->doctrine->em;
      	$data['to']=$this->input->post('email');
      	$data['from'] = $this->session->userdata('email');
		$message = new Entity\MessageDAO($em);
		$result=$message->getFirstMessages($data);
        echo json_encode($result);
	}

	public function getMoreMessages()
	{
        $em = $this->doctrine->em;
      	$data['to']=$this->input->post('email');
      	$data['from'] = $this->session->userdata('email');
      	$data['started']=$this->input->post('started');
		$message = new Entity\MessageDAO($em);
		$result=$message->getFirstMessages($data);
        echo json_encode($result);
	}
}

?>