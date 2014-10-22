<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 17:36:03
         compiled from "application\views\templates\userWall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177335447cee3e7a5a6-55141972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f921ff09c337117641cd650c5ceaa3930b1bdcf' => 
    array (
      0 => 'application\\views\\templates\\userWall.tpl',
      1 => 1413992134,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177335447cee3e7a5a6-55141972',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5447cee40482f8_23842939',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5447cee40482f8_23842939')) {function content_5447cee40482f8_23842939($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


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
    $('#noti_Container #noti').click(function() {
      if ($('#noti_content').css('display') == 'none') {
        $('#noti_content').css('display', 'block');
      } else {
        $('#noti_content').css('display', 'none');
      }
    });
    $('#noti_Container #friend').click(function() {
      if ($('#friend_content').css('display') == 'none') {
        $('#friend_content').css('display', 'block');
      } else {
        $('#friend_content').css('display', 'none');
      }
    });
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
    <img id="friend"  src="http://l-stat.livejournal.com/img/facebook-profile.gif" alt="profile" />
    <img id="noti" src="http://l-stat.livejournal.com/img/facebook-profile.gif" alt="profile" />
    <div class="noti_bubble"></div>
    <div class="friend_bubble"></div>
    
  </div>
  <div id="noti_content">
    <ul></ul>
  </div>
  <div id="friend_content">
    <ul></ul>
  </div>
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
    </div>
    <div id="pop" class="popbox">
      <img/>
      <h2></h2>
    </div>
</body>
</html><?php }} ?>
