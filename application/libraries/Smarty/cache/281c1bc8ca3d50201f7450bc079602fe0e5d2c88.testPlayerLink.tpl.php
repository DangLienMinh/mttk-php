<?php /*%%SmartyHeaderCode:15554468333032518-46981044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '281c1bc8ca3d50201f7450bc079602fe0e5d2c88' => 
    array (
      0 => 'application\\views\\templates\\testPlayerLink.tpl',
      1 => 1413907248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15554468333032518-46981044',
  'variables' => 
  array (
    'userPicCmt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5446833323b9c2_27560599',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5446833323b9c2_27560599')) {function content_5446833323b9c2_27560599($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jplayer.blue.monday.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/wall.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.timeago.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.livequery.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/wall.js"></script>
  <script type="text/javascript">
  window.notifyStatus="http://localhost:81/mttk-php/statusController/hienThiNotiStatus";
  window.profilePic="http://localhost:81/mttk-php/uploads/img/profilePic.jpg";
  window.userPic="http://localhost:81/mttk-php/uploads/img/";
  window.userWall="http://localhost:81/mttk-php/statusController/layDSWallStatus";
  window.userPicCmt="http://localhost:81/mttk-php/uploads/img/a6551.jpg";
  window.compare=0;
  window.compareStatus=0;


function waitForMsg() {
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/notiController/getOldNotify",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      $.ajax({
        type: "post",

        url: "http://localhost:81/mttk-php/notiController/getNewNotifyNumber",

        cache: false,
        success: function(times) {
          addmsg(data, times);
        }
      });
    }
  });
}

$(document).on('click', '.comment_submit', function() {
  var element = $(this);
  var Id = element.attr("id");
  var test = $("#textboxcontent" + Id).val();
  var dataString = 'textcontent=' + test + '&com_msgid=' + Id;
  if (test == '') {
    alert("Please Enter Some Text");
  } else {
    $("#flash" + Id).show();

    $("#flash" + Id).fadeIn(400).html('<img src="http://localhost:81/mttk-php/assets/img/ajax-loader.gif" align="absmiddle"> loading.....');
    
    $.ajax({
      type: "post",

      url: "http://localhost:81/mttk-php/commentController/themComment",

      data: dataString,
      cache: false,
      success: function(html) {
        $("#loadplace" + Id).append(html);
        $("#flash" + Id).hide();
      }
    });
  }
  return false;
});

$(document).on('click', '.delete_button', function() {
  var id = $(this).attr("id");
  var dataString = 'id=' + id;
  var parent = $(this).parent();
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/commentController/xoaComment",

    data: dataString,
    cache: false,
    success: function() {
      if (id % 2) {
        parent.fadeOut('slow', function() {
          $(this).remove();
        });
      } else {
        parent.slideUp('slow', function() {
          $(this).remove();
        });
      }
    }
  });
  return false;
});

$(document).on('click', '.like', function() {
  var ID = $(this).attr("id");
  var sid = ID.split("like");
  var New_ID = sid[1];
  var REL = $(this).attr("rel");
  var dataString = 'status_id=' + New_ID + '&rel=' + REL;
  alert(dataString);
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/thumb_up_downController/themXoaLike",

    data: dataString,
    cache: false,
    success: function(data) {
      if (REL == 'Like') {
        $("#youlike" + New_ID).slideDown('fast').prepend("<span id='you" + New_ID + "'><a href='#'>You</a></span>.");
        $("#likes" + New_ID).prepend("<span id='you" + New_ID + "'><a href='#'>You</a></span>");
        $('#' + ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
      } else {
        $("#youlike" + New_ID).slideUp('fast');
        $("#you" + New_ID).remove();
        $('#' + ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
      }
    }
  });
  return false;
});

function getStatus() {
  /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/statusController/index",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addStatus(data); /* Add response to a .msg div (with the "new" class)*/
      setTimeout(
        getStatus, /* Request next message */
        3000 /* ..after 1 seconds */
      );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      addStatus("error", textStatus + " (" + errorThrown + ")");
      setTimeout(
        getStatus, /* Try again after.. */
        15000); /* milliseconds (15seconds) */
    }
  });
}

function getComment(status) {
  var dataString = 'status_id=' + status;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/commentController/layComment",

    data: dataString,
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    success: function(data) { /* called when request to barge.php completes */
      var obj = JSON.parse(data);
      if (obj.length > 0) {
        $.each(obj, function(i, val) {
          $("#loadplace" + val.status_id).append('<li class="load_comment"><span id="' + val.name + '"></span><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/><span>' + val.message + '</span><a href="#" id="' + val.comment_id + '" class="delete_button"></a><br/><abbr class="timeago" title="' + val.created_at + '"></abbr></li>');
        });
      }
    }
  });
}

function getLike(status) {
  var dataString = 'status_id=' + status;
  var isLike = 0;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/thumb_up_downController/layLikeUser",

    data: dataString,
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    success: function(data) { /* called when request to barge.php completes */
      var obj = JSON.parse(data);
      if (obj.length > 0) {
        isLike = 1;
        $("#like" + status).replaceWith('<a href="#" class="like like_button" id="like' + status + '" title="UnLike" rel="UnLike">UnLike</a>');
        $("#loadplace" + status).prev('div').append('<div class="likeUsers" id="youlike' + status + '"></div>');
      } else {
        $("#like" + status).replaceWith('<a href="#" class="like like_button" id="like' + status + '" title="Like" rel="Like">Like</a>');
        $("#loadplace" + status).prev('div').append('<div class="likeUsers" id="youlike' + status + '"></div>');
      }
    }
  }).done(function() {
    $.ajax({
      type: "post",

      url: "http://localhost:81/mttk-php/thumb_up_downController/layLike",

      data: dataString,
      async: true,
      /* If set to non-async, browser shows page as "Loading.."*/
      cache: false,
      success: function(data) {
        var obj = JSON.parse(data);
        var new_like_count = obj.length - 3;
        if (obj.length > 0) {
          $.each(obj, function(i, val) {
            if (isLike == 1) {
              if (obj.length > 1) {
                $("#youlike" + status).append('<span id="you' + status + '"><a href="' + val.email + '">You,&nbsp;</a></span>');
              } else {
                $("#youlike" + status).append('<span id="you' + status + '"><a href="' + val.email + '">You</a></span>');
              }
              isLike = 0;
            } else {
              $("#youlike" + status).append('<a href="' + val.email + '">' + val.name + '</a>');
            }
            if (new_like_count > 0) {
              $("#youlike" + status).append(' and ' + new_like_count + ' other friends like this');
            }
          });
          $("#youlike" + status).append(' like this');
        }
      }
    }).done(function() {
      $('#container').masonry({
        itemSelector: '.item',
      });
      Arrow_Points();
      $(".timeago").livequery(function() // LiveQuery 
        {
          $(this).timeago(); // Calling Timeago Funtion 
        });
    });
  });
}
  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    getStatus();
    $('#noti_Container').click(function() {
      if ($('#noti_content').css('display') == 'none') {
        $('#noti_content').css('display', 'block');
      } else {
        $('#noti_content').css('display', 'none');
      }
    });
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
    <img src="http://l-stat.livejournal.com/img/facebook-profile.gif" alt="profile" />
    <div class="noti_bubble"></div>
  </div>
  <div id="noti_content">
    <ul></ul>
  </div>
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
    </div>
    <div id="pop" class="popbox">
      <img/>
      <h2></h2>
    </div>
</body>
</html><?php }} ?>
