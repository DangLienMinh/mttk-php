 <?php
	class FriendController extends CI_Controller {
	function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in!=true)
        {
            redirect('/userController/index', 'refresh');
        }
    }

	public function index(){
		$em = $this->doctrine->em;
		$user = new Entity\UserDAO($em);
		$search=  $this->input->post('search');
		$result=$user->timUser($search);
        //echo json_encode($result);
        $friends="";
        if(count($result)>0){
        	foreach($result as $k)
	        {
	            $friends.='<div class="display_box" align="left"><img src="'.base_url().'uploads/img/'.$k['picture'].'" style="max-width:80%; max-height:80%; float:left; margin-right:6px" /><a href="seeWall/'. $k['email'] . '">' . $k['first_name']." ".$k['last_name'] . '</a><button type="button" class="addFriend" value="' . $k['email'] . '">'.'Add friend</button></div>';
	        }
        }else{
        	$friends.="<b>No Data Found</b>";
        }
        echo $friends;
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

	public function getAllFriends()
	{
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
		$friend = new Entity\FriendDAO($em);
		$result=$friend->getAllFriends($email);
        //echo json_encode($result);
        $friends="";
        foreach($result as $k)
        {
            $friends.='<li><a class="inline" href="#inline_content"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a><button rel="'.$k['email'].'">Unfriend</button></li>';
        }
        echo $friends;
	}

	public function getAllChatFriends()
	{
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
		$friend = new Entity\FriendDAO($em);
		$result=$friend->getAllFriends($email);
        //echo json_encode($result);
        $friends="";
        foreach($result as $k)
        {
            $friends.='<li><a class="inline" href="#inline_content"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="'.$k['email'].'">' . $k['name'] . '</span></a></li>';
        }
        echo $friends;
	}

	public function getSuggestedFriend()
	{
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
		$friend = new Entity\FriendDAO($em);
		$result=$friend->getSuggestedFriend($email);
		$friends="";
		$i=1;
        if(count($result)>0){
        	foreach($result as $k)
	        {
	            $friends.='<li id="list'.$i.'"><img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="' .base_url().'uploads/img/'.$k['picture']. '"/><span class="del"><a href="#" class="delete" id="'.$i.'">X</a></span><a href="" class="user-title">'.$k['name'].'</a><button type="button" class="addFriend" value="' . $k['email'] . '">'.'Add friend</button></li>';
	        	++$i;
	        }
        }
        echo $friends;
        //echo json_encode($result);
	}


	public function getFriendRequest()
	{
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
		$friend = new Entity\FriendDAO($em);
		$result=$friend->getFriendRequest($email);
        $friends="";
        $dem=0;
        foreach($result as $k)
        {
        	if($dem<6){
        		$friends.='<li style="background:#f4f6f9"  class="noti"><a href="' .site_url('statusController/layDSWallStatus/')."/".$k['email'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'.base_url().'uploads/img/'.$k['picture'].'"/><span>' . $k['name'] . '</span></a><div class="friendAction"><button id="friendAccept" onClick="window.location.href='."'".site_url('friendController/'). "/acceptFriendRequest/" . $k['email'] ."'".'">Accept</button><button id="friendDecline" onClick="window.location.href='."'".site_url('friendController/'). "/removeFriendRequest/" . $k['email'] ."'".'">Decline</button></div></li>';
        		$dem=$dem+1;
        	}
        }
        if(count($result)>0){
        	echo count($result).$friends;
        }else{
        	echo $friend;
        }
	}

	public function acceptFriendRequest($friendName)
	{
        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
        $friend = new Entity\FriendDAO($em);
		$friend->acceptFriend($email,$friendName);
		$this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
		$this->smarty->view('testPlayerLink');
		
	}

	public function removeFriendRequest($friendName)
	{

        $em = $this->doctrine->em;
        $email = $this->session->userdata('email');
		$friend = new Entity\FriendDAO($em);
		$friend->declineFriend($email,$friendName);
		$this->smarty->assign('userPicCmt',$this->session->userdata('pic'));
		$this->smarty->view('testPlayerLink');
	}
}

?>