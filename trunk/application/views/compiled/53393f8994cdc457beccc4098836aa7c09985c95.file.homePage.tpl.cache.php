<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 15:47:26
         compiled from "application\views\templates\homePage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31118546b5bfe224625-75630450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53393f8994cdc457beccc4098836aa7c09985c95' => 
    array (
      0 => 'application\\views\\templates\\homePage.tpl',
      1 => 1416318791,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31118546b5bfe224625-75630450',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546b5bfe4c7ce6_15641370',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b5bfe4c7ce6_15641370')) {function content_546b5bfe4c7ce6_15641370($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus() {
  $.ajax({
    type: "post",

    url: "<?php echo base_url('statusController/index');?>
",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      addStatus(data);
      setTimeout(
        getStatus,
        600000
      );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      addStatus("error", textStatus + " (" + errorThrown + ")");
      setTimeout(
        getStatus,
        15000);
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
    <?php echo $_smarty_tpl->getSubTemplate ('common/notificationPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

    <div class="fanclubContainer">
      <div class="fanclubTitle"><h3>FANCLUB</h3></div>
      <div class="fanclubInfo">
      </div>
    </div>
    <?php echo $_smarty_tpl->getSubTemplate ('common/mainPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

</body>
</html><?php }} ?>
