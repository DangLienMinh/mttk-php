<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Music</title>
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jplayer.blue.monday.playlist.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/wall.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jquery.qtip.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/colorbox.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery-ui.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.timeago.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.livequery.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.qtip.js"></script>
  <script type="text/javascript" src="{asset_url()}js/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/wall.js"></script>
  <script type="text/javascript">
  window.emotionsFolder="{asset_url()}img/emotions-fb/";
  </script>
  <script type="text/javascript" src="{asset_url()}js/jquery.emotions.js"></script>
  <script type="text/javascript">
  window.notifyStatus="{site_url('statusController/hienThiNotiStatus/')}";
  window.cretePlaylist="{site_url('playlistController/viewPlaylist/')}";
  window.profilePic="{uploads_url()}img/profilePic.jpg";
  window.userPic="{uploads_url()}img/";
  window.userWall="{site_url('statusController/layDSWallStatus/')}";
  window.userLogin="{$userLogin}";
  window.friendController="{site_url('friendController/')}";
  window.userPicCmt="{uploads_url()}img/{$userPicCmt}";
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";

{literal}
function waitForMsg() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('notiController/getOldNotify')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      $.ajax({
        type: "post",
{/literal}
        url: "{base_url('notiController/getNewNotifyNumber')}",
{literal}
        cache: false,
        success: function(times) {
          addmsg(data, times);
        }
      });
    }
  });
}

function getFriendList() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getAllFriends')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
     addFriendList(data);
    }
  });
}

function getConversation(userEmail) {
  if(typeof userEmail !== 'undefined'){
    if( window.userChat!=userEmail){
      $("#inline_content ol").empty();
        window.userChat = userEmail;
    }
  }
  var dataString = 'email=' + window.userChat;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('messageController/getFirstMessages')}",
{literal}
    data: dataString,
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    success: function(data) { /* called when request to barge.php completes */
      addConversation(data); /* Add response to a .msg div (with the "new" class)*/
      setTimeout(
        getConversation, /* Request next message */
        2000 /* ..after 1 seconds */
      );
    }
  });
}

function getMoreConversation(userEmail,last_id) {
  var dataString = 'email=' + userEmail+'&started='+last_id;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('messageController/getMoreMessages')}",
{literal}
    data: dataString,
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    success: function(data) { /* called when request to barge.php completes */
      addMoreConversation(data); /* Add response to a .msg div (with the "new" class)*/
    }
  });
}

function getPlaylist() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('playlistController/getDSPlaylist')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addPlaylist(data);
    }
  });
}

function friendRequest() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getFriendRequest')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      addFriendRequest(data);
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
{/literal}
    $("#flash" + Id).fadeIn(400).html('<img src="{asset_url()}img/ajax-loader.gif" align="absmiddle"> loading.....');
{literal}    
    $.ajax({
      type: "post",
{/literal}
      url: "{base_url('commentController/themComment')}",
{literal}
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
{/literal}
    url: "{base_url('commentController/xoaComment')}",
{literal}
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
  $.ajax({
    type: "POST",
{/literal}
    url: "{base_url('thumb_up_downController/themXoaLike')}",
{literal}
    data: dataString,
    cache: false,
    success: function(data) {
      if (REL == 'Like') {
        if ($('#youlike' + New_ID).children().length > 0) {
          $("#youlike" + New_ID).slideDown('fast').prepend("<span id='you" + New_ID + "'><a href='#'>You</a></span>,&nbsp;");
          $("#likes" + New_ID).html("<span id='you" + New_ID + "'><a href='#'>You </a></span>");
          $('#' + ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
        } else {
          $("#youlike" + New_ID).slideDown('fast').html("<span id='you" + New_ID + "'><a href='#'>You </a></span>&nbsp;like this");
          $('#' + ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
        }
        
      } else {
        if ($('#youlike' + New_ID).children().length > 1) {
          $("#you" + New_ID).slideUp('fast');
          $("#you" + New_ID).remove();
          $('#' + ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
        } else {
          $("#youlike" + New_ID).slideUp('fast');
          $("#you" + New_ID).remove();
          $('#' + ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
        }
      }
    }
  });
  return false;
});

function savePlaylist(id,title,url) {
  var dataString = 'playlist_id=' + id+'&title='+title+'&music='+url;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('playlistController/addMusic')}",
{literal}
    data: dataString,
    cache: false,
    success: function() {
      alert("ok");
      }
    });
}

function getComment(status) {
  var dataString = 'status_id=' + status;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('commentController/layComment')}",
{literal}
    data: dataString,
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    success: function(data) { /* called when request to barge.php completes */
      var obj = JSON.parse(data);
      if (obj.length > 0) {
        $.each(obj, function(i, val) {
          var is_delete="";
          if(val.email==window.userLogin){
            is_delete="delete_button";
          }
          $("#loadplace" + val.status_id).append('<li class="load_comment"><span id="' + val.name + '"></span><img id="'+val.email+'" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/><span>' + val.message + '</span><a href="#" id="' + val.comment_id + '" class="'+is_delete+'"></a><br/><abbr class="timeago" title="' + val.created_at + '"></abbr></li>');
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
{/literal}
    url: "{base_url('thumb_up_downController/layLikeUser')}",
{literal}
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
{/literal}
      url: "{base_url('thumb_up_downController/layLike')}",
{literal}
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
              $("#youlike" + status).append('<a href="' + window.userWall + "/" + val.email  + '">' + val.name + '</a>');
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

function getSong(name, inter, songUrl) {
  var dataString="playlist_id="+songUrl;
  $.ajax({
    type: "post",
    data:dataString,
{/literal}
    url: "{base_url('playlistController/getDSSongs')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      displaySong(name, inter,data);
    }
  });
}
{/literal}