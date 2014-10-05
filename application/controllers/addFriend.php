 <?php
	class AddFriend extends CI_Controller {

	public function index(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$em = $this->doctrine->em;
		$user = new Entity\UserDAO($em);
		$search=  $this->input->post('search');
		echo $user->searchUser($search);
	}
}

?>