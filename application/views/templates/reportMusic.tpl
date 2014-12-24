{include file='common/header.tpl'}
{literal}
function getStatus(){
      var data;
{/literal}
      data={$items}
{literal}
    reportFamousMusic(data);
    }
  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    getStatus();
    friendRequest();
    getSuggest();
    getMessageNumber();
    $('#notificationsBody ul').bind('scroll', function() {
      if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
        var id = $(this).find('li:last').attr("id");
        moreNotify(id.substring(4));
      }
    });
    var msnry = $('#container').data('masonry');
    msnry.on( 'layoutComplete', masonry_refresh );
    function masonry_refresh(){
      Arrow_Points();
    }
  });
  </script>
 {/literal}
</head>
<body>
  {include file='common/notificationPart.tpl'}
        <h1 id="reportMusicTitle">10 bài hát được yêu thích nhất</h1>
    <div id="container">

        <div class="timeline_container">
          <div class="timeline">
            <div class="plus"></div>
          </div>
      </div>
    </div>
</body>
</html>