{include file='common/header.tpl'}
{literal}
function getStatus() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/index')}",
{literal}
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
      useStateClassSkin: true,
      autoBlur: false,
      smoothPlayBar: true,
      keyEnabled: true,
      remainingDuration: true,
      toggleDuration: true
    });

    $('.fanclubInfo').append('<div class="fanclubUserBox" align="left"><a href="' + window.createFanclub + '" class="iframe">Create new fanclub</a></div>');
    $(".iframe").colorbox({
      iframe: true,
      width: "50%",
      height: "50%"
    });
  });
  </script>
 {/literal}
</head>
<body>
  <div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
    {include file='common/notificationPart.tpl'}
    <div class="fanclubContainer">
      <div class="fanclubTitle"><h3>FANCLUB</h3></div>
      <div class="fanclubInfo">
      </div>
    </div>
    <div class="reportContainer">
      <div class="fanclubTitle"><h3>REPORT</h3></div>
      <div class="reportInfo">
        {form_open_multipart('statusController/GetFamousStatus')}
        <input type="date" name="sdate"/>
        <input type="date" name="edate"/><br>
         <input type="submit" value="submit"/><br>
        {form_close()}
      </div>
    </div>
    
  </div>
    {include file='common/mainPart.tpl' postStatus={form_open_multipart('statusController/updateStatus')}}

</body>
</html>