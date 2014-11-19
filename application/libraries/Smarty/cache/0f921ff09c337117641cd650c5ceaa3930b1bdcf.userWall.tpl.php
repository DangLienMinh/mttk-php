<?php /*%%SmartyHeaderCode:32714546cbb11cdb0b4-47679701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f921ff09c337117641cd650c5ceaa3930b1bdcf' => 
    array (
      0 => 'application\\views\\templates\\userWall.tpl',
      1 => 1416408923,
      2 => 'file',
    ),
    'ab578d0f78d25a33237b48cbf4455ea57a89a476' => 
    array (
      0 => 'application\\views\\templates\\common\\header.tpl',
      1 => 1416411894,
      2 => 'file',
    ),
    '43fa4b8fd8c47d297992bda3dda6ee24684e1de9' => 
    array (
      0 => 'application\\views\\templates\\common\\notificationPart.tpl',
      1 => 1416411568,
      2 => 'file',
    ),
    '1f54f66af881d5f8352e0fc1b00021e7b247dd60' => 
    array (
      0 => 'application\\views\\templates\\common\\mainPart.tpl',
      1 => 1416324674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32714546cbb11cdb0b4-47679701',
  'variables' => 
  array (
    'items' => 0,
    'userNameWall' => 0,
    'userLoginWall' => 0,
    'userPicCmtWall' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546cbb1292ac33_06398002',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cbb1292ac33_06398002')) {function content_546cbb1292ac33_06398002($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Music</title>
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jplayer.blue.monday.playlist.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/wall.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jquery.qtip.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/colorbox.css">
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery-ui.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.hideseek.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.timeago.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.livequery.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.qtip.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/wall.js"></script>
  <script type="text/javascript">
  window.emotionsFolder="http://localhost:81/mttk-php/assets/img/emotions-fb/";
  </script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.emotions.js"></script>
  <script type="text/javascript">
  window.cretePlaylist="http://localhost:81/mttk-php/playlistController/viewPlaylist";
  window.createFanclub="http://localhost:81/mttk-php/fanclubController/createFanclub";
  window.profilePic="http://localhost:81/mttk-php/uploads/img/profilePic.jpg";
  window.userPic="http://localhost:81/mttk-php/uploads/img/";
  window.userWall="http://localhost:81/mttk-php/statusController/layDSWallStatus";
  window.playlistIcon="http://localhost:81/mttk-php/assets/img/playlistIcon.png";
  window.logoutIcon="http://localhost:81/mttk-php/assets/img/logout.png";
  window.logout="http://localhost:81/mttk-php/userController/logout";
  window.userMusic="http://localhost:81/mttk-php/uploads";
  window.homePage="http://localhost:81/mttk-php/main/homePage";
  window.chatPage="http://localhost:81/mttk-php/main/chat";
  window.userPicCmt="http://localhost:81/mttk-php/uploads/img/shot0006.jpg";
  window.userLogin="anhtiminh@yahoo.com";
  window.userName="minh dang";
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";
  window.chosenMusic = "";
  window.title="";



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

    url: "http://localhost:81/mttk-php/statusController/getNextStatus",

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

    url: "http://localhost:81/mttk-php/statusController/getNextWallStatus",

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

    url: "http://localhost:81/mttk-php/notiController/getOldNotify",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $.ajax({
        type: "post",

        url: "http://localhost:81/mttk-php/notiController/getNewNotifyNumber",

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

    url: "http://localhost:81/mttk-php/statusController/suaStatus",

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

    url: "http://localhost:81/mttk-php/notiController/setAllNotifyIsRead",

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

    url: "http://localhost:81/mttk-php/notiController/getNextOldNotify",

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

    url: "http://localhost:81/mttk-php/friendController/getAllChatFriends",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#chatContainer>ul').append(data);
     $(".inline").colorbox({inline:true,title:"<h1 style='margin-left: 180px; color:#fff!important;'>Chat</h1>", width:"30%",height:"80%"});
    }
  });
}

function getFriendList(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/friendController/getAllFriends",

    async: true,
    data:dataString,
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#friendList>ul').append(data);
    }
  });
}

function getMembers(fanclub) {
  var dataString = 'fanclub_id=' + fanclub;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/fanclubController/getAllMembers",

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

    url: "http://localhost:81/mttk-php/messageController/getFirstMessages",

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

    url: "http://localhost:81/mttk-php/messageController/getMoreMessages",

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

    url: "http://localhost:81/mttk-php/statusController/xoaStatus",

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

    url: "http://localhost:81/mttk-php/playlistController/getDSPlaylist",

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

    url: "http://localhost:81/mttk-php/playlistController/wallDsPlaylist",

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

    url: "http://localhost:81/mttk-php/friendController/getFriendRequest",

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
      $('#cover').append('<div class="coverImg hexagon hexagon1"><div class="hexagon-in1"><div class="hexagon-in2" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 103px 103px!important; background-position: 50%;"+'" ></div></div></div><span class="coverName"><b><a href="' + window.userWall + "/" + window.userLogin + '">' + window.userNameWall + '</a></b></span>');
      $('#logoutContainer').append('<a title="logout" href="'+window.logout+'" ><img src="'+window.logoutIcon+'" style="width:19px;height:19px;"/></a>');
    }
  });
}

function savePlaylist(id,title,url) {
  var dataString = 'playlist_id=' + id+'&title='+title+'&music='+url;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/playlistController/addMusic",

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

    url: "http://localhost:81/mttk-php/commentController/layComment",

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

    url: "http://localhost:81/mttk-php/commentController/layLastComment",

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

    url: "http://localhost:81/mttk-php/thumb_up_downController/layLikeUser",

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

      url: "http://localhost:81/mttk-php/thumb_up_downController/layLike",

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

    url: "http://localhost:81/mttk-php/playlistController/getDSSongs",

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

    url: "http://localhost:81/mttk-php/friendController/getSuggestedFriend",

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

    url: "http://localhost:81/mttk-php/playlistController/getDSPlaylist",

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

    url: "http://localhost:81/mttk-php/playlistController/getDSSongs",

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

    url: "http://localhost:81/mttk-php/playlistController/getDSSongs",

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

  url:"http://localhost:81/mttk-php/friendController/themBan",

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

  url:"http://localhost:81/mttk-php/friendController/xoaBan",

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
  }
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
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/thumb_up_downController/themXoaLike",

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

    url: "http://localhost:81/mttk-php/commentController/layAllComment",

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

    url: "http://localhost:81/mttk-php/statusController/chooseMusic",

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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/profileController/updateInfo",

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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;;
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/profileController/updateInfo",

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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;;
  $.ajax({
    type: "POST",

    url: "http://localhost:81/mttk-php/profileController/updateInfo",

    data: dataString,
    cache: false,
    success: function() {
      element.parent().prev('.text_wrapper1').html(boxval).show();
    }
  });
});


function getEducation(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/profileController/getEducationAndReligion",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about1').append(data);
    }
  });
}

function getBasicInfo(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/profileController/getBasicInfo",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about2').append(data);
    }
  });
}

function getUserDetail(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/profileController/getUserDetail",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about3').append(data);
    }
  });
}

function getFavorite(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/profileController/getFavorite",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('#about4').append(data);
    }
  });
}

function getFanclub() {
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/fanclubController/getFanclub",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('.fanclubInfo').append(data);
    }
  });
}
$(document).on('keyup', '.search', function() {
      if($(".search").val()!=''){
        $.ajax({
        type: "post",
  
        url:"http://localhost:81/mttk-php/friendController/searchMenu",
  
        cache: false,
        data:'search='+$(".search").val(),
        success: function(response){
          $('#displayUserBox').html(response).show();
        }
      });
    }
});



function getStatus(){
      var data;
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/

      data=[]

    addStatusUserWall(data);
    }
  </script>
  <script>

  window.userNameWall=" ";
  window.userLoginWall="TLBB1.mp3";
  window.userPicCmtWall="http://localhost:81/mttk-php/uploads/img/";

  $(document).ready(function() {
    waitForMsg();
    friendRequest();
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
    $('#search').hideseek();
    $("#target").autoGrow();
    $('#tabs').tabs({
      activate: function(event, ui) {
        $('#container').masonry({
          itemSelector: '.item'
        });
        var msnry = $('#container').data('masonry');
        msnry.on( 'layoutComplete', masonry_refresh );
        function masonry_refresh(){
          Arrow_Points();
        }
      }
    });

    $('#notificationsBody ul').bind('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
          var id=$(this).find('li:last').attr("id");
          moreNotify(id.substring(4));
        }
    });

      $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
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

      $('#headlineTimeline').find('span').css("display", "block");
      $('.headlineRight a').click(function(){
        $(this).find('span').css("display", "block");
        $(this).siblings("a").find('span').css("display", "none");
        return false;
      })
      $('#headlineFriendList').click(function(){
        $('#wallContainer').find('#view2').show();
        $('#wallContainer').find('#view2').siblings('div').hide();
      });
      $('#headlineTimeline').click(function(){
        $('#wallContainer').find('#view1').show();
        $('#wallContainer').find('#view1').siblings('div').hide();
        $('#container').masonry({
          itemSelector: '.item'
        });
      });
      $('#headlinePlaylist').click(function(){
        $('#wallContainer').find('#view3').show();
        $('#wallContainer').find('#view3').siblings('div').hide();
      });
      $('#headlineAbout').click(function(){
        $('#wallContainer').find('#view4').show();
        $('#wallContainer').find('#view4').siblings('div').hide();
      });
      $('#aboutLeft1').click(function(){
        $('#aboutRight').find('#about1').show();
        $('#aboutRight').find('#about1').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft2').click(function(){
        $('#aboutRight').find('#about2').show();
        $('#aboutRight').find('#about2').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft3').click(function(){
        $('#aboutRight').find('#about3').show();
        $('#aboutRight').find('#about3').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
      $('#aboutLeft4').click(function(){
        $('#aboutRight').find('#about4').show();
        $('#aboutRight').find('#about4').siblings('div').hide();
        $(this).addClass("aboutLeftSelected");
        $(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
        return false;
      });
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
  <ul id="nav">
    <div style=" width:300px; margin-right:23%;margin-left:15.5%;float:left;" align="right">
      <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
      <div id="displayUserBox">
      </div>
    </div>
    <li id="personalPage">
    </li>
    <li>
      <a href="#" id="homePage">Home</a>
    </li>
    <li id="friend_li">
      <span id="friend_count"></span>
      <a href="#" id="friendLink">Friends</a>
      <div id="friendContainer">
        <div id="friendTitle">Notifications</div>
        <div id="friendBody" class="friend">
          <ul></ul>
        </div>
        <div id="friendFooter">
          <h3>Suggest Friends</h3>
          <ul id="facebook"></ul>
        </div>
      </div>
    </li>
    <li>
      <a href="#" id="chatPage">Chat</a>
    </li>
    <li id="notification_li">
      <span id="notification_count"></span>
      <a href="#" id="notificationLink">Notifications</a>
      <div id="notificationContainer">
        <div id="notificationTitle">
          Notifications
          <a href="#" id="markRead">Mark all read</a>
        </div>
        <div id="notificationsBody" class="notifications">
          <ul></ul>
        </div>
        <div id="notificationFooter"><a href="#">See All</a></div>
      </div>
    </li>
    <li id="logoutContainer">
    </li>
  </ul>
</div>
  <div id="coverContainer">
    <div id="cover">
    </div>
    <div id="headline">
      <div class="headlineRight">
        <a id="headlineTimeline" href="#">TimeLine</a>
        <a id="headlineAbout" href="#">About</a>
        <a id="headlineFriendList" href="#">Friends</a>
        <a id="headlinePlaylist" href="#">Playlist</a>
        <a class="" href="#">More</a>
      </div>
    </div>
  </div>
    <div id="wallContainer">
      <div id="view1">
        <div id="container">
  <div class="timeline_container">
    <div class="timeline">
      <div class="plus"></div>
    </div>
  </div>
  <div class="item">
    <form action="http://localhost:81/mttk-php/statusController/updateStatus" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <div id="tabs">
      <ul>
        <li><a href="#tabs-1">Choose music</a></li>
        <li><a href="#tabs-2">Upload music</a></li>
        <li><a href="#tabs-3">Playlist</a></li>
      </ul>
      <div id="tabs-1">
        <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <input type="text" name="music_name" id="music_name" placeholder="Song name?"/>
        <input type="hidden" name="fanclub_id"/>
        <input type="hidden" name="music_url" id="music_url" />
        <input type="hidden" name="title" id="title" />
        <div id="musicContainer">
          <div id="musicBody" class="musics">
            <ul id="finalResult"></ul>
          </div>
        </div>
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div id="jp_container_1" class="jp-audio centerAlign">
          <div class="jp-type-single">
            <div class="jp-gui jp-interface">
              <ul class="jp-controls">
                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
              </ul>
              <div class="jp-progress">
                <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
                </div>
              </div>
              <div class="jp-volume-bar">
                <div class="jp-volume-bar-value"></div>
              </div>
              <div class="jp-time-holder">
                <div class="jp-current-time"></div>
                <div class="jp-duration"></div>
                <ul class="jp-toggles">
                  <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                  <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
                </ul>
              </div>
            </div>
            <div class="jp-details">
              <ul>
                <li><span class="jp-title"></span></li>
              </ul>
            </div>
            <div class="jp-no-solution">
              <span>Update Required</span>
              To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
            </div>
          </div>
        </div>
      </div>
      <div id="tabs-2">
        <textarea name="status2" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <input type="file" name="musicFile" size="20"/>
      </div>
      <div id="tabs-3">
        <div id="playlistBoxUpdateStatus">
          <select></select>
          <input type="hidden" name="playlist_id" id="playlist_id" />
        </div>
        <textarea name="status3" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div id="jp_container_2" class="jp-audio centerAlign">
          <div class="jp-type-playlist">
            <div class="jp-gui jp-interface">
              <ul class="jp-controls">
                <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
                <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
              </ul>
              <div class="jp-progress">
                <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
                </div>
              </div>
              <div class="jp-volume-bar">
                <div class="jp-volume-bar-value"></div>
              </div>
              <div class="jp-current-time"></div>
              <div class="jp-duration"></div>
              <ul class="jp-toggles">
                <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li>
                <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">shuffle off</a></li>
                <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
              </ul>
            </div>
            <div class="jp-playlist">
              <ul>
                <li></li>
              </ul>
            </div>
            <div class="jp-no-solution">
              <span>Update Required</span>
              To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
            </div>
          </div>
        </div>
        <!--cai playlist de day dung ajax load vao combo-->
      </div>
      <div id="privacyRight">
        <select name="privacy" id="privacy">
          <option selected value="1">Public</option>
          <option value="2">Friend</option>
          <option value="3">Custom</option>
          <option value="4">Private</option>
        </select>
        <input type="submit" value="Post" id="postStatus"/>
      </div>
    </div>
    </form>
  </div>
</div>
<div id="pop">
  <img/>
  <h2></h2>
</div>
<div style="display: none; border: 1px solid black; height: 50px; width: 180px; 
  padding: 5px; position: absolute; left: 100px; top: 100px; 
  background-color: silver;" id="playlistBox">
  <select></select>
  <input type="hidden" id="titleMusic"/>
  <input type="hidden" id="urlMusic"/>
  <button id="savePlaylist">Save</button>
</div>
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
    </div>
</body>
</html><?php }} ?>
