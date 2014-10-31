<?php /* Smarty version Smarty-3.1.18, created on 2014-10-31 10:33:18
         compiled from "application\views\templates\userWall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69075453575eb72953-58761667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f921ff09c337117641cd650c5ceaa3930b1bdcf' => 
    array (
      0 => 'application\\views\\templates\\userWall.tpl',
      1 => 1414460300,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69075453575eb72953-58761667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5453575ee4ddf3_86239833',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5453575ee4ddf3_86239833')) {function content_5453575ee4ddf3_86239833($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/

      data=<?php echo $_smarty_tpl->tpl_vars['items']->value;?>


    addStatusUserWall(data);
    }
  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();

    $("#notificationLink").click(function()
    {
      $("#friendContainer").hide();
      $("#notificationContainer").fadeToggle(300);
      $("#notification_count").fadeOut("slow");
      return false;
    });

    $("#friendLink").click(function()
    {
      $("#notificationContainer").hide();
      $("#friendContainer").fadeToggle(300);
      $("#friend_count").fadeOut("slow");
      return false;
    });

    $(document).click(function()
    {
      $("#notificationContainer").hide();
      $("#friendContainer").hide();
    });

    $('#savePlaylist').click(function(){
      var id=$(this).parent().find('select').find(":selected").val();
      var title=$(this).parent().find('#titleMusic').val();
      var music=$(this).parent().find('#urlMusic').val();
      savePlaylist(id,title,music);
    });
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
    <ul id="nav">
    <li id="friend_li">
      <span id="friend_count"></span>
      <a href="#" id="friendLink">Friends</a>
      <div id="friendContainer">
        <div id="friendTitle">Notifications</div>
        <div id="friendBody" class="friend">
          <ul></ul>
        </div>
        <div id="friendFooter"><a href="#">See All</a></div>
      </div>
    </li>
    <li id="notification_li">
      <span id="notification_count"></span>
      <a href="#" id="notificationLink">Notifications</a>
      <div id="notificationContainer">
        <div id="notificationTitle">Notifications</div>
        <div id="notificationsBody" class="notifications">
          <ul></ul>
        </div>
        <div id="notificationFooter"><a href="#">See All</a></div>
      </div>
    </li>
  </ul>
  </div>
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
    </div>
    <div id="pop">
      <img/>
      <h2></h2>
    </div>
</body>
</html><?php }} ?>
