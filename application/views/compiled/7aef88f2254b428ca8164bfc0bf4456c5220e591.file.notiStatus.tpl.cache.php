<?php /* Smarty version Smarty-3.1.18, created on 2014-11-27 17:56:01
         compiled from "application\views\templates\notiStatus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25108547757a12e1698-68114529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7aef88f2254b428ca8164bfc0bf4456c5220e591' => 
    array (
      0 => 'application\\views\\templates\\notiStatus.tpl',
      1 => 1417107099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25108547757a12e1698-68114529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_547757a140f2a3_80586845',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547757a140f2a3_80586845')) {function content_547757a140f2a3_80586845($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;

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
    getSuggest();
    getPlaylistUpdateStatus();
    getFanclub();

    $("#target").autoGrow();
    $('#tabs').tabs({
      activate: function(event, ui) {
        $('#container').masonry({
          itemSelector: '.item'
        });
        var msnry = $('#container').data('masonry');
        msnry.on( 'layoutComplete', masonry_refresh );
        function masonry_refresh(){
          Arrow_Points();
        }
      }
    });

    $('#notificationsBody ul').bind('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
          var id=$(this).find('li:last').attr("id");
          moreNotify(id.substring(4));
        }
    });
    
      $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
          $(this).jPlayer("setMedia", {
            title: "",
            mp3: ""
          }).jPlayer("play");
        },
        swfPath: "js",
        supplied: "mp3",
        wmode: "window",
        smoothPlayBar: true,
        keyEnabled: true,
        remainingDuration: true,
        toggleDuration: true
      });
      $('.fanclubInfo').append('<div class="fanclubUserBox" align="left"><a href="'+window.createFanclub+'" class="iframe">Create new fanclub</a></div>');
      $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
  });
  </script>
 
</head>
<body>
    <div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
    <?php echo $_smarty_tpl->getSubTemplate ('common/notificationPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

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
