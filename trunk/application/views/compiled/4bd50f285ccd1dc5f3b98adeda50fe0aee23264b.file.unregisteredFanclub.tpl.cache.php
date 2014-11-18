<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 16:41:49
         compiled from "application\views\templates\unregisteredFanclub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28281546b68bd04a0c2-98683801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bd50f285ccd1dc5f3b98adeda50fe0aee23264b' => 
    array (
      0 => 'application\\views\\templates\\unregisteredFanclub.tpl',
      1 => 1416325280,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28281546b68bd04a0c2-98683801',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'fanclub' => 0,
    'fanclubName' => 0,
    'fanclubDesc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546b68bd195d65_05743487',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b68bd195d65_05743487')) {function content_546b68bd195d65_05743487($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/

      data=<?php echo $_smarty_tpl->tpl_vars['items']->value;?>


    addStatusUserWall(data);
  }
  </script>
  <script>

  window.fanclub="<?php echo $_smarty_tpl->tpl_vars['fanclub']->value;?>
";
  window.fanclubName="<?php echo $_smarty_tpl->tpl_vars['fanclubName']->value;?>
";
  window.fanclubDesc="<?php echo $_smarty_tpl->tpl_vars['fanclubDesc']->value;?>
";

  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();
    getSuggest();
    getPlaylistUpdateStatus();
    getFanclub();
    getMembers(window.fanclub);

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


    $('#fanclubCover').append('<div class="fanclubCoverName"><b><a href="#">' + window.fanclubName + '</a></b></div><div class="fanclubCoverDesc"><b><a href="#">' + window.fanclubDesc + '</a></b></div>');
    $('#aboutFanclubDesc').append('<p>'+window.fanclubDesc+'</p>');
    $('#headlineFanclub').append('<span>'+window.fanclubName+'</span>');
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

   $('#headlineFanclub').click(function(){
        $('#fanclubContainer').find('#view1').show();
        $('#fanclubContainer').find('#view1').siblings('div').hide();
        $('#container').masonry({
          itemSelector: '.item'
        });
        Arrow_Points();
      });
      $('#headlineMembers').click(function(){
        $('#fanclubContainer').find('#view2').show();
        $('#fanclubContainer').find('#view2').siblings('div').hide();
      });

      $(document).on('click', '.joinFanclub a', function() {
        $.ajax({
        type: "post",
  
        url:"<?php echo base_url('fanclubController/tuThemVaoFanclub');?>
",
  
        data:'fanclub_id='+window.fanclub,
        cache: false,
        success: function(){
          location.reload();
        }
      });
  });

  });


  </script>
 
</head>
<body>
    <?php echo $_smarty_tpl->getSubTemplate ('common/notificationPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    <div id="coverContainer">
    <div id="fanclubCover">
    </div>
    <div id="headline">
      <div class="headlineRight">
        <a id="headlineFanclub" href="#"></a>
        <a id="headlineMembers" href="#">Members</a>
      </div>
    </div>
  </div>
  <div id="fanclubContainer">
    <div id="view1">
      <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
      <div class="item">
        <div id="aboutFanclub">
          <div id="aboutFanclubHeader">
            <h6>About</h6>
          </div>
          <div id="aboutFanclubAdd">
            <p>Join this group to see the discussion, post and comment.</p>
            <div class="joinFanclub">
              <a href="#">Join group</a>
            </div>
          </div>
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
    </div>
    <div id="view2" style="display:none;">
        <div id="friendListContainer"><ul></ul></div>
  </div>
    </div>
</body>
</html><?php }} ?>
