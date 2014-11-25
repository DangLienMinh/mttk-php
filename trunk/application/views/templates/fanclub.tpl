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
  window.fanclub="{$fanclub}";
  window.fanclubName="{$fanclubName}";
  window.fanclubDesc="{$fanclubDesc}";
  window.profileCover="{$profileCover}";
{literal}
  $(document).ready(function() {
    $('#coverContainer').css('background-image', 'url("' + window.userPic + window.profileCover + '")');
    $('#fanclubCover').append('<div class="fanclubCoverName"><b><a href="#">' + window.fanclubName + '</a></b></div><div class="fanclubCoverDesc"><b><a href="#">' + window.fanclubDesc + '</a></b></div>');
    $('#aboutFanclubDesc').append('<p>' + window.fanclubDesc + '</p>');
    $('#headlineFanclub').append(window.fanclubName);
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();
    getSuggest();
    getPlaylistUpdateStatus();
    getFanclub();
    fanclubCheckAdmin(window.fanclub);
    getMembers(window.fanclub);
    $("input[name='fanclub_id']").val(window.fanclub);
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
      var id = window.fanclub;
      $.ajax({
        type: "POST",
{/literal}
        url: "{base_url('fanclubController/suaFanclubCover')}",
{literal}
        data: {
          image: img,
          fanclub: id
        },
        success: function() {
          location.reload();
        }
      });
    });
  });
  </script>
 {/literal}
</head>
<body>
    {include file='common/notificationPart.tpl'}
    <div id="coverContainer">
    <div class="coverChange" style="display:none">
      <input type="file" id="changeCover" style="width: 250px"/>
      <input type="button" id="btnCrop" value="Finish"/>
    </div>

    <div class="imageBox">
        <div class="thumbBox"></div>
        <div class="spinner" style="display: none">Loading...</div>
    </div>
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
    {include file='common/mainPart.tpl' postStatus={form_open_multipart('statusController/themFanclubStatus')}}
  </div>
  <div id="view2" style="display:none;">
        <div id="friendListContainer">
          <div id="searchFriend">
            <h3>Add member</h3>
            <input type="text" class="searchMember" id="searchbox" /><br />
            <div id="display">
            </div>
          </div>
          <ul></ul>
        </div>
  </div>
  <div id="view3" style="display:none;">
        <div id="playlistContainer">
          <ul></ul>
        </div>
  </div>
</div>
</body>
</html>