<?php /* Smarty version Smarty-3.1.18, created on 2014-11-27 17:57:06
         compiled from "application\views\templates\userWall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10985547757e21e5984-38432124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f921ff09c337117641cd650c5ceaa3930b1bdcf' => 
    array (
      0 => 'application\\views\\templates\\userWall.tpl',
      1 => 1417099468,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10985547757e21e5984-38432124',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'userNameWall' => 0,
    'userLoginWall' => 0,
    'userPicCmtWall' => 0,
    'profileCover' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_547757e247e2a4_36625187',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547757e247e2a4_36625187')) {function content_547757e247e2a4_36625187($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;

      data=<?php echo $_smarty_tpl->tpl_vars['items']->value;?>


    addStatusUserWall(data);
    }
  </script>
  <script>

  window.userNameWall="<?php echo $_smarty_tpl->tpl_vars['userNameWall']->value;?>
";
  window.userLoginWall="<?php echo $_smarty_tpl->tpl_vars['userLoginWall']->value;?>
";
  window.userPicCmtWall="<?php echo uploads_url();?>
img/<?php echo $_smarty_tpl->tpl_vars['userPicCmtWall']->value;?>
";
  window.profileCover="<?php echo $_smarty_tpl->tpl_vars['profileCover']->value;?>
";

  $(document).ready(function() {
    $('#coverContainer').css('background', 'url("' + window.userPic + window.profileCover + '")').css('background-size', 'cover');
    waitForMsg();
    friendRequest(window.userLoginWall);
    getStatus();
    getPlaylist();
    getSuggest();
    getPlaylistUpdateStatus();
    getEducation(window.userLoginWall);
    getBasicInfo(window.userLoginWall);
    getUserDetail(window.userLoginWall);
    getFavorite(window.userLoginWall);
    getFriendList(window.userLoginWall);
    wallDsPlaylist(window.userLoginWall);
    checkUserWallRelation(window.userLoginWall);
    $('#search').hideseek();
    $("#target").autoGrow();
    $('#tabs').tabs({
      activate: function(event, ui) {
        $('#container').masonry({
          itemSelector: '.item'
        });
        var msnry = $('#container').data('masonry');
        msnry.on('layoutComplete', masonry_refresh);

        function masonry_refresh() {
          Arrow_Points();
        }
      }
    });

    $('#notificationsBody ul').bind('scroll', function() {
      if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
        var id = $(this).find('li:last').attr("id");
        moreNotify(id.substring(4));
      }
    });

    $("#jquery_jplayer_1").jPlayer({
      ready: function(event) {
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

    var options = {
      thumbBox: '.thumbBox',
      spinner: '.spinner',
      imgSrc: window.userPic + window.profileCover
    }
    var cropper = $('.imageBox').cropbox(options);

    $('#changeCover').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(e) {
        options.imgSrc = e.target.result;
        cropper = $('.imageBox').cropbox(options);
      }
      reader.readAsDataURL(this.files[0]);
      this.files = [];
    });

    $('#btnCrop').on('click', function() {
      var img = cropper.getDataURL();
      $.ajax({
        type: "POST",

        url: "<?php echo base_url('profileController/suaProfileCover');?>
",

        data: {
          image: img
        },
        success: function() {
          location.reload();
        }
      });
    });

    $('#headlineTimeline').find('span').css("display", "block");


    $('#content').keypress(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();
        var boxval = $(this).val();
        var user = $("#toUser").val();
        var dataString = 'email=' + user + '&message=' + boxval;
        if (boxval.length > 0) {
          if (boxval.length < 200) {
            $("#flash").show();

            $("#flash").fadeIn(400).html('<img src="<?php echo asset_url();?>
img/ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Update...</span>');

            $.ajax({
              type: "POST",

              url: "<?php echo base_url('messageController/addMessage');?>
",

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
 
</head>
  <body>
    <div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
       <?php echo $_smarty_tpl->getSubTemplate ('common/notificationPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

      <div id="lookbook" style="display: block;">
        <div>
          <div id="coverContainer" style="height: 467px;">
              <div class="coverChange" style="display:none">
                  <input type="file" id="changeCover" style="width: 250px"/>
                  <input type="button" id="btnCrop" value="Finish"/>
              </div>
              <div class="imageBox">
                  <div class="thumbBox"></div>
                  <div class="spinner" style="display: none">Loading...</div>
              </div>
              <div id="headline">
                <div class="headlineRight">
                  <a id="headlineTimeline" href="#">TimeLine</a>
                  <a id="headlineAbout" href="#">About</a>
                  <a id="headlineFriendList" href="#">Friends</a>
                  <a id="headlinePlaylist" href="#">Playlist</a>
                  <a class="" href="#">More</a>
                </div>
                <div class="headlineLeft">
                </div>
              </div>
              <div id="cover">
              </div>
          </div>
          <div class="inner">
            <div id="c2013">
              <div class="col1">Chỗ này chưa biết viết cái gì hết nên thôi cứ để đại mấy dòng rồi tính sau...</div>
              <div class="col2">Chỗ này sẽ ghi thông tin tài khoản hay 1 dòng giới thiệu ngắn về chủ tài khoản đang sử dụng<br><br>bla... bla... bla...</div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <div id="wallContainer">
      <div id="view1">
        <?php ob_start();?><?php echo form_open_multipart('statusController/updateStatus');?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ('common/mainPart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('postStatus'=>$_tmp1), 0);?>

      </div>
      <div id="view4" style="display:none;">
        <div id="aboutContainer">
          <div id="aboutLeft">
            <ul>
              <li><a id="aboutLeft1" href="#"><span>Education  and Religion</span></a></li>
              <li><a id="aboutLeft2" href="#"><span>Contact and Basic Info</span></a></li>
              <li><a id="aboutLeft3" href="#"><span>Details about you</span></a></li>
              <li><a id="aboutLeft4" href="#"><span>Favorites</span></a></li>
            </ul>
          </div>
          <div id="aboutRight">
            <div class="aboutContent">
              <div id="about1"></div>
              <div id="about2" style="display:none;"></div>
              <div id="about3" style="display:none;"></div>
              <div id="about4" style="display:none;"></div>
              <div id="about5" style="display:none;"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="view2" style="display:none;">
        <div id="friendListContainer">
        <div id="chatTitle">
          <h3>Search</h3>
          <input id="search" name="search" placeholder="Start typing here" type="text" data-list=".list">
        </div>
        <div id="friendList">
          <ul class="list"></ul>
        </div>
      </div>
      </div>
      <div id="view3" style="display:none;">
        <div id="playlistContainer">
          <ul></ul>
        </div>
      </div>
      <div style="width:550px; float:left; margin:30px;display:none;">
        <div id='inline_content' style='padding:10px; background:#fff;'>
          <ol id="update" style="list-style:none;">
          </ol>
          <div id="flash"></div>
          <audio id="chatAudio"><source src="<?php echo asset_url();?>
sound/notify.ogg" type="audio/ogg"><source src="<?php echo asset_url();?>
sound/notify.mp3" type="audio/mpeg"><source src="<?php echo asset_url();?>
sound/notify.wav" type="audio/wav"></audio>
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
    </div>
        <div id="inside">
          <div id="lookbook-shop-now" style="height: 448px; background-position: 0px 50%;"></div>
          <a href="#" target="_blank" class="bt3 lookbookshopnow">ABC NOW</a>
        </div>
      </div>
    </div>
  </body>
</html><?php }} ?>
