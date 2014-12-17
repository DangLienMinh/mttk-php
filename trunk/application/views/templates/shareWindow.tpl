<html>
<head>
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jplayer.blue.monday.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/report.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/wall.js"></script>
    <script>
    window.mainController="{site_url('/')}";
{literal}

function getStatus(){
      var data;
{/literal}
      data={$items}
{literal}
    addStatusShare(data);
  }
  </script>
  <script>
  $(document).ready(function() {
    getStatus();
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

      $(document).on('click', '#shareStatus', function() {
        var id=$(this).parent().prev('div').find('div').attr('id');
        id= id.split("status").pop();
          $.ajax({
            type: "post",
      {/literal}
            url: "{base_url('shareController/themShare')}",
      {literal}
            cache: false,
            data: 'status_id=' + id+'&message='+$('#target').val(),
            success: function(response) {
              parent.window.location.href = window.mainController;
            }
          });
      });
  });
  </script>
 {/literal}
</head>
<body>
  <div id="reportHeader"> 
    <h3 class="">Share status</h3>
  </div>
  <div id="reportBody">
   <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea><br><br>
  </div>
  <div id="reportFooter">
    <button id="shareStatus">Share</button>
  </div>
</body>

</html>