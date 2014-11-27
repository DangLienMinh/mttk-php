{include file='common/header.tpl'}
{literal}
function getStatus(){
      var data;
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
  window.profileCover="{$profileCover}";
{literal}
  $(document).ready(function() {
    $('#coverContainer').css('background', 'url("' + window.userPic + window.profileCover + '")').css('background-size', 'cover');
    waitForMsg();
    friendRequest(window.userLoginWall);
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
        msnry.on('layoutComplete', masonry_refresh);

        function masonry_refresh() {
          Arrow_Points();
        }
      }
    });

    $('#notificationsBody ul').bind('scroll', function() {
      if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
        var id = $(this).find('li:last').attr("id");
        moreNotify(id.substring(4));
      }
    });

    $("#jquery_jplayer_1").jPlayer({
      ready: function(event) {
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

    var options = {
      thumbBox: '.thumbBox',
      spinner: '.spinner',
      imgSrc: window.userPic + window.profileCover
    }
    var cropper = $('.imageBox').cropbox(options);

    $('#changeCover').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(e) {
        options.imgSrc = e.target.result;
        cropper = $('.imageBox').cropbox(options);
      }
      reader.readAsDataURL(this.files[0]);
      this.files = [];
    });

    $('#btnCrop').on('click', function() {
      var img = cropper.getDataURL();
      $.ajax({
        type: "POST",
{/literal}
        url: "{base_url('profileController/suaProfileCover')}",
{literal}
        data: {
          image: img
        },
        success: function() {
          location.reload();
        }
      });
    });

    $('#headlineTimeline').find('span').css("display", "block");


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
        $('#cboxLoadedContent').animate({
          scrollTop: $('#cboxLoadedContent').prop("scrollHeight")
        }, 700);
      }
    });
  });
  </script>
 {/literal}
   <link rel="stylesheet" type="text/css" href="{asset_url()}css/a.css">

</head>
	<body>
		<div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
       {include file='common/notificationPart.tpl'}
			<div id="lookbook" style="display: block;">
				<div>
					<div id="coverContainer" style="height: 467px;">
              <div class="coverChange" style="display:none">
                  <input type="file" id="changeCover" style="width: 250px"/>
                  <input type="button" id="btnCrop" value="Finish"/>
              </div>
              <div class="imageBox">
                  <div class="thumbBox"></div>
                  <div class="spinner" style="display: none">Loading...</div>
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
              <div id="cover">
              </div>
          </div>
					<div class="inner">
						<div id="c2013">
							<div class="col1">Chỗ này chưa biết viết cái gì hết nên thôi cứ để đại mấy dòng rồi tính sau...</div>
							<div class="col2">Chỗ này sẽ ghi thông tin tài khoản hay 1 dòng giới thiệu ngắn về chủ tài khoản đang sử dụng<br><br>bla... bla... bla...</div>
							<div class="clear"></div>
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
				<div id="inside">
					<div id="lookbook-shop-now" style="height: 448px; background-position: 0px 50%;"></div>
					<a href="#" target="_blank" class="bt3 lookbookshopnow">ABC NOW</a>
				</div>
			</div>
		</div>
	</body>
</html>