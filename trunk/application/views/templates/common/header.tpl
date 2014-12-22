<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MyMusic</title>
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/wall.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jquery.qtip.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/colorbox.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jquery_notification.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/a.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jplayer.blue.monday.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery-ui.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.hideseek.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.timeago.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.livequery.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.qtip.js"></script>
  <script type="text/javascript" src="{asset_url()}js/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery_notification_v.1.js"></script>
  <script type="text/javascript" src="{asset_url()}js/cropbox.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jplayer.playlist.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/wall.js"></script>

  <script type="text/javascript">
    window.emotionsFolder="{asset_url()}img/emotions-fb/";
  </script>
  <script type="text/javascript" src="{asset_url()}js/jquery.emotions.js"></script>
  <script type="text/javascript">

  window.shareStatus="{site_url('statusController/hienThiShareStatus/')}";
  window.cretePlaylist="{site_url('playlistController/viewPlaylist/')}";
  window.reportAdmin="{site_url('reportadminController/viewReport/')}";
  window.suaPassword="{site_url('userController/viewSuaPassword/')}";
  window.changeProfilePic="{site_url('profileController/changeProfileImage/')}";
  window.createFanclub="{site_url('fanclubController/createFanclub/')}";
  window.userWall="{site_url('statusController/layDSWallStatus/')}";
  window.mainController="{site_url('/')}";
  window.logout="{site_url('userController/logout/')}";

  window.playlistIcon="{asset_url()}img/";

  window.userMusic="{uploads_url()}";
  window.userPic="{uploads_url()}img/";

  window.userPicCmt="{uploads_url()}img/{$userPicCmt}";
  window.userLogin="{$userLogin}";
  window.userName="{$userName}";
  window.notifyCount=0;
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";
  window.chosenMusic = "";
  window.title="";

{literal}

//do some job when ajax request stop
$(document).ajaxStop(function() {
    $('#container').masonry({
        itemSelector: '.item'
    });
    Arrow_Points();
    $(".timeago").livequery(function() // LiveQuery 
    {
      $(this).timeago(); // Calling Timeago Funtion 
    });
    $(".iframe").colorbox({iframe:true, width:"50%", height:"60%"});
});

/*$(document).ajaxStart(function () {

});*/
/*$(document).ajaxStop(function () {
    alert("AJAX STOP!!!");
    //$(this).removeClass("loading");
    //clearTimeout(timer);
});
*/

//get more status
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

//get more wall status
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
      addMoreWallStatus(data,jplayer_id);
    }
  });
}

//get notifications
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
      setTimeout(
        waitForMsg,
        15000
      );
    }
  });
}

//alter status message
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

//check user relationship when they visit other user wall
function checkUserWallRelation(friend) {
  var dataString = 'friend=' + friend;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/checkUserWallRelation')}",
{literal}
    data: dataString,
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $('.headlineFriendRelation').append(data);
       $(".inline").colorbox({inline:true,title:"<h1 style='margin-left: 180px; color:#fff!important;'>Chat</h1>", width:"30%",height:"80%"});
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

//get more notify
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

//get all friend in message site
function getFriendChat() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('friendController/getAllChatFriends')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#chatContainer>ul').append(data);
     $(".inline").colorbox({inline:true,title:"<h1 style='margin-left: 180px; color:#fff!important;'>Chat</h1>", width:"30%",height:"80%"});
    }
  });
}

//get all friend in user wall
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
     $('#friendList>ul').append(data);
    }
  });
}

//get all members in fanclub
function getMembers(fanclub) {
  var dataString = 'fanclub_id=' + fanclub;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('fanclubController/getAllMembers')}",
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

//get conversation by the email
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

//get more conversation by the email
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

//delete status
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

//get all the playlists
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
      //$(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
    }
  });
}

