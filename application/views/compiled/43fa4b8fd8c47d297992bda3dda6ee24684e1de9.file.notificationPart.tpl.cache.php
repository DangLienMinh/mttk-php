<?php /* Smarty version Smarty-3.1.18, created on 2014-11-27 17:57:06
         compiled from "application\views\templates\common\notificationPart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23055547757e2bc62a3-73159424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43fa4b8fd8c47d297992bda3dda6ee24684e1de9' => 
    array (
      0 => 'application\\views\\templates\\common\\notificationPart.tpl',
      1 => 1417106040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23055547757e2bc62a3-73159424',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_547757e2be9175_29948291',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547757e2be9175_29948291')) {function content_547757e2be9175_29948291($_smarty_tpl) {?><div id="m">
        <a><img src="<?php echo asset_url();?>
img/logo.png" class="logo"></a>
        <ul id="mon_menu">
          <li id="personalPage">
          </li>
          <li><a href="#" id="homePage">HOME</a></li>
          <li id="friend_li">
            <span id="friend_count"></span>
            <a href="#" id="friendLink">FRIENDS</a>
            <div id="friendContainer">
              <div id="friendTitle">Friend requests</div>
              <div id="friendBody" class="friend">
                <ul></ul>
              </div>
              <div id="friendFooter">
                <h3>Suggest Friends</h3>
                <ul id="facebook"></ul>
              </div>
            </div>
          </li>
          <li><a href="#" id="chatPage">MESSAGES</a></li>
          <li id="notification_li">
            <span id="notification_count"></span>
            <a href="#" id="notificationLink">NOTIFICATIONS</a>
            <div id="notificationContainer">
              <div id="notificationTitle">
                Notifications
                <a href="#" id="markRead">Mark all read</a>
              </div>
              <div id="notificationsBody" class="notifications">
                <ul></ul>
              </div>
              <div id="notificationFooter"><a href="#">See All</a></div>
            </div>
          </li>
        </ul>
        <div id="logoutContainer" class="social">
        </div>
        <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
        <div id="displayUserBox">
        </div>
      </div><?php }} ?>
