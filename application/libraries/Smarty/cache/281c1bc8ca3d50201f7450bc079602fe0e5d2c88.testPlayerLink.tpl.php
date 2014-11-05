<?php /*%%SmartyHeaderCode:32657545a24b8b543f6-65521390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '281c1bc8ca3d50201f7450bc079602fe0e5d2c88' => 
    array (
      0 => 'application\\views\\templates\\testPlayerLink.tpl',
      1 => 1415193760,
      2 => 'file',
    ),
    'ab578d0f78d25a33237b48cbf4455ea57a89a476' => 
    array (
      0 => 'application\\views\\templates\\common\\header.tpl',
      1 => 1415180698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32657545a24b8b543f6-65521390',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_545a24b9601c01_17441162',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545a24b9601c01_17441162')) {function content_545a24b9601c01_17441162($_smarty_tpl) {?><!doctype html>
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
  //window.notifyStatus="http://localhost:81/mttk-php/statusController/hienThiNotiStatus";
  window.cretePlaylist="http://localhost:81/mttk-php/playlistController/viewPlaylist";
  window.profilePic="http://localhost:81/mttk-php/uploads/img/profilePic.jpg";
  window.userPic="http://localhost:81/mttk-php/uploads/img/";
  window.userWall="http://localhost:81/mttk-php/statusController/layDSWallStatus";
  window.userLogin="anhtiminh@yahoo.com";
  //window.friendController="http://localhost:81/mttk-php/friendController";
  window.userPicCmt="http://localhost:81/mttk-php/uploads/img/shot0006.jpg";
  window.userMusic="http://localhost:81/mttk-php/uploads";
  window.compare=0;
  window.compareStatus=0;
  window.currentChatPosition=-1;
  window.userChat="";



$( document ).ajaxStop(function() {
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

function getFriendList() {
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/friendController/getAllFriends",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    success: function(data) {
     $('#friendListContainer>ul').append(data);
     $(".inline").colorbox({inline:true, width:"30%",height:"80%"});
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
        getConversation, /* Request next message */
        2000 /* ..after 2 seconds */
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

$(document).on('click', 'li button', function() {
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


function getStatus() {
  $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/statusController/index",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(data) {
      addStatus(data);
      setTimeout(
        getStatus,
        10000
      );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      addStatus("error", textStatus + " (" + errorThrown + ")");
      setTimeout(
        getStatus,
        15000);
    }
  });
}
  </script>
  <script>

  $(document).ready(function() {
    waitForMsg();
    friendRequest();
    getStatus();
    getPlaylist();
    getSuggest();
    $("#notificationLink").click(function()
    {
      $("#friendContainer").hide();
      $("#notificationContainer").fadeToggle(300);
      $("#notification_count").fadeOut("slow");
      return false;
    });

    $("#friendLink").click(function()
    {
      $("#notificationContainer").hide();
      $("#friendContainer").fadeToggle(300);
      $("#friend_count").fadeOut("slow");
      return false;
    });

    $(document).click(function()
    {
      $("#notificationContainer").hide();
      $("#friendContainer").hide();
    });
   
    $('#savePlaylist').click(function(){
      var id=$(this).parent().find('select').find(":selected").val();
      var title=$(this).parent().find('#titleMusic').val();
      var music=$(this).parent().find('#urlMusic').val();
      savePlaylist(id,title,music);
    });
    $('#notificationsBody ul').bind('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
          var id=$(this).find('li:last').attr("id");
          moreNotify(id.substring(4));
        }
    });
    $(window).scroll(function(){
      if ($(window).scrollTop() == $(document).height() - $(window).height()){
        var element=$('#container').find('.item:last');
        var id=element.attr('id').substring(6);
        var jplayer_id=element.find('.jp-jplayer').attr('id').substring(15);
        moreStatus(id,jplayer_id);
      }
    });
  });
  </script>
 
</head>
<body>
  <div id="noti_Container">
    <ul id="nav">
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
  </ul>
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
