<html>
<head>
<script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
  {literal}
  $(document).ready(function() {
      $('#playlistCreate').click(function(){
      	var name=$('#playlistName').val();
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
          	window.parent.location.href=data;
		    }
		  });
      });

    });
  </script>
  {/literal}
</head>
<body>
    <div>
    <!-- {form_open('playlistController/createPlaylist')} -->
    <h5>Playlist name</h5>
    <input type="text" name="playlistName" id="playlistName"/>
    <button type="submit" id="playlistCreate">Create</button>
<!--     {form_close()} -->
  </div>
</body>
</html>