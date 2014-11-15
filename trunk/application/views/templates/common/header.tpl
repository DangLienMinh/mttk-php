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
  //window.notifyStatus="{site_url('statusController/hienThiNotiStatus/')}";
  window.cretePlaylist="{site_url('playlistController/viewPlaylist/')}";
  window.profilePic="{uploads_url()}img/profilePic.jpg";
  window.userPic="{uploads_url()}img/";
  window.userWall="{site_url('statusController/layDSWallStatus/')}";
  //window.friendController="{site_url('friendController/')}";
  window.playlistIcon="{base_url()}assets/img/playlistIcon.png";
  window.userMusic="{base_url('uploads/')}";
  window.homePage="{base_url('main/testPlayer/')}";
  window.userPicCmt="{uploads_url()}img/{$userPicCmt}";
  window.userLogin="{$userLogin}";
  window.userName="{$userName}";
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";
  window.chosenMusic = "";
  window.title="";

{literal}

$( document).ajaxStop(function() {
    $('#container').masonry({
        itemSelector: '.item'
    });
    Arrow_Points();
    $(".timeago").livequery(function() // LiveQuery 
    {
      $(this).timeago(); // Calling Timeago Funtion 
    });
});

function moreStatus(id,jplayer_id) {
  var dataString = 'status_id=' + id;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/getNextStatus')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      addMoreStatus(data,jplayer_id);
    }
  });
}

function moreWallStatus(id,jplayer_id,email) {
  var dataString = 'status_id=' + id+'&email='+email;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/getNextWallStatus')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      addMoreStatus(data,jplayer_id);
    }
  });
}

function waitForMsg() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('notiController/getOldNotify')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $.ajax({
        type: "post",
{/literal}
        url: "{base_url('notiController/getNewNotifyNumber')}",
{literal}
        cache: false,
        success: function(times) {
          if (times > 0) {
            $("#notification_count").replaceWith('<span id="notification_count">' + times + '</span>');
          } else {
            $("#notification_count").hide();
          }
          $('#notificationsBody>ul').append(data);
        }
      });
    }
  });
}

function suaStatus(status,msg) {
  var dataString = 'status_id=' + status+'&msg='+msg;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/suaStatus')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function() {
    }
  });
}

function setAllNotifyIsRead() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('notiController/setAllNotifyIsRead')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function() {
    }
  });
}

function moreNotify(id) {
  var dataString = 'noti_id=' + id;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('notiController/getNextOldNotify')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#notificationsBody ul').append(data);
    }
  });
}

function getFriendChat() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getAllChatFriends')}",
{literal}
    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#friendChatContainer>ul').append(data);
     $(".inline").colorbox({inline:true, width:"30%",height:"80%"});
    }
  });
}

function getFriendList(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getAllFriends')}",
{literal}
    async: true,
    data:dataString,
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#friendListContainer>ul').append(data);
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
    cache: false,
    timeout: 50000,
    success: function(data) {
      addConversation(data);
      setTimeout(
        getConversation,
        2000
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
    cache: false,
    timeout: 50000,
    success: function(data) { 
      addMoreConversation(data); 
    }
  });
}

function deleteStatus(status) {
  var dataString = 'status_id=' + status;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/xoaStatus')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function() {
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
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#playlistBox select').append(data);
      $('#playlistBox').append('<br/><a class="iframe" href="'+window.cretePlaylist+'">Create Playlist</a>');
      $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
    }
  });
}

function wallDsPlaylist(email) {
    var dataString = 'email=' + email;
    $.ajax({
    type: "post",
{/literal}
    url: "{base_url('playlistController/wallDsPlaylist')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
     var obj = JSON.parse(data);
     $.each(obj, function(i, val) {
      $('#playlistContainer>ul').append('<li><a class="inline" href="#inline_content"><img style="width:106px;height:106px;vertical-align:middle;margin-right:7px;float:left" src="' +window.playlistIcon+ '"/><span class="'+val.Playlist_id+'">' + val.Playlist_name+ '</span></a><div class="playlistSongs"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></li>');
      getSongWall(val.Playlist_id,i);
     });
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
    cache: false,
    timeout: 50000,
    success: function(data) {
      data=$.trim(data);
      var checkNumber=data.charAt(0);
      if($.isNumeric(checkNumber)){
        $("#friend_count").replaceWith('<span id="friend_count">'+checkNumber+'</span>');
        $('#friendBody>ul').append(data.substring(1));
      }else{
        $("#friend_count").hide();
      }
      $('#personalPage').append('<div class="cmtpic" align="center"><img src="' + window.userPicCmt + '" style="width:23px;height:23px;" /></div><b><a href="' + window.userWall + "/" + window.userLogin + '">' + window.userName + '</a></b>');
      $('#cover').append('<div class="coverImg"><img src="' + window.userPicCmtWall + '" style="width:130px;height:130px; border: 4px solid #fff;" /></div><span class="coverName"><b><a href="' + window.userWall + "/" + window.userLogin + '">' + window.userNameWall + '</a></b></span>');
    }
  });
}

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
    cache: false,
    success: function(data) {
      var checkComment=data.charAt(0);
      if($.isNumeric(checkComment)){
        $("#loadplace"+status).append(data.substring(1));
        getLastComment(status,checkComment);
      }else{
        $("#loadplace"+status).append(data);
      }
    }
  });
}

