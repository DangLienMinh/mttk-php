<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="{asset_url()}css/jplayer.blue.monday.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
  {literal}
  <script type="text/javascript">
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
                 $('#update').append('<li><b>'+val.email+'</b><p>'+val.message+'</p><div id="jquery_jplayer_'+i+'" class="jp-jplayer"></div><div id="jp_container_'+i+'" class="jp-audio"><div class="jp-type-single" id="jp_interface_'+i+'">'+element+'</div></div><a href="#" class="comment_button" id="'+val.status_id+'">Comment</a></li><div  id="loadplace'+val.status_id+'"></div><div id="flash'+val.status_id+'" class="flash_load"></div><div class="panel" id="slidepanel'+val.status_id+'"><textarea style="width:390px;height:23px" id="textboxcontent'+val.status_id+'"></textarea><br/><button value="Comment" class="comment_submit" id="'+val.status_id+'">Comment</button></div>');
                 getComment(val.status_id);
                 getLike(val.status_id);
                 setSong('#jquery_jplayer_'+i,'#jp_interface_'+i,val.music);
            });
            $(document).on('click', '.comment_button', function() { 
              var element = $(this);
              var I = element.attr("id");
              $("#slidepanel"+I).slideToggle(300);
              $(this).toggleClass("active"); 
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
{/literal}
              $("#flash"+Id).fadeIn(400).html('<img src="{asset_url()}img/ajax-loader.gif" align="absmiddle"> loading.....');
{literal}      
              $.ajax({
                type: "post",
{/literal}
                url:"{base_url('commentController/themComment')}",
{literal}
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
            //$('#tabs').append.apply($('#tabs'), items);
            
          }catch(e) {
            alert(e);
          }
    }
    
    $(document).on('click', '.delete_button', function() { 
        var id = $(this).attr("id");
        var dataString = 'id='+ id ;
        var parent = $(this).parent();
        $.ajax({
           type: "POST",
{/literal}
                url:"{base_url('commentController/xoaComment')}",
{literal}
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

    function getStatus(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "post",
{/literal}
      url:"{base_url('statusController/index')}",
{literal}
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
    };
    function setSong(name,inter,songUrl){
        $(name).jPlayer({
        ready: function (event) {
          $(this).jPlayer("setMedia", {
            title: "",
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
    };

    function getComment(status){
        var dataString = 'status_id='+ status;
        $.ajax({
            type: "post",
{/literal}
      url:"{base_url('commentController/layComment')}",
{literal}
            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ /* called when request to barge.php completes */
              var obj = JSON.parse(data);
              if(obj.length>0){
                $.each(obj, function(i,val){
                $("#loadplace"+val.status_id).append("<div class='load_comment'>"+val.message+'<a href="#" id="'+val.comment_id+'" class="delete_button">X</a></div>');
              });
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
 
            }
        });
    };

    function getLike(status){
        var dataString = 'status_id='+ status;
        $.ajax({
            type: "post",
{/literal}
      url:"{base_url('thumb_up_downController/layLikeUser')}",
{literal}
            data: dataString,
            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,

            success: function(data){ /* called when request to barge.php completes */
              var obj = JSON.parse(data);
              if(obj.length>0){
                $.each(obj, function(i,val){
              });
              }else{
                   $("#loadplace"+status).append('<a href="#" class="like" id="like'+status+'" title="Like" rel="Like">Like</a>');
               
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
 
            }
        });
    };

  </script>
  <script>
  $(document).ready(function() {
      getStatus(); 
  });
 
  </script>
<style type="text/css">
  body{
    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
  }
  .delete_button
  {
  margin-left:10px;
  font-weight:bold;
  float:right;
  }
  .comment_box{
    background-color:#D3E7F5; border-bottom:#ffffff solid 1px; padding-top:3px
  }
  h1{
    color:#555555
  }
  a{
    text-decoration:none;
    color:#d02b55;
  }
  a:hover{
    text-decoration:underline;
    color:#d02b55;
  }
  *{margin:0;padding:0;}
  ol.timeline{list-style:none;font-size:1.2em;}
  ol.timeline li{ position:relative;margin:20px 0; border-bottom:#dedede dashed 1px}
  ol.timeline li:first-child{border-top:1px dashed #dedede;}
  .comment_button{
    margin-right:30px; background-color:#95CD3C; color:#000; border:#333333 solid 1px; padding:3px;font-weight:bold; font-size:11px; font-family:Arial, Helvetica, sans-serif
  }
  .comment_submit{
    background-color:#3b59a4; color:#FFFFFF; border:none; font-size:11px; padding:3px; margin-top:3px;
  }
  .panel{
    margin-left:50px; margin-right:50px; margin-bottom:5px; background-color:#D3E7F5; height:45px; padding:6px; width:400px;
    display:none;
  }
  .load_comment{
    margin-left:50px; margin-right:50px; margin-bottom:5px; background-color:#D3E7F5; height:10px; padding:5px; width:300px; font-size:14px;
  }
  .flash_load{
    margin-left:50px; margin-right:50px; margin-bottom:5px;height:20px; padding:6px; width:400px; 
    display:none; 
  }
</style>
 {/literal}
</head>
<body>
<div id="tabs">
    <ol id="update" class="timeline"></ol>
</div>
</body>
</html>