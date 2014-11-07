<?php /* Smarty version Smarty-3.1.18, created on 2014-11-06 16:52:44
         compiled from "application\views\templates\updatestatus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27088545b994c78dac4-90128904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbb7cc862149582d5781c9c5321bd31e7b1879b9' => 
    array (
      0 => 'application\\views\\templates\\updatestatus.tpl',
      1 => 1415284803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27088545b994c78dac4-90128904',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_545b994c907639_11163366',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545b994c907639_11163366')) {function content_545b994c907639_11163366($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jplayer.blue.monday.playlist.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/wall.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jplayer.playlist.min.js"></script>
  <script type="text/javascript">
  
    window.chosenMusic = "";
    window.title="";
    function playSelectedSong(guid,title){
      window.chosenMusic=guid;
      window.title=title;
      $("#jquery_jplayer_1").jPlayer( "destroy" );
          var player = $("#jquery_jplayer_1");
          player.jPlayer({
          ready: function (event) {
            $(this).jPlayer("setMedia", {
              title: title,
              mp3: guid
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
      }

    function displaySongUpdateStatus(data) {
      var obj = JSON.parse(data);
      var cssSelector = {
        jPlayer: "#jquery_jplayer_2",
        cssSelectorAncestor: "#jp_container_2"
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
    
function getPlaylistUpdateStatus() {
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
      $('#playlistBox select').append(data);
      var id=$('#playlistBox select').find(":selected").val();
      getSongUpdateStatus(id);
    }
  });
}

function getSongUpdateStatus(data) {
  $("#playlist_id").val(data);
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
      displaySongUpdateStatus(data);
    }
  });
}

  </script>
  <script>
  $(document).ready(function() {
      $("#target").autoGrow();

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

      getPlaylistUpdateStatus();

      $('#playlistBox select').on('change',function(){
         var id=$(this).parent().find('select').find(":selected").val();
          getSongUpdateStatus(id);
      });

      $("#music_name").keyup(function(){
        $("#musicContainer").show();
        $.ajax({
          type: "post",

          url:"<?php echo base_url('statusController/chooseMusic');?>
", 

          cache: false,
          data:'music_name='+$("#music_name").val(),
          success: function(response){
            $('#finalResult').html("");
            $('#finalResult').append(response);
          }
        });
      });

      $('#finalResult').on('click', 'li a', function() {
          $("#music_url").val(window.chosenMusic);
          $("#title").val(window.title);
          $('#music_name').val('');
      });

      $(document).click(function()
      {
        $("#musicContainer").hide();
      });

    });
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  <style type="text/css">
    #tabs{
      width:33%;
      margin: 0px auto;
    }
    #target{
      width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box; 
    }
  </style>
  
</head>
<body>
<?php echo form_open_multipart('statusController/updateStatus');?>

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Choose music</a></li>
    <li><a href="#tabs-2">Upload music</a></li>
    <li><a href="#tabs-3">Playlist</a></li>
  </ul>

  <div id="tabs-1">
    <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea>
    <input type="text" name="music_name" id="music_name" placeholder="Song name?"/>
    <input type="hidden" name="music_url" id="music_url" />
    <input type="hidden" name="title" id="title" />
    <div id="musicContainer">
        <div id="musicBody" class="musics">
          <ul id="finalResult"></ul>
        </div>
    </div>

    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div id="jp_container_1" class="jp-audio centerAlign">
      <div class="jp-type-single">
        <div class="jp-gui jp-interface">
          <ul class="jp-controls">
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
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
          <div class="jp-time-holder">
            <div class="jp-current-time"></div>
            <div class="jp-duration"></div>

            <ul class="jp-toggles">
              <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
              <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
            </ul>
          </div>
        </div>
        <div class="jp-details">
          <ul>
            <li><span class="jp-title"></span></li>
          </ul>
        </div>
        <div class="jp-no-solution">
          <span>Update Required</span>
          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
      </div>
    </div>
  </div>
  <div id="tabs-2">
    <textarea name="status2" id="target" rows="4" placeholder="What's on your mind?"></textarea>
    <input type="file" name="musicFile" size="20"/>
  </div>
  <div id="tabs-3">
    <div id="playlistBox">
    <select></select>
    <input type="hidden" name="playlist_id" id="playlist_id" />
  </div>
    <textarea name="status3" id="target" rows="4" placeholder="What's on your mind?"></textarea>
    <div id="jquery_jplayer_2" class="jp-jplayer"></div>
    <div id="jp_container_2" class="jp-audio centerAlign">
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
    <!--cai playlist de day dung ajax load vao combo-->

  </div>
  <div id="privacyRight">
    <select name="privacy" id="privacy">
      <option selected value="1">Public</option>
      <option value="2">Friend</option>
      <option value="3">Custom</option>
      <option value="4">Private</option>
    </select>
    <input type="submit" value="Post" id="postStatus"/>
  </div>
  
</div>
 <?php echo form_close();?>

</body>
</html><?php }} ?>
