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
    getStatus();
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