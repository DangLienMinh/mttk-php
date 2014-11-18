<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 16:49:48
         compiled from "application\views\templates\fanclub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1047546b6a9c1439b4-64971461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '097b971e45f0ace5089d3906e771110d9aaf25a6' => 
    array (
      0 => 'application\\views\\templates\\fanclub.tpl',
      1 => 1416324682,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1047546b6a9c1439b4-64971461',
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
  'unifunc' => 'content_546b6a9c2a2888_19365424',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b6a9c2a2888_19365424')) {function content_546b6a9c2a2888_19365424($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


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
    $("input[name='fanclub_id']").val(window.fanclub);
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

  });

  $(document).on('click', '#displayUserFanclubBox .searchUserBox a', function() {
    var user=$(this).attr('rel');
    var parent=$(this).parent();
    $.ajax({
          type: "post",
    
          url:"<?php echo base_url('fanclubController/themFanclubUser');?>
",
    
          cache: false,
          data:'fanclub_id='+window.fanclub+'&user='+user,
          success: function(response){
            parent.fadeOut('slow');
          }
    });
    return false;
  });
  $(document).on('keyup', '.searchUser', function() {
      if($(".searchUser").val()!=''){
        $.ajax({
        type: "post",
  
        url:"<?php echo base_url('fanclubController/searchFanclub');?>
",
  
        cache: false,
        data:'search='+$(".searchUser").val()+'&fanclub='+window.fanclub,
        success: function(response){
          $('#displayUserFanclubBox').html(response).show();
        }
      });
    }
});
  $(document).on('click', '.removeMember', function() {
    var parent=$(this).parent();
    var email=parent.find('button').val();
        $.ajax({
        type: "post",
  
        url:"<?php echo base_url('fanclubController/removeMember');?>
",
  
        cache: false,
        data:'email='+email+'&fanclub_id='+window.fanclub,
        success: function(response){
          parent.fadeOut('slow');
        }
      });
});

  $(document).on('click', '#headlineLeave', function() {
      if (confirm("Are your sure?")) {
        $.ajax({
        type: "post",
  
        url:"<?php echo base_url('fanclubController/tuRemoveKhoiFanlub');?>
",
  
        cache: false,
        data:'fanclub_id='+window.fanclub,
        success: function(response){
          window.location.href = window.homePage;
        }
      });
      }
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
        <a id="headlineEvent" href="#">Events</a>
        <a id="headlineLeave" href="#">Leave group</a>
      </div>
    </div>
  </div>
  <div id="fanclubContainer">
  <div id="view1">
    <?php ob_start();?><?php echo form_open_multipart('statusController/themFanclubStatus');?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ('common/mainPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('postStatus'=>$_tmp1), 0);?>

  </div>
  <div id="view2" style="display:none;">
        <div id="friendListContainer"><ul></ul></div>
  </div>
  <div id="view3" style="display:none;">
        <div id="playlistContainer">
          <ul></ul>
        </div>
  </div>
</div>
</body>
</html><?php }} ?>
