<?php /* Smarty version Smarty-3.1.18, created on 2014-10-25 16:23:34
         compiled from "application\views\templates\testPlayerLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4204544bb266e66f38-05996549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '281c1bc8ca3d50201f7450bc079602fe0e5d2c88' => 
    array (
      0 => 'application\\views\\templates\\testPlayerLink.tpl',
      1 => 1414246794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4204544bb266e66f38-05996549',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544bb2670839e2_57845411',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544bb2670839e2_57845411')) {function content_544bb2670839e2_57845411($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus() {
  /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
  $.ajax({
    type: "post",

    url: "<?php echo base_url('statusController/index');?>
",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addStatus(data); /* Add response to a .msg div (with the "new" class)*/
      setTimeout(
        getStatus, /* Request next message */
        3000 /* ..after 1 seconds */
      );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      addStatus("error", textStatus + " (" + errorThrown + ")");
      setTimeout(
        getStatus, /* Try again after.. */
        15000); /* milliseconds (15seconds) */
    }
  });
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

    //Popup Click
    $("#notificationContainer").click(function()
    {
      return false
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
    <div style="display: none; border: 1px solid black; height: 50px; width: 180px; 
       padding: 5px; position: absolute; left: 100px; top: 100px; 
       background-color: silver;" id="playlistBox">
    <select></select>
    <input type="hidden" id="titleMusic"/>
    <input type="hidden" id="urlMusic"/>
    <button id="savePlaylist">Save</button>
  </div>
</body>
</html><?php }} ?>
