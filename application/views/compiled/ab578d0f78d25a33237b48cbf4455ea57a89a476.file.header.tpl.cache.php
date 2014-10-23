<?php /* Smarty version Smarty-3.1.18, created on 2014-10-23 17:30:22
         compiled from "application\views\templates\common\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1645654491f0e9e3712-41764940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab578d0f78d25a33237b48cbf4455ea57a89a476' => 
    array (
      0 => 'application\\views\\templates\\common\\header.tpl',
      1 => 1414075555,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1645654491f0e9e3712-41764940',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userLogin' => 0,
    'userPicCmt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54491f0eb06639_67341031',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54491f0eb06639_67341031')) {function content_54491f0eb06639_67341031($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jplayer.blue.monday.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/wall.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jquery.qtip.css">
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.timeago.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.livequery.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.qtip.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/imagesloaded.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/wall.js"></script>
  <script type="text/javascript">
  window.notifyStatus="<?php echo site_url('statusController/hienThiNotiStatus/');?>
";
  window.profilePic="<?php echo uploads_url();?>
img/profilePic.jpg";
  window.userPic="<?php echo uploads_url();?>
img/";
  window.userWall="<?php echo site_url('statusController/layDSWallStatus/');?>
";
  window.userLogin="<?php echo $_smarty_tpl->tpl_vars['userLogin']->value;?>
";
  window.friendController="<?php echo site_url('friendController/');?>
";
  window.userPicCmt="<?php echo uploads_url();?>
img/<?php echo $_smarty_tpl->tpl_vars['userPicCmt']->value;?>
";

  window.compare=0;
  window.compareStatus=0;


function waitForMsg() {
  $.ajax({
    type: "post",

    url: "<?php echo base_url('notiController/getOldNotify');?>
",

    async: true,
    /* If set to non-async, browser shows page as "Loading.."*/
    cache: false,
    timeout: 50000,
    /* Timeout in ms */
    success: function(data) { /* called when request to barge.php completes */
      $.ajax({
        type: "post",

        url: "<?php echo base_url('notiController/getNewNotifyNumber');?>
",

        cache: false,
        success: function(times) {
          addmsg(data, times);
        }
      });
    }
  });
}

function getPlaylist() {
  $.ajax({
    type: "post",

    url: "<?php echo base_url('playlistController/getDSPlaylist');?>
",

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

    url: "<?php echo base_url('friendController/getFriendRequest');?>
",

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

    $("#flash" + Id).fadeIn(400).html('<img src="<?php echo asset_url();?>
img/ajax-loader.gif" align="absmiddle"> loading.....');
    
    $.ajax({
      type: "post",

      url: "<?php echo base_url('commentController/themComment');?>
",

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

    url: "<?php echo base_url('commentController/xoaComment');?>
",

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

    url: "<?php echo base_url('thumb_up_downController/themXoaLike');?>
",

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



function getComment(status) {
  var dataString = 'status_id=' + status;
  $.ajax({
    type: "post",

    url: "<?php echo base_url('commentController/layComment');?>
",

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

    url: "<?php echo base_url('thumb_up_downController/layLikeUser');?>
",

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

      url: "<?php echo base_url('thumb_up_downController/layLike');?>
",

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
<?php }} ?>
