{include file='common/header.tpl'}
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
  });
  </script>
 {/literal}
</head>
<body>
  <div id="container">
    <br><br>
    <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea>
    <br/>

  </div>
  <button id="shareStatus">Share</button>
</body>
</html>