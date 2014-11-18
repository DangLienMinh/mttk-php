<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 16:12:39
         compiled from "application\views\templates\chat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235546b61e7638a64-50870668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b6dc35f1f71077e641292f34338da75b727a1d9' => 
    array (
      0 => 'application\\views\\templates\\chat.tpl',
      1 => 1416323557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235546b61e7638a64-50870668',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546b61e7765a38_38675183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b61e7765a38_38675183')) {function content_546b61e7765a38_38675183($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getFriendChat();
    getSuggest();
    /*$("#notificationLink").click(function()
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
*/
    $('#content').keypress(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        var boxval = $(this).val();
        var user = $("#toUser").val();
        var dataString = 'email=' + user + '&message=' + boxval;
        if (boxval.length > 0) {
          if (boxval.length < 200) {
            $("#flash").show();

            $("#flash").fadeIn(400).html('<img src="<?php echo asset_url();?>
img/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Update...</span>');

            $.ajax({
              type: "POST",

              url: "<?php echo base_url('messageController/addMessage');?>
",

              data: dataString,
              cache: false,
              success: function(html) {
                $(html).appendTo('#inline_content ol').emotions();
                $('#content').val('');
                $("#flash").hide();
                $('#content').focus();
              }
            });
          } else {
            alert("Please delete some Text max 200 charts");
          }
        }
        $('#cboxLoadedContent').animate({scrollTop: $('#cboxLoadedContent').prop("scrollHeight")}, 700);
      }
    });
  });
  </script>
 
</head>
<body>
  <?php echo $_smarty_tpl->getSubTemplate ('common/notificationPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    <div id="friendChatContainer">
      <ul></ul>
    </div>
      <div style="width:550px; float:left; margin:30px;display:none;">
        <div id='inline_content' style='padding:10px; background:#fff;'>
          <ol id="update" style="list-style:none;">
          </ol>
          <div id="flash"></div>
          <audio id="chatAudio"><source src="<?php echo asset_url();?>
sound/notify.ogg" type="audio/ogg"><source src="<?php echo asset_url();?>
sound/notify.mp3" type="audio/mpeg"><source src="<?php echo asset_url();?>
sound/notify.wav" type="audio/wav"></audio>
          <div>
              <div align="left">
              <table>
              <tr>
                <td>
                  <input type='text' class="textbox" name="content" id="content" maxlength="200" placeholder="Message"/>
                </td>
                <input type='hidden' name="toUser" id="toUser" />
              </tr>
              </table>
              </div>
          </div>
        </div>
      </div>
</body>
</html><?php }} ?>
