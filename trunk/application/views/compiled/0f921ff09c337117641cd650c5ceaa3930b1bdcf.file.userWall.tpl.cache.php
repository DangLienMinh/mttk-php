<?php /* Smarty version Smarty-3.1.18, created on 2014-11-09 16:08:57
         compiled from "application\views\templates\userWall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14914545f8389555006-92536758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f921ff09c337117641cd650c5ceaa3930b1bdcf' => 
    array (
      0 => 'application\\views\\templates\\userWall.tpl',
      1 => 1415524499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14914545f8389555006-92536758',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_545f83897c1992_58880372',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545f83897c1992_58880372')) {function content_545f83897c1992_58880372($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


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
    getSuggest();
    getPlaylistUpdateStatus();

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
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
    <ul id="nav">
    <li id="personalPage">
    </li>
    <li>
      <a href="#" id="homePage">Home</a>
    </li>
    <li id="friend_li">
      <span id="friend_count"></span>
      <a href="#" id="friendLink">Friends</a>
      <div id="friendContainer">
        <div id="friendTitle">Notifications</div>
        <div id="friendBody" class="friend">
          <ul></ul>
        </div>
        <div id="friendFooter">
          <h3>Suggest Friends</h3>
          <ul id="facebook"></ul>
        </div>
      </div>
    </li>
    <li id="notification_li">
      <span id="notification_count"></span>
      <a href="#" id="notificationLink">Notifications</a>
      <div id="notificationContainer">
        <div id="notificationTitle">
          Notifications
          <a href="#" id="markRead">Mark all read</a>
        </div>
        <div id="notificationsBody" class="notifications">
          <ul></ul>
        </div>
        <div id="notificationFooter"><a href="#">See All</a></div>
      </div>
    </li>
  </ul>
  </div>
  <div id="coverContainer">
    <div id="cover">

    </div>
    <div id="headline">
      <div class="headlineRight">
        <a class="" href="#">TimeLine<span class="arrowBottom"></span></a>
        <a class="" href="#">About</a>
        <a class="" href="#">Friends</a>
        <a class="" href="#">Playlist</a>
        <a class="" href="#">More</a>
      </div>
    </div>
  </div>
  
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
      <div class="item">
        <?php echo form_open_multipart('statusController/updateStatus');?>

        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Choose music</a></li>
            <li><a href="#tabs-2">Upload music</a></li>
            <li><a href="#tabs-3">Playlist</a></li>
          </ul>

          <div id="tabs-1">
            <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea>
            <br/>
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
            <br/>
            <input type="file" name="musicFile" size="20"/>
          </div>
          <div id="tabs-3">
            <div id="playlistBoxUpdateStatus">
            <select></select>
            <input type="hidden" name="playlist_id" id="playlist_id" />
          </div>
            <textarea name="status3" id="target" rows="4" placeholder="What's on your mind?"></textarea>
            <br/>
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
