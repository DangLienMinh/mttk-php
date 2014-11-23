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
    getEducation(window.userLoginWall);
    getBasicInfo(window.userLoginWall);
    getUserDetail(window.userLoginWall);
    getFavorite(window.userLoginWall);
    getFriendList(window.userLoginWall);
    wallDsPlaylist(window.userLoginWall);
    checkUserWallRelation(window.userLoginWall);
    $('#search').hideseek();
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

      $('#content').keypress(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        var boxval = $(this).val();
        var user = $("#toUser").val();
        var dataString = 'email=' + user + '&message=' + boxval;
        if (boxval.length > 0) {
          if (boxval.length < 200) {
            $("#flash").show();
{/literal}
            $("#flash").fadeIn(400).html('<img src="{asset_url()}img/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Update...</span>');
{literal}
            $.ajax({
              type: "POST",
{/literal}
              url: "{base_url('messageController/addMessage')}",
{literal}
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
 {/literal}
</head>
<body>
  {include file='common/notificationPart.tpl'}
  <div id="coverContainer">
    <div id="cover">
    </div>
    <div id="headline">
      <div class="headlineRight">
        <a id="headlineTimeline" href="#">TimeLine</a>
        <a id="headlineAbout" href="#">About</a>
        <a id="headlineFriendList" href="#">Friends</a>
        <a id="headlinePlaylist" href="#">Playlist</a>
        <a class="" href="#">More</a>
      </div>
      <div class="headlineLeft">

      </div>
    </div>
  </div>
    <div id="wallContainer">
      <div id="view1">
        {include file='common/mainPart.tpl' postStatus={form_open_multipart('statusController/updateStatus')}}
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
        <div id="friendListContainer">
        <div id="chatTitle">
          <h3>Search</h3>
          <input id="search" name="search" placeholder="Start typing here" type="text" data-list=".list">
        </div>
        <div id="friendList">
          <ul class="list"></ul>
        </div>
      </div>
      </div>
      <div id="view3" style="display:none;">
        <div id="playlistContainer">
          <ul></ul>
        </div>
      </div>
      <div style="width:550px; float:left; margin:30px;display:none;">
        <div id='inline_content' style='padding:10px; background:#fff;'>
          <ol id="update" style="list-style:none;">
          </ol>
          <div id="flash"></div>
          <audio id="chatAudio"><source src="{asset_url()}sound/notify.ogg" type="audio/ogg"><source src="{asset_url()}sound/notify.mp3" type="audio/mpeg"><source src="{asset_url()}sound/notify.wav" type="audio/wav"></audio>
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
    </div>
</body>
</html>