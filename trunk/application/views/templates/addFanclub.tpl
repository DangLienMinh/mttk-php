<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/wall.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript">
  {literal}
  $(document).ready(function() {
    $('#fanclubCreate').click(function() {
      var name = $('#fanclubName').val();
      var desc = $('#fanclubDesc').val();
      var dataString = 'name=' + name + '&desc=' + desc;
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