<?php /*%%SmartyHeaderCode:25108547757a12e1698-68114529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7aef88f2254b428ca8164bfc0bf4456c5220e591' => 
    array (
      0 => 'application\\views\\templates\\notiStatus.tpl',
      1 => 1417107099,
      2 => 'file',
    ),
    'ab578d0f78d25a33237b48cbf4455ea57a89a476' => 
    array (
      0 => 'application\\views\\templates\\common\\header.tpl',
      1 => 1417106150,
      2 => 'file',
    ),
    '43fa4b8fd8c47d297992bda3dda6ee24684e1de9' => 
    array (
      0 => 'application\\views\\templates\\common\\notificationPart.tpl',
      1 => 1417106040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25108547757a12e1698-68114529',
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_547757a19915f9_21589258',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547757a19915f9_21589258')) {function content_547757a19915f9_21589258($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Music</title>
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jplayer.blue.monday.playlist.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/wall.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jquery.qtip.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/colorbox.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jquery_notification.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/a.css">
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
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery_notification_v.1.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/cropbox.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/wall.js"></script>

  <script type="text/javascript">
    window.emotionsFolder="http://localhost:81/mttk-php/assets/img/emotions-fb/";
  </script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.emotions.js"></script>
  <script type="text/javascript">

  window.cretePlaylist="http://localhost:81/mttk-php/playlistController/viewPlaylist";
  window.changeProfilePic="http://localhost:81/mttk-php/profileController/changeProfileImage";
  window.createFanclub="http://localhost:81/mttk-php/fanclubController/createFanclub";
  window.userWall="http://localhost:81/mttk-php/statusController/layDSWallStatus";
  window.mainController="http://localhost:81/mttk-php/main";
  window.logout="http://localhost:81/mttk-php/userController/logout";

  window.playlistIcon="http://localhost:81/mttk-php/assets/img/";

  window.userMusic="http://localhost:81/mttk-php/uploads/";
  window.userPic="http://localhost:81/mttk-php/uploads/img/";

  window.userPicCmt="http://localhost:81/mttk-php/uploads/img/a6551.jpg";
  window.userLogin="duongphuocloc@gmail.com";
  window.userName="phuoc loc";
  window.notifyCount=0;
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";
  window.chosenMusic = "";
  window.title="";



$(document).ajaxStop(function() {
    $('#container').masonry({
        itemSelector: '.item'
    });
    Arrow_Points();
    $(".timeago").livequery(function() // LiveQuery 
    {
      $(this).timeago(); // Calling Timeago Funtion 
    });
});

/*$(document).ajaxStart(function () {

});*/
/*$(document).ajaxStop(function () {
    alert("AJAX STOP!!!");
    //$(this).removeClass("loading");
    //clearTimeout(timer);
});
*/
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
            var check=0;
            if (times > 0) {
              $("#notification_count").replaceWith('<span id="notification_count">' + times + '</span>');
              if(window.notifyCount==0){
                window.notifyCount=times;
              }else{
                if(times>window.notifyCount){
                  check=1;
                  window.notifyCount=times;
                }
              }
          } else {
            $("#notification_count").hide();
          }
          $('#notificationsBody>ul').empty();
          $('#notificationsBody>ul').append(data);
          if(check==1){
            showNotification({
                    message: "You have a new notification",
                    type: "success",
                    autoClose: true,
                    duration: 5
            });
          }
        }
      });
      /*setTimeout(
        waitForMsg,
        15000
      );*/
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

