<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/wall.css">
  <style type="text/css">
  

  </style>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jplayer.playlist.min.js"></script>
  <script type="text/javascript">
  {literal}
  $(document).ready(function() {
      $('#fanclubCreate').click(function(){
      	var name=$('#fanclubName').val();
      	var desc=$('#fanclubDesc').val();
      	var dataString = 'name=' + name+'&desc='+desc;
		  $.ajax({
		    type: "post",
		{/literal}
		    url: "{base_url('fanclubController/themFanclub')}",
		{literal}
		    data: dataString,
		    async: true,
		    cache: false,
		    timeout: 50000,
		    success: function(data) {
		      alert("complete");
		    }
		  });
      });

    });
  </script>
  {/literal}
</head>
<body>
  <div id="fanclub">
    <h2>Create new group</h2>
    <label>Fanclub name</label>
    <input style="display: inline-block;" placeholder="Fanclub name" type="text" id="fanclubName"/>
    <br/>
    <label>Fanclub description</label>
    <textarea id="fanclubDesc" rows="4" placeholder="Fanclub description"></textarea>

    <br/><br/><br/>
    <button type="submit" id="fanclubCreate">Create</button>
    <button type="submit" id="fanclubCancel">Cancel</button>
  </div>
</body>
</html>