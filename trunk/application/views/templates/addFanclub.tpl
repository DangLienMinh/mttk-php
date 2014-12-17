<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/report.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript">
  {literal}
  $(document).ready(function() {
    $(".cancelButton").click(function(){
          parent.jQuery.colorbox.close();
        });

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
  <!-- div id="fanclub">
    <h2>Create new group</h2>
    <label>Fanclub name</label>
    <input style="display: inline-block;" placeholder="Fanclub name" type="text" id="fanclubName"/>
    <br/>
    <label>Fanclub description</label>
    <textarea id="fanclubDesc" rows="4" placeholder="Fanclub description"></textarea>

    <br/><br/><br/>
    <button type="submit" id="fanclubCreate">Create</button>
    <button type="submit" id="fanclubCancel">Cancel</button>
  </div> -->
  <div id="reportHeader"> 
    <h3 class="">Create new Fanclub</h3>
  </div>
  <div id="reportBody">
    <ul>
      <li>
        <div class="option">
          <div class="ptm"><table class="uiInfoTable uiInfoTableFixed noBorder" role="presentation"><tbody><tr class="dataRow"><th class="label"><label for="password_old">Fanclub name</label></th><td class="data"><input type="text" class="inputtext" name="password_old" id="fanclubName"></td></tr><tr><th class="label noLabel"></th><td class="data"><div>&nbsp;</div></td></tr><tr class="dataRow"><th class="label"><label for="password_new">Fanclub description</label></th><td class="data"><textarea id="fanclubDesc" name="password_new" rows="4"></textarea></td></tr><tr><th class="label noLabel"></th><td class="data"><div id="password_new_status">&nbsp;</div></td></tr></tbody></table></div>
        </div>
        
      </li>
    </ul>
  </div>
  <div id="reportFooter">
    <button type="submit" class="cancelButton">Cancel</button>
    <button type="submit" id="fanclubCreate">Create Fanclub</button>
  </div>
</body>
</html>