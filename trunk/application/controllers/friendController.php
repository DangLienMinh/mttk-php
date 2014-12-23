 <?php
class FriendController extends CI_Controller {

    //check if user have logged in
    function __construct() {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('/userController/index', 'refresh');
        }
    }
    
    //search friend in view of user first log in by name
    public function index() {
        $em      = $this->doctrine->em;
        $user    = new Entity\UserDAO($em);
        $search  = $this->input->post('search');
        $result  = $user->timUser($search);
        $friends = "";
        if (count($result) > 0) {
            foreach ($result as $k) {
                $friends .= '<div class="display_box" align="left"><img src="' . base_url() . 'uploads/img/' . $k['picture'] . '" style="max-width:80%; max-height:80%; float:left; margin-right:6px" /><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '">' . $k['first_name'] . " " . $k['last_name'] . '</a><button type="button" class="addFriend" value="' . $k['email'] . '">' . 'Add friend</button></div>';
            }
        } else {
            $friends .= "<b>No Data Found</b>";
        }
        echo $friends;
    }
    
    //search user or fanclub on menu
    public function searchMenu() {
        $em      = $this->doctrine->em;
        $user    = new Entity\UserDAO($em);
        $fanclub = new Entity\FanclubDAO($em);
        $search  = $this->input->post('search');
        $result  = $user->timUser($search);
        $friends = "";
        if (count($result) > 0) {
            $friends .= '<div class="searchUserTtile"><h3>People</h3></div>';
            foreach ($result as $k) {
                $friends .= '<div class="searchUserBox" align="left"><img src="' . base_url() . 'uploads/img/' . $k['picture'] . '" style="width:40px; height:40px; float:left; margin-right:6px" /><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '">' . $k['first_name'] . " " . $k['last_name'] . '</a></div>';
            }
            $result1 = $fanclub->timFanclub($search);
            if (count($result1) > 0) {
                $friends .= '<div class="searchUserTtile"><h3>Fanclubs</h3></div>';
                foreach ($result1 as $k) {
                    $friends .= '<div class="searchUserBox" align="left"><img src="' . base_url() . 'assets/img/groupIcon.png" style="width:40px; height:40px; float:left; margin-right:6px" /><a href="' . site_url('statusController/layDSFanclubStatus/') . '/' . $k['fanclub_id'] . '">' . $k['fanclub_name'] . '</a><span>' . $k['soluong'] . ' members' . '</span></div>';
                }
            }
        } else {
            $friends .= "<b>No Data Found</b>";
        }
        echo $friends;
    }
    
    //add new friend
    public function themBan() {
        $friend_name = "";
        if (@$_POST['friendEmail']) {
            $friend_name = $_POST["friendEmail"];
            $email       = $this->session->userdata('email');
            $em          = $this->doctrine->em;
            $friend      = new Entity\FriendDAO($em);
            $friend->themFriend($email, $friend_name);
            echo '<a rel="' . $friend_name . '" id="wallUnfriend" href="#">Cancel friend request</a><a class="inline" href="#inline_content"><span class="' . $friend_name . '">Message</span></a>';
        }
    }
    
    //remove friendship
    public function xoaBan() {
        $unfriend = $_POST["friend"];
        $email    = $this->session->userdata('email');
        $em       = $this->doctrine->em;
        $friend   = new Entity\FriendDAO($em);
        $friend->UnFriend($email, $unfriend);
        echo '<a rel="' . $unfriend . '" id="wallAddFriend" href="#">Add friend</a><a class="inline" href="#inline_content"><span class="' . $unfriend . '">Message</span></a>';
    }
    
    //unfollow friend
    public function unfollow() {
        $unfollow = $_POST["friend"];
        $email    = $this->session->userdata('email');
        $em       = $this->doctrine->em;
        $friend   = new Entity\FriendDAO($em);
        $friend->unfollowFriend($email, $unfollow);
        echo '<a rel="' . $unfollow . '" id="wallfollow" href="#">Follow</a>';
    }
    
    //follow friend
    public function follow() {
        $follow = $_POST["friend"];
        $email  = $this->session->userdata('email');
        $em     = $this->doctrine->em;
        $friend = new Entity\FriendDAO($em);
        $friend->followFriend($email, $follow);
       echo '<a rel="' . $follow . '" id="wallUnfollow" href="#">UnFollow</a>';
    }
    
    //get all friends in user wall
    public function getAllFriends() {
        $em      = $this->doctrine->em;
        $email   = $this->input->post('email');
        $friend  = new Entity\FriendDAO($em);
        $result  = $friend->getAllFriends($email);
        $friends = "";
        if (strcmp($email, $this->session->userdata('email')) == 0) {
            foreach ($result as $k) {
                $checkAcceptFriend = $friend->checkAcceptFriend($this->session->userdata('email'), $k['email']);
                if ($checkAcceptFriend[0]['accept'] > 0) {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Unfriend</button></li>';
                }else{
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Cancel request</button></li>';
                }
            }
        } else {
            foreach ($result as $k) {
                if (strcmp($this->session->userdata('email'), $k['email']) == 0) {
                    $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button value="' . $k['email'] . '">Following</button></li>';
                } else {
                    if ($friend->checkFriend($this->session->userdata('email'), $k['email']) > 0) {
                        $checkAcceptFriend = $friend->checkAcceptFriend($this->session->userdata('email'), $k['email']);
                        if ($checkAcceptFriend[0]['accept'] > 0) {
                            $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Unfriend</button></li>';
                        }else{
                            $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="unFriend" value="' . $k['email'] . '">Cancel request</button></li>';
                        }
                    } else {
                        $friends .= '<li><a href="' . site_url('statusController/layDSWallStatus/') . '/' . $k['email'] . '"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a><button class="addFriend" value="' . $k['email'] . '">Add Friend</button></li>';
                    }
                }
            }
        }
        echo $friends;
    }
    
    //get all friend in messages
    public function getAllChatFriends() {
        $em      = $this->doctrine->em;
        $email   = $this->session->userdata('email');
        $friend  = new Entity\FriendDAO($em);
        $result  = $friend->getAllChatFriends($email);
        $friends = "";
        foreach ($result as $k) {
            $userStatus = "";
            if ($k['online'] == 1) {
                $userStatus = '<span class="onlineStatus green">Online</span>';
            } else {
                $userStatus = '<span class="onlineStatus red">Offline</span>';
            }
            $friends .= '<li>' . $userStatus . '<a class="inline" href="#inline_content"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="' . $k['email'] . '">' . $k['name'] . '</span></a></li>';
        }
        echo $friends;
    }
    
    //check user relationship when they visit other user wall
    public function checkUserWallRelation() {
        $em          = $this->doctrine->em;
        $friend_name = $this->input->post('friend');
        $email       = $this->session->userdata('email');
        $friend      = new Entity\FriendDAO($em);
        $result      = "";
        
        if ($friend->checkFriend($email, $friend_name) > 0) {
            $checkAcceptFriend = $friend->checkAcceptFriend($email, $friend_name);
            if ($checkAcceptFriend[0]['accept'] > 0) {
                $checkSubscribeFriend = $friend->checkFriendSubscribe($email, $friend_name);
                if ($checkSubscribeFriend[0]['is_subscriber'] > 0) {
                    $result .= '<a rel="' . $friend_name . '" id="wallUnfriend" href="#">Unfriend</a><a rel="' . $friend_name . '" id="wallUnfollow" href="#">UnFollow</a><a class="inline" href="#inline_content"><span class="' . $friend_name . '">Message</span></a>';
                } else {
                    $result .= '<a rel="' . $friend_name . '" id="wallUnfriend" href="#">Unfriend</a><a rel="' . $friend_name . '" id="wallFollow" href="#">Follow</a><a class="inline" href="#inline_content"><span class="' . $friend_name . '">Message</span></a>';
                }
            } else {
                $result .= '<a rel="' . $friend_name . '" id="wallUnfriend" href="#">Cancel friend request</a><a class="inline" href="#inline_content"><span class="' . $friend_name . '">Message</span></a>';
            }
        } else {
            if (strcmp($email, $friend_name) == 0) {
                $result .= "";
            } else {
                $result .= '<a rel="' . $friend_name . '" id="wallAddFriend" href="#">Add friend</a><a class="inline" href="#inline_content"><span class="' . $friend_name . '">Message</span></a>';
            }
        }
        echo $result;
    }
    
    //get suggested friend
    public function getSuggestedFriend() {
        $em      = $this->doctrine->em;
        $email   = $this->session->userdata('email');
        $friend  = new Entity\FriendDAO($em);
        $result  = $friend->getSuggestedFriend($email);
        $friends = "";
        $i       = 1;
        if (count($result) > 0) {
            foreach ($result as $k) {
                $friends .= '<li id="list' . $i . '"><img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="del"><a href="#" class="delete" id="' . $i . '">X</a></span><a href="" class="user-title">' . $k['name'] . '</a><br><button type="button" class="addFriend" value="' . $k['email'] . '">' . 'Add friend</button></li>';
                ++$i;
            }
        }
        echo $friends;
    }
    
    
    public function getFriendRequest() {
        $em      = $this->doctrine->em;
        $email   = $this->session->userdata('email');
        $friend  = new Entity\FriendDAO($em);
        $result  = $friend->getFriendRequest($email);
        $friends = "";
        $dem     = 0;
        foreach ($result as $k) {
            if ($dem < 6) {
                $friends .= '<li style="background:#f4f6f9"  class="noti"><a href="' . site_url('statusController/layDSWallStatus/') . "/" . $k['email'] . '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' . base_url() . 'uploads/img/' . $k['picture'] . '"/><span class="titleName">' . $k['name'] . '</span></a><div class="friendAction"><button id="friendAccept" onClick="window.location.href=' . "'" . site_url('friendController/') . "/acceptFriendRequest/" . $k['email'] . "'" . '">Accept</button><button id="friendDecline" onClick="window.location.href=' . "'" . site_url('friendController/') . "/removeFriendRequest/" . $k['email'] . "'" . '">Decline</button></div></li>';
                $dem = $dem + 1;
            }
        }
        if (count($result) > 0) {
            echo count($result) . $friends;
        } else {
            echo $friend;
        }
    }
    
    //accept friend request
    public function acceptFriendRequest($friendName) {
        $em     = $this->doctrine->em;
        $email  = $this->session->userdata('email');
        $friend = new Entity\FriendDAO($em);
        $friend->acceptFriend($email, $friendName);
        redirect('/', 'refresh');
    }
    
    //remove friend request
    public function removeFriendRequest($friendName) {
        
        $em     = $this->doctrine->em;
        $email  = $this->session->userdata('email');
        $friend = new Entity\FriendDAO($em);
        $friend->declineFriend($email, $friendName);
        redirect('/', 'refresh');
    }
}

?>