//check admin of fanclub
function fanclubCheckAdmin(fanclub) {
  var dataString = 'fanclub_id=' + fanclub;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('fanclubController/checkFanlubAdmin')}",
{literal}
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
      if(userWall!=window.userLogin){
        $('#cover').append('<div class="coverImg circle" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 100% 100%!important; background-position: 50%;"+'" ></div>');
        //$('#cover').append('<div class="coverImg hexagon hexagon1"><div class="hexagon-in1"><div class="hexagon-in2" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 103px 103px!important; background-position: 50%;"+'" ></div></div></div>');
      }else{
        $('#cover').append('<div class="coverImg circle" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 100% 100%!important; background-position: 50%;"+'" ></div><a href="'+window.changeProfilePic+'"  class="coverUpdate iframe"><div>Update Picture</div></a></b>');
        //$('#cover').append('<div class="coverImg hexagon hexagon1"><div class="hexagon-in1"><div class="hexagon-in2" style="background: url('+"'"+window.userPicCmtWall+"') no-repeat; background-size: 103px 103px!important; background-position: 50%;"+'" ></div></div></div><b><a href="'+window.changeProfilePic+'"  class="coverUpdate iframe"><div>Update Picture</div></a></b>');
        $('.coverChange').css('display','block');
      }
      $('#cover').parent().append('<div class="coverName"><b><a href="' + window.userWall + "/" + window.userLogin + '">' + window.userNameWall + '</a></b></div>');
      
      $('.settingLogout').append('<a title="logout" href="'+window.logout+'" >Log out</a>');
      $(".settingPassword").append('<a class="iframe" href="'+window.suaPassword+'" >Change Password</a>');
      //$(".iframe").colorbox({iframe:true, width:"50%", height:"70%"});
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
      var checkComment=data.substr(0, data.indexOf('<'));
      if($.isNumeric(checkComment)){
        $("#loadplace"+status).append(data.substring(data.indexOf('<')));
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
        $('<div class="likeUsers" id="youlike' + status + '"></div>').insertBefore($("#loadplace" + status));
      } else {
        $("#like" + status).replaceWith('<a href="#" class="like like_button" id="like' + status + '" title="Like" rel="Like">Like</a>');
        $('<div class="likeUsers" id="youlike' + status + '"></div>').insertBefore($("#loadplace" + status));
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
        var l=obj.length;
        var new_like_count = l - 3;
        if (l > 0) {
          for (var i = 0; i < l; i++) {
            if (isLike == 1) {
              if (l > 1) {
                $("#youlike" + status).append('<span id="you' + status + '"><a href="' + obj[i].email + '">You,&nbsp;</a></span>');
              } else {
                $("#youlike" + status).append('<span id="you' + status + '"><a href="' + obj[i].email + '">You</a></span>');
              }
              isLike = 0;
            } else {
              if (i == l - 1) {
                $("#youlike" + status).append('<a href="' + window.userWall + "/" + obj[i].email + '">' + obj[i].name + '</a>');
              } else {
                $("#youlike" + status).append('<a href="' + window.userWall + "/" + obj[i].email + '">' + obj[i].name + ', ' + '</a>');
              }
            }
            if (new_like_count > 0) {
              $("#youlike" + status).append(' and ' + new_like_count + ' other friends like this');
            }
          }
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

//add new playlist status music
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

//get wall about
function getWallAbout(email) {
  var dataString="email="+email;
  $.ajax({
    type: "post",
    data:dataString,
{/literal}
    url: "{base_url('profileController/getWallAbout')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      $(".col1").html(data);
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
{/literal}
    url: "{base_url('playlistController/getDSSongs')}",
{literal}
    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      var obj = JSON.parse(data);
      var l=obj.length;
      for (var i=0;i<l; i++) {
          myPlaylist.add({
          title: obj[i].title,
          mp3: obj[i].mp3
        });
      }
    }
  });
}

function unfollowUser(friendName){
  $.ajax({
  type: "POST",
{/literal}
  url:"{base_url('friendController/unfollow')}",
{literal}
  data: {friend:friendName},
  dataType: "text",
  cache:false,
  success:
      function(data){
        location.reload();
      }
  });
  return false;
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

$(document).on('click', '.removePlaylist', function() {
  if (confirm("Are your sure?")) {
    var playlist=$(this).attr("rel");
    var dataString = 'playlist_id=' + playlist;
    var li=$(this).parent();
    $.ajax({
      type: "post",
  {/literal}
      url: "{base_url('playlistController/removePlaylist')}",
  {literal}
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

$(document).on('click', '#wallUnfriend', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",
{/literal}
  url:"{base_url('friendController/xoaBan')}",
{literal}
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
{/literal}
  url:"{base_url('friendController/themBan')}",
{literal}
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

$(document).on('click', '#wallFollow', function() {
  var friendName = $(this).attr('rel');
  $.ajax({
  type: "POST",
{/literal}
  url:"{base_url('friendController/follow')}",
{literal}
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
      $.ajax({
        type: "post",
{/literal}
        url: "{base_url('commentController/themComment')}",
{literal}
        data: dataString,
        cache: false,
        success: function(html) {
          $("#loadplace" + Id).append(html);
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
  if (REL == 'Like') {
        if ($('#youlike' + New_ID).children().length > 0) {
          $("#youlike" + New_ID).slideDown('fast').prepend("<span id='you" + New_ID + "'><a href='#'>You</a>,&nbsp;</span>");
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
  var dataString = 'status_id=' + New_ID + '&rel=' + REL;
  $.ajax({
    type: "POST",
{/literal}
    url: "{base_url('thumb_up_downController/themXoaLike')}",
{literal}
    data: dataString,
    cache: false,
    success: function(data) {
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

//add new music status
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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;
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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;;
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
  var dataString = 'data=' + boxval+'&name='+name+'&email='+window.userLoginWall;;
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


function getEducation(email) {
  var dataString = 'email=' + email;
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('profileController/getEducationAndReligion')}",
{literal}
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
{/literal}
    url: "{base_url('profileController/getBasicInfo')}",
{literal}
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
{/literal}
    url: "{base_url('profileController/getUserDetail')}",
{literal}
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
{/literal}
    url: "{base_url('profileController/getFavorite')}",
{literal}
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
{/literal}
    url: "{base_url('fanclubController/getFanclub')}",
{literal}
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
{/literal}
      url: "{base_url('friendController/searchMenu')}",
{literal}
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
{/literal}
    url: "{base_url('fanclubController/removeMember')}",
{literal}
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
{/literal}
  url:"{base_url('fanclubController/themFanclubUser')}",
{literal}
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
{/literal}
      url: "{base_url('fanclubController/tuRemoveKhoiFanlub')}",
{literal}
      cache: false,
      data: 'fanclub_id=' + window.fanclub,
      success: function(response) {
        window.location.href = window.mainController;
      }
    });
  }
});

$(document).on('click', '.joinFanclub a', function() {
  $.ajax({
    type: "post",
{/literal}
    url: "{base_url('fanclubController/tuThemVaoFanclub')}",
{literal}
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
{/literal}
      url: "{base_url('fanclubController/searchFanclub')}",
{literal}
      cache: false,
      data: 'search=' + $(".searchMember").val() + '&fanclub=' + window.fanclub,
      success: function(response) {
        $('#display').html(response).show();
      }
    });
  }
});
{/literal}