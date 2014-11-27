{include file='common/header.tpl'}
{literal}
  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getFriendChat();
    getSuggest();
    $('#notificationsBody ul').bind('scroll', function() {
      if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
        var id = $(this).find('li:last').attr("id");
        moreNotify(id.substring(4));
      }
    });

    $('#search').hideseek();

    $('#content').keypress(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        var boxval = $(this).val();
        var user = $("#toUser").val();
        var dataString = 'email=' + user + '&message=' + boxval;
        if (boxval.length > 0) {
          if (boxval.length < 200) {
            $("#flash").show();
{/literal}
            $("#flash").fadeIn(400).html('<img src="{asset_url()}img/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Update...</span>');
{literal}
            $.ajax({
              type: "POST",
{/literal}
              url: "{base_url('messageController/addMessage')}",
{literal}
              data: dataString,
              cache: false,
              success: function(html) {
                $(html).appendTo('#inline_content ol').emotions();
                $('#content').val('');
                $("#flash").hide();
                $('#content').focus();
              }
            });
          } else {
            alert("Please delete some Text max 200 charts");
          }
        }
        $('#cboxLoadedContent').animate({
          scrollTop: $('#cboxLoadedContent').prop("scrollHeight")
        }, 700);
      }
    });
  });
  </script>
 {/literal}
</head>
<body>
  <div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
    {include file='common/notificationPart.tpl'}
  </div>
    <div id="friendChatContainer">
      <div id="chatTitle">
        <h3>Search</h3>
        <input id="search" name="search" placeholder="Start typing here" type="text" data-list=".list">
      </div>
      <div id="chatContainer">
        <ul class="list"></ul>
      </div>
    </div>
      <div style="width:550px; float:left; margin:30px;display:none;">
        <div id='inline_content' style='padding:10px; background:#fff;'>
          <ol id="update" style="list-style:none;">
          </ol>
          <div id="flash"></div>
          <audio id="chatAudio"><source src="{asset_url()}sound/notify.ogg" type="audio/ogg"><source src="{asset_url()}sound/notify.mp3" type="audio/mpeg"><source src="{asset_url()}sound/notify.wav" type="audio/wav"></audio>
          <div>
              <div align="left">
              <table>
              <tr>
                <td>
                  <input type='text' class="textbox" name="content" id="content" maxlength="200" placeholder="Message"/>
                </td>
                <input type='hidden' name="toUser" id="toUser" />
              </tr>
              </table>
              </div>
          </div>
        </div>
      </div>
</body>
</html>