function checkUserWallRelation(friend) {
  var dataString = 'friend=' + friend;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/friendController/checkUserWallRelation",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('.headlineLeft').append(data);
       $(".inline").colorbox({inline:true,title:"<h1 style='margin-left: 180px; color:#fff!important;'>Chat</h1>", width:"30%",height:"80%"});
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


function fanclubCheckAdmin(fanclub) {
  var dataString = 'fanclub_id=' + fanclub;
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/fanclubController/checkFanlubAdmin",

    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) { 
      if(data>0){
        $('#fanclubContainer').find('.item').each(function(index, element) {
          if(!$(this).find('.dropdown').length&&index!=0){
            $(this).prepend('<div class="dropdown" style="display: none;"><a class="account" id=""></a><div class="submenu" style="display: none;"><ul class="root"><li class="stedit"><a href="#">Edit</a></li><li class="stdelete"><a href="#">Delete</a></li></ul></div></div>');
          }
        });
        $('#coverContainer').find('#headlineLeave').html('Remove group');
        $('.coverChange').css('display','block');
      }
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
      if (email == window.userLogin) {
        $('#playlistContainer>ul').append('<li><a class="removePlaylist" rel="'+val.Playlist_id+'"></a><a class="inline" href="#"><img style="width:70px;height:70px;vertical-align:middle;margin-right:7px;float:left" src="' +window.playlistIcon+'/playlistIcon.png'+ '"/><span class="'+val.Playlist_id+'">' + val.Playlist_name+ '</span></a><div class="playlistSongs"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></li>');
      }else{
        $('#playlistContainer>ul').append('<li><a class="inline" href="#"><img style="width:70px;height:70px;vertical-align:middle;margin-right:7px;float:left" src="' +window.playlistIcon+'/playlistIcon.png'+ '"/><span class="'+val.Playlist_id+'">' + val.Playlist_name+ '</span></a><div class="playlistSongs"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></li>');
      }
      getSongWall(val.Playlist_id,i);
     });
    }
  });
}

function friendRequest(userWall) {
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
      if(userWall!=window.userLogin){
        $('#cover').append('<div class="coverImg hexagon hexagon1"><div class="hexagon-in1"><div class="hexagon-in2" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 103px 103px!important; background-position: 50%;"+'" ></div></div></div>');
      }else{
        $('#cover').append('<div class="coverImg hexagon hexagon1"><div class="hexagon-in1"><div class="hexagon-in2" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 103px 103px!important; background-position: 50%;"+'" ></div></div></div><b><a href="'+window.changeProfilePic+'"  class="coverUpdate iframe"><div>Update Picture</div></a></b>');
        $('.coverChange').css('display','block');
      }
      $('#cover').parent().append('<div class="coverName"><b><a href="' + window.userWall + "/" + window.userLogin + '">' + window.userNameWall + '</a></b></div>');
      $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
      $('#logoutContainer').append('<a title="logout" href="'+window.logout+'" ><img src="'+window.playlistIcon+'/logout.png'+'" style="width:19px;height:19px;"/></a>');
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

$(document).on('click', '.removePlaylist', function() {
  if (confirm("Are your sure?")) {
    var playlist=$(this).attr("rel");
    var dataString = 'playlist_id=' + playlist;
    var li=$(this).parent();
    $.ajax({
      type: "post",
  
      url: "http://localhost:81/mttk-php/playlistController/removePlaylist",
  
      data: dataString,
      async: true,
      cache: false,
      success: function() {
        li.fadeOut('slow');
      }
    });
  }
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

$(document).on('click', '#wallUnfriend', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",

  url:"http://localhost:81/mttk-php/friendController/xoaBan",

  data: {friend: friendName},
  dataType: "text",
  cache:false,
  success:
      function(data){
        location.reload();
      }
  });
  return false;
});

$(document).on('click', '#wallAddFriend', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",

  url:"http://localhost:81/mttk-php/friendController/themBan",

  data: {friendEmail:friendName},
  dataType: "text",
  cache:false,
  success:
      function(data){
        location.reload();
      }
  });
  return false;
});

$(document).on('click', '#wallUnfollow', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",

  url:"http://localhost:81/mttk-php/friendController/unfollow",

  data: {friend:friendName},
  dataType: "text",
  cache:false,
  success:
      function(data){
        location.reload();
      }
  });
  return false;
});

