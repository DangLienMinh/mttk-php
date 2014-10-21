<?php /*%%SmartyHeaderCode:1143454467ae7f3ee51-83582245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7aef88f2254b428ca8164bfc0bf4456c5220e591' => 
    array (
      0 => 'application\\views\\templates\\notiStatus.tpl',
      1 => 1413857955,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1143454467ae7f3ee51-83582245',
  'variables' => 
  array (
    'userPicCmt' => 0,
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54467ae82709f0_27650385',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54467ae82709f0_27650385')) {function content_54467ae82709f0_27650385($_smarty_tpl) {?><!doctype html>
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
  <script type="text/javascript">
   window.notifyStatus="http://localhost:81/mttk-php/statusController/hienThiNotiStatus";
   window.profilePic="http://localhost:81/mttk-php/uploads/img/profilePic.jpg";
   window.userPic="http://localhost:81/mttk-php/uploads/img/";
   window.userWall="http://localhost:81/mttk-php/statusController/layDSWallStatus";
   window.userPicCmt="http://localhost:81/mttk-php/uploads/img/a6551.jpg";
   window.compare=0;

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
    function addStatus(obj){
          try{
            var items=[];
            $.each(obj, function(i,val){
               i=i+1;
               if(!val.picture){
                val.picture=window.profilePic;
               }
              $('#container').append('<div class="item"><a href="#" class="stdelete"></a><div class="stimg"><img src="'+window.userPic+val.picture+'" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="'+window.userWall+"/"+val.email+'">'+val.name+'</a></b><div class="sttime"><abbr class="timeago" title="'+val.created_at+'"></abbr></div><div class="strmsg">'+val.message+'</div><div id="jquery_jplayer_'+i+'" class="jp-jplayer"></div><div id="jp_container_'+i+'" class="jp-audio"><div class="jp-type-single" id="jp_interface_'+i+'">'+element+'</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like'+val.status_id+'"></a><a href="#" class="comment_button icontext comment" id="'+val.status_id+'">Comment</a><a href="#" class="share_button" id=share"'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace'+val.status_id+'"></ul><div id="flash'+val.status_id+'" class="flash_load"></div><div class="panel" id="slidepanel'+val.status_id+'"><div class="cmtpic"><img src="'+window.userPicCmt+'" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:23px" placeholder=" Write your comment..." id="textboxcontent'+val.status_id+'"></textarea><br/><button value="Comment" class="comment_submit" id="'+val.status_id+'">Comment</button></div></div></div>'); 
              getComment(val.status_id);
              getLike(val.status_id);
              setSong('#jquery_jplayer_'+i,'#jp_interface_'+i,val.music,val.title);
            });
          }catch(e) {
            alert(e);
          }
    }

    
     function waitForMsg(){
        $.ajax({
            type: "post",

      url:"http://localhost:81/mttk-php/notiController/getNewNotify", 

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addmsg(data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    1000000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    }

    function addmsg(msg){
        var obj = JSON.parse(msg);
        $(".noti_bubble").replaceWith('<div class="noti_bubble">'+obj.length+'</div>');
        if(obj.length>window.compare){
          window.compare=obj.length;
          try{
            var items=[];
            $.each(obj, function(i,val){
              var noti_icon="";
              if(val.type=="1"){
                notiIcon="noti_like";
              }else{
                notiIcon="noti_comment";
              }
                $('#noti_content>ul').append('<li class="noti"><a href="'+window.notifyStatus+"/"+val.status_id+'"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'+window.userPic+val.picture+'"/><span>'+val.msg+'</span><br/><abbr class="timeago '+notiIcon+'" title="'+val.created_at+'"></abbr></a></li>');
            });
          }catch(e) {
            alert('Exception while request..');
          }
        }else{
        }
    }

    $(document).on('click', '.comment_button', function() { 
              var element = $(this);
              var I = element.attr("id");
              $("#textboxcontent"+I).focus();
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

              $("#flash"+Id).fadeIn(400).html('<img src="http://localhost:81/mttk-php/assets/img/ajax-loader.gif" align="absmiddle"> loading.....');
      
              $.ajax({
                type: "post",

                url:"http://localhost:81/mttk-php/commentController/themComment",

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

                url:"http://localhost:81/mttk-php/commentController/xoaComment",

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

                url:"http://localhost:81/mttk-php/thumb_up_downController/themXoaLike",

           data: dataString,
           cache: false,

           success: function(data){
            if(REL=='Like')
            {
            $("#youlike"+New_ID).slideDown('fast').prepend("<span id='you"+New_ID+"'><a href='#'>You</a></span>.");
            $("#likes"+New_ID).prepend("<span id='you"+New_ID+"'><a href='#'>You</a></span>");
            $('#'+ID).html('Unlike').attr('rel', 'Unlike').attr('title', 'Unlike');
            }
            else
            {
            $("#youlike"+New_ID).slideUp('fast');
            $("#you"+New_ID).remove();
            $('#'+ID).attr('rel', 'Like').attr('title', 'Like').html('Like');
            }
          }
         });

        return false;
    });

    function getStatus(){
          var data;
    
          data=[{"status_id":"6","music":"http:\/\/j.ginggong.com\/jDownload.ashx?id=ZWZABB9W&h=mp3.zing.vn","title":"Jar Of Hearts + Christina Perri","message":"how a nice day","created_at":"2014-10-18 21:19:25","thumbs_up":"0","privacy_type_id":"1","email":"duongphuocloc@gmail.com","picture":"a6551.jpg","name":"phuoc loc"}]
    
        addStatus(data);
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

      url:"http://localhost:81/mttk-php/commentController/layComment",

            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ /* called when request to barge.php completes */
              var obj = JSON.parse(data);
              if(obj.length>0){
                $.each(obj, function(i,val){
                $("#loadplace"+val.status_id).append('<li class="load_comment"><span id="'+val.name+'"></span><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'+window.userPic+val.picture+'"/><span>'+val.message+'</span><a href="#" id="'+val.comment_id+'" class="delete_button"></a><br/><abbr class="timeago" title="'+val.created_at+'"></abbr></li>');
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

      url:"http://localhost:81/mttk-php/thumb_up_downController/layLikeUser",

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

      url:"http://localhost:81/mttk-php/thumb_up_downController/layLike",

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
            $(".timeago").livequery(function() // LiveQuery 
            {
              $(this).timeago(); // Calling Timeago Funtion 
            });
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

      function Arrow_Points1() {
        var s = $('#container').find('.item');
        $.each(s, function (i, obj) {
            var posLeft = $(obj).css("left");
            $(obj).addClass('borderclass');
            if (posLeft == "0px") {
               html = "<span class='leftCorner'></span>";
                $(obj).prepend(html);
            } else {
                 html = "<span class='rightCorner'></span>";
                $(obj).prepend(html);
            }
        });
      }

      $(document).on('click', '.stdelete', function() {
        if(confirm("Are your sure?")){
          $(this).parent().fadeOut('slow'); 
          $('#container').masonry( 'remove', $(this).parent() );
          $('#container').masonry({itemSelector : '.item',});
          $('.rightCorner').hide();
          $('.leftCorner').hide();
          Arrow_Points1();
        }
        return false;
      });

      function setPop(name,img){
        $("#pop img").replaceWith('<img src="'+img+'"style="width:106px;height:106px"/>');
        $("#pop h2").replaceWith('<h2>'+name+'</h2>');
      }
      $(document).on('mouseover', '.item', function() {
          var item1 = $(".stdelete");
          var element=$(this).find(item1);
          element.show();
      });
      $(document).on('mouseout', '.item', function() {
          var item1 = $(".stdelete");
          var element=$(this).find(item1);
          element.hide();
      });

      $(document).on('mouseover', '.load_comment', function() {
          var element=$(this).find('a');
          element.show();
      });
      $(document).on('mouseout', '.load_comment', function() {
          var element=$(this).find('a');
          element.hide();
      });

      $(document).on('mouseover', '.stimg,.load_comment>img', function() {
        if($(this).hasClass("stimg")){
          var element = $(this).find( "img" );
          var img = element.attr("src");
          element=$(this).next("div").find("b");
          var name = element.text();
          
        }else{
          var element = $(this);
          var img = element.attr("src");
          element=$(this).parent().find( "span" );
          var name = element.attr('id');
        }
        setPop(name,img);
        $("#pop").show();
         
      });

      $(document).on('mouseout', '.stimg,.load_comment>img', function() {
          $("#pop").hide();
      });
      $(document).on('mousemove', '.stimg,.load_comment>img', function(e) {
        var moveLeft = 0;
        var moveDown = 0;
          var target = '#pop';
          leftD = e.pageX + parseInt(moveLeft);
          maxRight = leftD + $(target).outerWidth();
          windowLeft = $(window).width() - 40;
          windowRight = 0;
          maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
          if(maxRight > windowLeft && maxLeft > windowRight)
          {
              leftD = maxLeft;
          }
          topD = e.pageY - parseInt(moveDown);
          maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
          windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
          maxTop = topD;
          windowTop = parseInt($(document).scrollTop());
          if(maxBottom > windowBottom)
          {
              topD = windowBottom - $(target).outerHeight() - 20;
          } else if(maxTop < windowTop){
              topD = windowTop + 20;
          }
          $(target).css('top', topD).css('left', leftD);
      });
  </script>

  <script>
  $(document).ready(function() {
      waitForMsg();
      getStatus();
      $('#noti_Container').click(function(){
        if($('#noti_content').css('display') == 'none')
        {
          $('#noti_content').css('display','block');
        }else{
          $('#noti_content').css('display','none');
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
