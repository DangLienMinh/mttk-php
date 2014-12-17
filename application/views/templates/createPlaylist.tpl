<html>
<head>
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/report.css">
<script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>

<script type="text/javascript">
  {literal}
  $(document).ready(function() {
    $(".cancelButton").click(function(){
          parent.jQuery.colorbox.close();
    });


    $('#playlistCreate').click(function() {
      var name = $('#playlistName').val();
      var dataString = 'playlistName=' + name;
      $.ajax({
        type: "post",
    {/literal}
        url: "{base_url('playlistController/createPlaylist')}",
    {literal}
        data: dataString,
        async: true,
        cache: false,
        timeout: 50000,
        success: function(data) {
          parent.jQuery.colorbox.close();
          window.parent.location.href = data;
        }
      });
    });
  });
  </script>
  {/literal}
</head>
<body>
  <!-- <div>
    <h5>Playlist name</h5>
    <input type="text" name="playlistName" id="playlistName"/>
    <button type="submit" id="playlistCreate">Create</button>
  </div> -->
  <div id="reportHeader"> 
    <h3 class="">Create new playlist</h3>
  </div>
  <div id="reportBody">
    <ul>
      <li>
        <div class="option">
          <div class="ptm"><table class="uiInfoTable uiInfoTableFixed noBorder" role="presentation"><tbody><tr class="dataRow"><th class="label"><label for="password_old">Current</label></th><td class="data"><input type="text" class="inputtext" name="password_old" id="playlistName"></td></tr><tr><th class="label noLabel"></th><td class="data"><div>&nbsp;</div></td></tr></tbody></table></div>
        </div>
        
      </li>
    </ul>
  </div>
  <div id="reportFooter">
    <button class="cancelButton">Cancel</button>
    <button type="submit" id="playlistCreate">Save playlist</button>
  </div>
</body>
</html>