<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 15:48:10
         compiled from "application\views\templates\common\notificationPart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25339546b5c2a5d2c98-45855527%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43fa4b8fd8c47d297992bda3dda6ee24684e1de9' => 
    array (
      0 => 'application\\views\\templates\\common\\notificationPart.tpl',
      1 => 1416321946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25339546b5c2a5d2c98-45855527',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546b5c2a5f54a6_04402657',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b5c2a5f54a6_04402657')) {function content_546b5c2a5f54a6_04402657($_smarty_tpl) {?><div id="noti_Container">
  <ul id="nav">
    <div style=" width:300px; margin-right:23%;margin-left:15.5%;float:left;" align="right">
      <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
      <div id="displayUserBox">
      </div>
    </div>
    <li id="personalPage">
    </li>
    <li>
      <a href="#" id="homePage">Home</a>
    </li>
    <li id="friend_li">
      <span id="friend_count"></span>
      <a href="#" id="friendLink">Friends</a>
      <div id="friendContainer">
        <div id="friendTitle">Notifications</div>
        <div id="friendBody" class="friend">
          <ul></ul>
        </div>
        <div id="friendFooter">
          <h3>Suggest Friends</h3>
          <ul id="facebook"></ul>
        </div>
      </div>
    </li>
    <li id="notification_li">
      <span id="notification_count"></span>
      <a href="#" id="notificationLink">Notifications</a>
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
    <li id="logoutContainer">
    </li>
  </ul>
</div><?php }} ?>
