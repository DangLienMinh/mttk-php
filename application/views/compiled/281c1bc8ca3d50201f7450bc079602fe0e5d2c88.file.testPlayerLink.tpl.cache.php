<?php /* Smarty version Smarty-3.1.18, created on 2014-10-18 16:32:24
         compiled from "application\views\templates\testPlayerLink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6111544279f8e228e8-51828331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '281c1bc8ca3d50201f7450bc079602fe0e5d2c88' => 
    array (
      0 => 'application\\views\\templates\\testPlayerLink.tpl',
      1 => 1413642742,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6111544279f8e228e8-51828331',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544279f916de62_72350240',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544279f916de62_72350240')) {function content_544279f916de62_72350240($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jplayer.blue.monday.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/wall.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/masonry.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>
  
  <script type="text/javascript">

   window.profilePic="<?php echo uploads_url();?>
img/profilePic.jpg";

    var element='<div class="jp-gui jp-interface"> \
          <ul class="jp-controls"> \
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li> \
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li> \
            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li> \
            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> \
            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li> \
            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li> \
          </ul> \
          <div class="jp-progress"> \
            <div class="jp-seek-bar"> \
              <div class="jp-play-bar"></div> \
            </div> \
          </div> \
          <div class="jp-volume-bar"> \
            <div class="jp-volume-bar-value"></div> \
          </div> \
          <div class="jp-time-holder"> \
            <div class="jp-current-time"></div> \
            <div class="jp-duration"></div> \
              <ul class="jp-toggles"> \
              <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li> \
              <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li> \
            </ul> \
          </div> \
        </div> \
        <div class="jp-details"> \
          <ul> \
            <li><span class="jp-title"></span></li> \
          </ul> \
        </div> \
        <div class="jp-no-solution"> \
          <span>Update Required</span> \
          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>. \
        </div>';
    function addStatus(msg){
        var obj = JSON.parse(msg);
          try{
            var items=[];
            $.each(obj, function(i,val){
               i=i+1;
               if(!val.picture){
                val.picture=window.profilePic;
               }
               $('#container').append('<div class="item"><a href="#" class="deletebox">X</a><div class="stimg"><img src="'+val.picture+'"style="width:50px;height:50px"/></div><div class="sttext"><b>'+val.name+'</b><div class="sttime">'+val.created_at+'</div><div class="strmsg">'+val.message+'</div><div id="jquery_jplayer_'+i+'" class="jp-jplayer"></div><div id="jp_container_'+i+'" class="jp-audio"><div class="jp-type-single" id="jp_interface_'+i+'">'+element+'</div></div></div><div class="staction"><a href="#" class="like like_button" id="like'+val.status_id+'"></a><a href="#" class="comment_button" id="'+val.status_id+'">Comment</a><a href="#" class="share_button" id=share"'+val.status_id+'">Share</a></div><div  id="loadplace'+val.status_id+'"></div><div id="flash'+val.status_id+'" class="flash_load"></div><div class="panel" id="slidepanel'+val.status_id+'"><div class="cmtpic"><img src="'+val.picture+'" style="width:25px;height:25px;" /></div><textarea style="width:305px;height:23px" id="textboxcontent'+val.status_id+'"></textarea><br/><button value="Comment" class="comment_submit" id="'+val.status_id+'">Comment</button></div></div>'); 
                getComment(val.status_id);
                getLike(val.status_id);
                setSong('#jquery_jplayer_'+i,'#jp_interface_'+i,val.music,val.title);
            });
            
            //$('#tabs').append.apply($('#tabs'), items);
            
          }catch(e) {
            alert(e);
          }
    }
    
    $(document).on('click', '.comment_button', function() { 
              
              var element = $(this);
              var I = element.attr("id");
              $("#slidepanel"+I).slideToggle(300,function(){
                $('#container').masonry({itemSelector : '.item',});
              });
              return false;
      });
            $(document).on('click', '.comment_submit', function() { 
              var element = $(this);
              var Id = element.attr("id");
              var test = $("#textboxcontent"+Id).val();
              var dataString = 'textcontent='+ test + '&com_msgid=' + Id;
      
              if(test=='')
              {
                alert("Please Enter Some Text");
              }
              else
              {
              $("#flash"+Id).show();

              $("#flash"+Id).fadeIn(400).html('<img src="<?php echo asset_url();?>
img/ajax-loader.gif" align="absmiddle"> loading.....');
      
              $.ajax({
                type: "post",

                url:"<?php echo base_url('commentController/themComment');?>
",

                data: dataString,
                cache: false,
                success: function(html){
                    $("#loadplace"+Id).append(html);
                    $("#flash"+Id).hide();
                }
                });
              }
              return false;
             });

    $(document).on('click', '.delete_button', function() {
        var id = $(this).attr("id");
        var dataString = 'id='+ id ;
        var parent = $(this).parent();
        $.ajax({
           type: "POST",

                url:"<?php echo base_url('commentController/xoaComment');?>
",

           data: dataString,
           cache: false,

           success: function(){
            if(id % 2)
           {
            parent.fadeOut('slow', function() {$(this).remove();});
           }
          else
           {
          parent.slideUp('slow', function() {$(this).remove();});
           }
          }
         });

        return false;
    });

    $(document).on('click', '.like', function() {
        var ID = $(this).attr("id");
        var sid=ID.split("like"); 
        var New_ID=sid[1];
        var REL = $(this).attr("rel");
        var dataString = 'status_id=' + New_ID +'&rel='+ REL;
        $.ajax({
           type: "POST",

                url:"<?php echo base_url('thumb_up_downController/themXoaLike');?>
",

           data: dataString,
           cache: false,

           success: function(data){
            if(REL=='Like')
            {
            $("#youlike"+New_ID).slideDown('slow').prepend("<span id='you"+New_ID+"'><a href='#'>You</a> like this.</span>.");
            $("#likes"+New_ID).prepend("<span id='you"+New_ID+"'><a href='#'>You</a>, </span>");
            $('#'+ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
            }
            else
            {
            $("#youlike"+New_ID).slideUp('slow');
            $("#you"+New_ID).remove();
            $('#'+ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
            }
          }
         });

        return false;
    });

    function getStatus(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "post",

      url:"<?php echo base_url('statusController/index');?>
",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addStatus(data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    getStatus, /* Request next message */
                    1800000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addStatus("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    getStatus, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    }

    function setSong(name,inter,songUrl,title){
        $(name).jPlayer({
        ready: function (event) {
          $(this).jPlayer("setMedia", {
            title: title,
            mp3: songUrl
          });
        },
        swfPath: "js",
        cssSelectorAncestor: inter,
        supplied: "mp3",
        wmode: "window",
        smoothPlayBar: true,
        keyEnabled: true,
        remainingDuration: true,
        toggleDuration: true
      });
    }

    function getComment(status){
        var dataString = 'status_id='+ status;
        $.ajax({
            type: "post",

      url:"<?php echo base_url('commentController/layComment');?>
",

            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ /* called when request to barge.php completes */
              var obj = JSON.parse(data);
              if(obj.length>0){
                $.each(obj, function(i,val){
                $("#loadplace"+val.status_id).append('<div class="load_comment"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'+val.picture+'"/><span>'+val.message+'</span><a href="#" id="'+val.comment_id+'" class="delete_button">X</a><div class="sttime">'+val.created_at+'</div></div>');
              });
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
 
            }
        });
    }

    function getLike(status){
      var dataString = 'status_id='+ status;
      var isLike=0;
        $.ajax({
            type: "post",

      url:"<?php echo base_url('thumb_up_downController/layLikeUser');?>
",

            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ /* called when request to barge.php completes */
              var obj = JSON.parse(data);
              if(obj.length>0){
                isLike=1;
                $("#like"+status).replaceWith('<a href="#" class="like like_button" id="like'+status+'" title="UnLike" rel="UnLike">UnLike</a>');
                $("#loadplace"+status).prev('div').append('<div class="likeUsers" id="youlike'+status+'"></div>');
              }else{
                $("#like"+status).replaceWith('<a href="#" class="like like_button" id="like'+status+'" title="Like" rel="Like">Like</a>');
                $("#loadplace"+status).prev('div').append('<div class="likeUsers" id="youlike'+status+'"></div>');
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            }
        }).done(function(){
       //wait for done and the run the second
       $.ajax({
            type: "post",

      url:"<?php echo base_url('thumb_up_downController/layLike');?>
",

            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ 
              var obj = JSON.parse(data);
              var new_like_count=obj.length-3;
              if(obj.length>0){
                $.each(obj, function(i,val){
                  if(isLike==1){
                    $("#youlike"+status).append('<span id="you'+status+'"><a href="'+val.email+'">You</a></span>');
                  }else{
                     $("#youlike"+status).append('<a href="'+val.email+'">'+val.name+'</a>');
                  }
                  if(new_like_count>0){
                    $("#youlike"+status).append(' and '+new_like_count+' other friends like this');
                  }else{
                    $("#youlike"+status).append(' like this');
                  }
                });
              }else{
                //$("#loadplace"+status).prev('li').append('<div class="likeUsers" id="likes'+status+'"></div>');
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){

            }
        }).done(function(){
            $('#container').masonry({itemSelector : '.item',});
            Arrow_Points();
        });
      });
    }

    $('.timeline_container').mousemove(function(e)
    {
      var topdiv=$("#containertop").height();
      var pag= e.pageY - topdiv-26;
      $('.plus').css({"top":pag +"px", "background":"url('images/plus.png')","margin-left":"1px"});
    }).mouseout(function(){
      $('.plus').css({"background":"url('')"});
    });

     function Arrow_Points() {
        var s = $('#container').find('.item');
        $.each(s, function (i, obj) {
            var posLeft = $(obj).css("left");
            $(obj).addClass('borderclass');
            if (posLeft == "0px") {
                html = "<span class='rightCorner'></span>";
                $(obj).prepend(html);
            } else {
                html = "<span class='leftCorner'></span>";
                $(obj).prepend(html);
            }
        });
      }

      $(document).on('click', '.deletebox', function() {
        if(confirm("Are your sure?")){
          $(this).parent().fadeOut('slow'); 
          //Remove item block
          $('#container').masonry( 'remove', $(this).parent() );
          //Reload masonry plugin
          $('#container').masonry({itemSelector : '.item',});
          //$('#container').masonry( 'reload' );
          //Hiding existing Arrows
          //$('.rightCorner').hide();
          //$('.leftCorner').hide();
          //Injecting fresh arrows
          Arrow_Points();
        }
        return false;
      });
  </script>

  <script>
  $(document).ready(function() {
      getStatus();
  });
 
  </script>
 
</head>
<body>
    <div id="container">
      <div class="timeline_container">
        <div class="timeline">
          <div class="plus"></div>
        </div>
      </div>
    </div>
</body>
</html><?php }} ?>
