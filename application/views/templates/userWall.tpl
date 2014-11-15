{include file='common/header.tpl'}
{literal}
function getStatus(){
      var data;
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
{/literal}
      data={$items}
{literal}
    addStatusUserWall(data);
    }
  </script>
  <script>
{/literal}
  window.userNameWall="{$userNameWall}";
  window.userLoginWall="{$userLoginWall}";
  window.userPicCmtWall="{uploads_url()}img/{$userPicCmtWall}";
{literal}
  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();
    getSuggest();
    getPlaylistUpdateStatus();
    getEducation();
    getBasicInfo();
    getUserDetail();
    getFavorite();
    getFriendList(window.userLoginWall);
    wallDsPlaylist(window.userLoginWall);
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
      $('#headlineTimeline').find('span').css("display", "block");
      $('.headlineRight a').click(function(){
        $(this).find('span').css("display", "block");
        $(this).siblings("a").find('span').css("display", "none");
        return false;
      })
      $('#headlineFriendList').click(function(){
        $('#wallContainer').find('#view2').show();
        $('#wallContainer').find('#view2').siblings('div').hide();
      });
      $('#headlineTimeline').click(function(){
        $('#wallContainer').find('#view1').show();
        $('#wallContainer').find('#view1').siblings('div').hide();
        $('#container').masonry({
          itemSelector: '.item'
        });
      });
      $('#headlinePlaylist').click(function(){
        $('#wallContainer').find('#view3').show();
        $('#wallContainer').find('#view3').siblings('div').hide();
      });
      $('#headlineAbout').click(function(){
        $('#wallContainer').find('#view4').show();
        $('#wallContainer').find('#view4').siblings('div').hide();
      });
      $('#aboutLeft1').click(function(){
        $('#aboutRight').find('#about1').show();
        $('#aboutRight').find('#about1').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft2').click(function(){
        $('#aboutRight').find('#about2').show();
        $('#aboutRight').find('#about2').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft3').click(function(){
        $('#aboutRight').find('#about3').show();
        $('#aboutRight').find('#about3').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft4').click(function(){
        $('#aboutRight').find('#about4').show();
        $('#aboutRight').find('#about4').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
  });
  </script>
 {/literal}
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
        <a id="headlineTimeline" href="#">TimeLine<span class="hoverHeadlineRight"></span></a>
        <a id="headlineAbout" href="#">About<span class="hoverHeadlineRight"></span></a>
        <a id="headlineFriendList" href="#">Friends<span class="hoverHeadlineRight"></span></a>
        <a id="headlinePlaylist" href="#">Playlist<span class="hoverHeadlineRight"></span></a>
        <a class="" href="#">More<span class="hoverHeadlineRight"></span></a>
      </div>
    </div>
  </div>
    <div id="wallContainer">
      <div id="view1">
        <div id="container">
        <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
        </div>
        <div class="item">
          {form_open_multipart('statusController/updateStatus')}
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
   {form_close()}
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
      </div>
      <div id="view4" style="display:none;">
        <div id="aboutContainer">
          <div id="aboutLeft">
            <ul>
              <li><a id="aboutLeft1" href="#"><span>Education  and Religion</span></a></li>
              <li><a id="aboutLeft2" href="#"><span>Contact and Basic Info</span></a></li>
              <li><a id="aboutLeft3" href="#"><span>Details about you</span></a></li>
              <li><a id="aboutLeft4" href="#"><span>Favorites</span></a></li>
            </ul>
          </div>
          <div id="aboutRight">
            <div class="aboutContent">
              <div id="about1"></div>
              <div id="about2" style="display:none;"></div>
              <div id="about3" style="display:none;"></div>
              <div id="about4" style="display:none;"></div>
              <div id="about5" style="display:none;"></div>
            </div>
          </div>
        </div>
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
</html>