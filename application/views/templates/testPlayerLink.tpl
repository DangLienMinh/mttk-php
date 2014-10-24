{include file='common/header.tpl'}
{literal}
function getStatus() {
  /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/index')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addStatus(data); /* Add response to a .msg div (with the "new" class)*/
      setTimeout(
        getStatus, /* Request next message */
        3000 /* ..after 1 seconds */
      );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      addStatus("error", textStatus + " (" + errorThrown + ")");
      setTimeout(
        getStatus, /* Try again after.. */
        15000); /* milliseconds (15seconds) */
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
    $('#noti_Container #noti').click(function() {
      if ($('#noti_content').css('display') == 'none') {
        $('#noti_content').css('display', 'block');
      } else {
        $('#noti_content').css('display', 'none');
      }
    });
    $('#noti_Container #friend').click(function() {
      if ($('#friend_content').css('display') == 'none') {
        $('#friend_content').css('display', 'block');
      } else {
        $('#friend_content').css('display', 'none');
      }
    });
    $('#savePlaylist').click(function(){
      var id=$(this).parent().find('select').find(":selected").val();
      var title=$(this).parent().find('#titleMusic').val();
      var music=$(this).parent().find('#urlMusic').val();
      savePlaylist(id,title,music);
    });
  });
  </script>
 {/literal}
</head>
<body>
  <div id="noti_Container">
    <img id="friend"  src="http://l-stat.livejournal.com/img/facebook-profile.gif" alt="profile" />
    <img id="noti" src="http://l-stat.livejournal.com/img/facebook-profile.gif" alt="profile" />
    <div class="noti_bubble"></div>
    <div class="friend_bubble"></div>
    
  </div>
  <div id="noti_content">
    <ul></ul>
  </div>
  <div id="friend_content">
    <ul></ul>
  </div>
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
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
</body>
</html>