function getLastComment(status,count) {
  var dataString = 'status_id=' + status+'&count='+count;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('commentController/layLastComment')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    success: function(data) { 
        $("#loadplace"+status).append(data);
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
    cache: false,
    success: function(data) { 
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
              if(i==obj.length-1){
                $("#youlike" + status).append('<a href="' + window.userWall + "/" + val.email  + '">' + val.name + '</a>');
              }else{
                $("#youlike" + status).append('<a href="' + window.userWall + "/" + val.email  + '">' + val.name +', '+ '</a>');
              }
            }
            if (new_like_count > 0) {
              $("#youlike" + status).append(' and ' + new_like_count + ' other friends like this');
            }
          });
          $("#youlike" + status).append(' like this');
        }
      }
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
    cache: false,
    timeout: 50000,
    success: function(data) { 
      displaySong(name, inter,data);
    }
  });
}

function getSuggest(){
    $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getSuggestedFriend')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(response){
         $('#facebook').append(response);
      }
  });
}

function getPlaylistUpdateStatus() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('playlistController/getDSPlaylist')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#playlistBoxUpdateStatus select').append(data);
      var id=$('#playlistBoxUpdateStatus select').find(":selected").val();
      getSongUpdateStatus(id);
    }
  });
}

function getSongUpdateStatus(data) {
  $("#playlist_id").val(data);
  var dataString="playlist_id="+data;
  $.ajax({
    type: "post",
    data:dataString,
{/literal}
    url: "{base_url('playlistController/getDSSongs')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      displaySongUpdateStatus(data);
    }
  });
}

function getSongWall(id,number) {
  var dataString="playlist_id="+id;
  var cssSelector = {
    jPlayer: "#jquery_jplayer_"+number,
    cssSelectorAncestor: "#jp_container_"+number
  };
  /*An Empty Playlist*/
  var playlist = [];
  var options = {
    swfPath: "js",
    supplied: "mp3"
  };
  var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
  $.ajax({
    type: "post",
    data:dataString,
{/literal}
    url: "{base_url('playlistController/getDSSongs')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      var obj = JSON.parse(data);
      $.each(obj, function(i, val) {
        myPlaylist.add({
          title: val.title,
          mp3: val.mp3
        });
      });
    }
  });
}


$(document).on('click', '.addFriend', function() {
  var li=$(this).parent();
  $.ajax({
  type: "POST",
{/literal}
  url:"{base_url('friendController/themBan')}",
{literal}
  data: {friendEmail: $(this).val()},
  dataType: "text",
  cache:false,
  success:
      function(data){
        li.fadeOut('slow', function() {});
      }
  });
  return false;
});

$(document).on('click', '.unFriend', function() {
  var li=$(this).parent();
  $.ajax({
  type: "POST",
{/literal}
  url:"{base_url('friendController/xoaBan')}",
{literal}
  data: {friend: $(this).val()},
  dataType: "text",
  cache:false,
  success:
      function(data){
        li.fadeOut('slow', function() {});
      }
  });
  return false;
});

$(document).on('keypress', '.commentInput', function(e) {
  if (e.keyCode == 13) {
    e.preventDefault();
    var Id=$(this).attr('id').substring(14);
    var test = $(this).val();
    var dataString = 'textcontent=' + test + '&com_msgid=' + Id;
    $(this).val('');
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
  }
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

$(document).on('click', '.view_comments', function() {
  var status=$(this).attr("id");
  var dataString = 'status_id=' + status;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('commentController/layAllComment')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    success: function(data) {
      $("#loadplace" + status).empty();
      $("#loadplace" + status).append(data);
    }
  });
});

$(document).on('keyup', '#music_name', function() {
  $("#musicContainer").show();
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('statusController/chooseMusic')}",
{literal}
    cache: false,
    data: 'music_name=' + $("#music_name").val(),
    success: function(response) {
      $('#finalResult').html("");
      $('#finalResult').append(response);
    }
  });
});

$(document).on('change', '.editbox', function(e) {
  $(this).parent().hide();
  var element=$(this);
  var boxval = $(this).val();
  var name=$(this).attr('name');
  var dataString = 'data=' + boxval+'&name='+name;
  $.ajax({
    type: "POST",
{/literal}
    url: "{base_url('profileController/updateInfo')}",
{literal}
    data: dataString,
    cache: false,
    success: function() {
      element.parent().prev('.text_wrapper').html(boxval).show();
      element.parent().prev('.text_wrapper1').html(boxval).show();
    }
  });
});

$(document).on('change', '.editInput', function(e) {
  $(this).parent().hide();
  var element=$(this);
  var boxval = $(this).val();
  var name=$(this).attr('name');
  var dataString = 'data=' + boxval+'&name='+name;
  $.ajax({
    type: "POST",
{/literal}
    url: "{base_url('profileController/updateInfo')}",
{literal}
    data: dataString,
    cache: false,
    success: function() {
      element.parent().prev('.text_wrapper1').html(boxval).show();
    }
  });
});

$(document).on('change', '.editCheckbox', function(e) {
  $(this).parent().hide();
  var element=$(this);
  var boxval = $(this).val();
  var name=$(this).attr('name');
  var dataString = 'data=' + boxval+'&name='+name;
  $.ajax({
    type: "POST",
{/literal}
    url: "{base_url('profileController/updateInfo')}",
{literal}
    data: dataString,
    cache: false,
    success: function() {
      element.parent().prev('.text_wrapper1').html(boxval).show();
    }
  });
});


function getEducation() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('profileController/getEducationAndReligion')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about1').append(data);
    }
  });
}

function getBasicInfo() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('profileController/getBasicInfo')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about2').append(data);
    }
  });
}

function getUserDetail() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('profileController/getUserDetail')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about3').append(data);
    }
  });
}

function getFavorite() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('profileController/getFavorite')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about4').append(data);
    }
  });
}

{/literal}