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
  window.fanclub="{$fanclub}";
  window.fanclubName="{$fanclubName}";
  window.fanclubDesc="{$fanclubDesc}";
{literal}
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
  {/literal}
        url:"{base_url('fanclubController/tuThemVaoFanclub')}",
  {literal}
        data:'fanclub_id='+window.fanclub,
        cache: false,
        success: function(){
          location.reload();
        }
      });
  });

  });


  </script>
 {/literal}
</head>
<body>
  <div id="noti_Container">
    <ul id="nav">
    <div style=" width:300px; margin-right:23%;margin-left:15.5%;float:left;" align="right">
      <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
      <div id="displayUserBox">
      </div>
    </div>
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
</html>