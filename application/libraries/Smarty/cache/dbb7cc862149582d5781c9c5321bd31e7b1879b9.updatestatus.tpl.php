<?php /*%%SmartyHeaderCode:32536544287f9dae5a6-21538510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbb7cc862149582d5781c9c5321bd31e7b1879b9' => 
    array (
      0 => 'application\\views\\templates\\updatestatus.tpl',
      1 => 1413511723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32536544287f9dae5a6-21538510',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544287fa082814_53119966',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544287fa082814_53119966')) {function content_544287fa082814_53119966($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/jplayer.blue.monday.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.jplayer.min.js"></script>
  
  <script type="text/javascript">
    window.chosenMusic = "";
    window.title="";
    function testXem(guid,title){
      window.chosenMusic=guid;
      window.title=title;
      $("#jquery_jplayer_1").jPlayer( "destroy" );
          var player = $("#jquery_jplayer_1");
          player.jPlayer({
          ready: function (event) {
            $(this).jPlayer("setMedia", {
              title: title,
              mp3: guid
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
      }
  </script>
  <script>
  $(document).ready(function() {
      $("#target").autoGrow();
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
      $("#music_name").keyup(function(){
        $.ajax({
          type: "post",

          url:"http://localhost:81/mttk-php/statusController/chooseMusic", 

          cache: false,
          data:'music_name='+$("#music_name").val(),
          success: function(response){
            $('#finalResult').html("");
            var obj = JSON.parse(response);
            if(obj.length>0){
              try{
                var items=[];
                $.each(obj, function(i,val){
                    items.push('<li class="result"><a href="#" onclick="testXem('  +"'"+ val.UrlJunDownload +"','"+val.Title+"'"+ ')">' + val.Title+ '</a></li>');
                });
                $('#finalResult').append.apply($('#finalResult'), items);
              }catch(e) {
                alert('Exception while request..');
              }
            }else{
              $('#finalResult').html($('<li/>').text("No Data Found"));
            }
          },
          error: function(){
            alert('Error while request..');
          }

        });
      });

      $('#finalResult').on('click', 'li a', function() {
          $("#music_url").val(window.chosenMusic);
          $("#title").val(window.title);
      });
    });
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  <style type="text/css">
    #tabs{
      width:40%;
      margin: 0px auto;
    }
    #target{
      width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box; 
    }
  </style>
  
</head>
<body>
<form action="http://localhost:81/mttk-php/statusController/updateStatus" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Update status</a></li>
    <li><a href="#tabs-2">Add music</a></li>
  </ul>

  <div id="tabs-1">
    <textarea name="status" id="target" rows="4" placeholder="Enter textarea"></textarea>
    <input type="text" name="music_name" id="music_name" />
    <input type="hidden" name="music_url" id="music_url" />
    <input type="hidden" name="title" id="title" />
    <ul id="finalResult"></ul>

    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div id="jp_container_1" class="jp-audio">
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
    <textarea name="status2" id="target" rows="4" placeholder="Enter textarea"></textarea>
    <input type="file" name="musicFile" value="Upload" size="20"/>

  </div>
  <select name="privacy">
    <option selected value="1">Public</option>
    <option value="2">Friend</option>
    <option value="3">Custom</option>
    <option value="4">Private</option>
  </select>
   <input type="submit" value="submit"/>
</div>
 </form>
</body>
</html><?php }} ?>
