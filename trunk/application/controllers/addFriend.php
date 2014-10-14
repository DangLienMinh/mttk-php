 <?php
	class AddFriend extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/login/index', 'refresh');
        }
    }

	public function index(){
		$em = $this->doctrine->em;
		$user = new Entity\UserDAO($em);
		$search=  $this->input->post('search');
		echo $user->timUser($search);
	}

	public function themBan(){
		$friend_name="";
		if(@$_POST['friendEmail']) {
			$friend_name=$_POST["friendEmail"];
			$email = $this->session->userdata('email');
			$em = $this->doctrine->em;
			$friend = new Entity\FriendDAO($em);
			$friend->themFriend($email,$friend_name);
		}
	}
}

?>