$(document).on('click', '#wallFollow', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",

  url:"http://localhost:81/mttk-php/friendController/follow",

  data: {friend:friendName},
  dataType: "text",
  cache:false,
  success:
      function(data){
        location.reload();
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
  if ($(".search").val() != '') {
    $.ajax({
      type: "post",

      url: "http://localhost:81/mttk-php/friendController/searchMenu",

      cache: false,
      data: 'search=' + $(".search").val(),
      success: function(response) {
        $('#displayUserBox').html(response).show();
      }
    });
  }
});

$(document).on('click', '.removeMember', function() {
  var parent = $(this).parent();
  var email = parent.find('button').val();
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/fanclubController/removeMember",

    cache: false,
    data: 'email=' + email + '&fanclub_id=' + window.fanclub,
    success: function(response) {
      parent.fadeOut('slow');
    }
  });
});


$(document).on('click', '.addMember', function() {
  var li=$(this).parent();
  var member=$(this).val();
  $.ajax({
  type: "POST",

  url:"http://localhost:81/mttk-php/fanclubController/themFanclubUser",

  data:'user='+member+'&fanclub_id='+window.fanclub,
  cache:false,
  success:
      function(){
        location.reload();
      }
  });
  return false;
});

$(document).on('click', '#headlineLeave', function() {
  if (confirm("Are your sure?")) {
    $.ajax({
      type: "post",

      url: "http://localhost:81/mttk-php/fanclubController/tuRemoveKhoiFanlub",

      cache: false,
      data: 'fanclub_id=' + window.fanclub,
      success: function(response) {
        window.location.href = window.mainController + '/homePage/';
      }
    });
  }
});

$(document).on('click', '.joinFanclub a', function() {
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/fanclubController/tuThemVaoFanclub",

    data: 'fanclub_id=' + window.fanclub,
    cache: false,
    success: function() {
      location.reload();
    }
  });
});

$(document).on('keyup', '.searchMember', function() {
  if ($(".searchMember").val() != '') {
    $.ajax({
      type: "post",

      url: "http://localhost:81/mttk-php/fanclubController/searchFanclub",

      cache: false,
      data: 'search=' + $(".searchMember").val() + '&fanclub=' + window.fanclub,
      success: function(response) {
        $('#display').html(response).show();
      }
    });
  }
});


function getStatus(){
      var data;

      data=[{"status_id":"34","music":"1","title":"","message":"shit","created_at":"2014-11-06 22:36:14","thumbs_up":"1","privacy_type_id":"1","email":"duongphuocloc@gmail.com","picture":"a6551.jpg","name":"phuoc loc"}]

    addStatusUserWall(data);
  }
  </script>
  <script>
  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();
    getSuggest();
    getPlaylistUpdateStatus();
    getFanclub();

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
      $('.fanclubInfo').append('<div class="fanclubUserBox" align="left"><a href="'+window.createFanclub+'" class="iframe">Create new fanclub</a></div>');
      $(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
  });
  </script>
 
</head>
<body>
    <div id="menu" style="top: 546px; overflow-y: hidden; height: 80px; bottom: 0px;">
    <div id="m">
        <a><img src="http://localhost:81/mttk-php/assets/img/logo.png" class="logo"></a>
        <ul id="mon_menu">
          <li id="personalPage">
          </li>
          <li><a href="#" id="homePage">HOME</a></li>
          <li id="friend_li">
            <span id="friend_count"></span>
            <a href="#" id="friendLink">FRIENDS</a>
            <div id="friendContainer">
              <div id="friendTitle">Friend requests</div>
              <div id="friendBody" class="friend">
                <ul></ul>
              </div>
              <div id="friendFooter">
                <h3>Suggest Friends</h3>
                <ul id="facebook"></ul>
              </div>
            </div>
          </li>
          <li><a href="#" id="chatPage">MESSAGES</a></li>
          <li id="notification_li">
            <span id="notification_count"></span>
            <a href="#" id="notificationLink">NOTIFICATIONS</a>
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
        </ul>
        <div id="logoutContainer" class="social">
        </div>
        <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
        <div id="displayUserBox">
        </div>
      </div>
  </div>
    <div id="container">
  <div class="timeline_container">
    <div class="timeline">
      <div class="plus"></div>
    </div>
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
</body>
</html><?php }} ?>
