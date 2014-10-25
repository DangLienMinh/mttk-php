<?php /* Smarty version Smarty-3.1.18, created on 2014-10-25 06:17:47
         compiled from "application\views\templates\playPlaylist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13417544b246bdaeb98-95369914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b657d4b7061ecf2392af3f33185a59da7cb8ee5c' => 
    array (
      0 => 'application\\views\\templates\\playPlaylist.tpl',
      1 => 1414208415,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13417544b246bdaeb98-95369914',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544b246bead303_77109800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544b246bead303_77109800')) {function content_544b246bead303_77109800($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jplayer.blue.monday.playlist.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jplayer.playlist.min.js"></script>
  <script type="text/javascript">
  window.cretePlaylist="<?php echo site_url('playlistController/viewPlaylist/');?>
";
  
    function testXem(data){
        var obj = JSON.parse(data);
        var cssSelector = {
       jPlayer: "#jquery_jplayer_1",
       cssSelectorAncestor: "#jp_container_1"
    };
    /*An Empty Playlist*/
    var playlist = [];
       var options = {
           swfPath: "js",
           supplied: "mp3"
    };
    var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
    /*Loop through the JSon array and add it to the playlist*/ 
   $.each(obj, function(i, val) {
          myPlaylist.add({
            title: val.title,
            mp3: val.mp3
        });
    });

      }


function getPlaylist() {
  $.ajax({
    type: "post",

    url: "<?php echo base_url('playlistController/getDSPlaylist');?>
",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addPlaylist(data);
    }
  });
}

function getSong(data) {
  var dataString="playlist_id="+data;
  $.ajax({
    type: "post",
    data:dataString,

    url: "<?php echo base_url('playlistController/getDSSongs');?>
",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      testXem(data);
    }
  });
}

function addPlaylist(msg) {
  var obj = JSON.parse(msg);
  try {
    $.each(obj, function(i, val) {
      $('#playlistBox select').append('<option value="'+val.Playlist_id+'">'+val.Playlist_name+'</option>');
    });
  } catch (e) {
    alert(e);
  }
}

  </script>
  <script>
  $(document).ready(function() {
      getPlaylist();
      $('#savePlaylist').click(function(){
         var id=$(this).parent().find('select').find(":selected").val();
          getSong(id);
      })
    });
  </script>
  
</head>
<body>
    <div id="jquery_jplayer_1" class="jp-jplayer"></div>

    <div id="jp_container_1" class="jp-audio">
      <div class="jp-type-playlist">
        <div class="jp-gui jp-interface">
          <ul class="jp-controls">
            <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
            <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
          </ul>
          <div class="jp-progress">
            <div class="jp-seek-bar">
              <div class="jp-play-bar"></div>

            </div>
          </div>
          <div class="jp-volume-bar">
            <div class="jp-volume-bar-value"></div>
          </div>
          <div class="jp-current-time"></div>
          <div class="jp-duration"></div>
          <ul class="jp-toggles">
            <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li>
            <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">shuffle off</a></li>
            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
          </ul>
        </div>
        <div class="jp-playlist">
          <ul>
            <li></li>
          </ul>
        </div>
        <div class="jp-no-solution">
          <span>Update Required</span>
          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
      </div>
    </div>


    <div style="border: 1px solid black; height: 50px; width: 180px; 
       padding: 5px; position: absolute; left: 100px; top: 100px; 
       background-color: silver;" id="playlistBox">
    <select></select>
    <button id="savePlaylist">Save</button>
  </div>

</body>
</html><?php }} ?>
