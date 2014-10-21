<?php /* Smarty version Smarty-3.1.18, created on 2014-10-21 02:29:38
         compiled from "application\views\templates\timeline.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123245445a8f2ea6cf5-38177554%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25074525d95955de94c59e97c1981bf0f072c0ec' => 
    array (
      0 => 'application\\views\\templates\\timeline.tpl',
      1 => 1413203745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123245445a8f2ea6cf5-38177554',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5445a8f3126559_15135912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5445a8f3126559_15135912')) {function content_5445a8f3126559_15135912($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/jplayer.blue.monday.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>

  <script type="text/javascript">
    function addmsg(msg){
        var obj = JSON.parse(msg);
        if(obj.length>window.compare){
          window.compare=obj.length;
          try{
            var items=[];
            $.each(obj, function(i,val){
                //items.push('<li>'+val.email+'</li>');
                alert("lai co tin moi");
            });
            //$('#messages').append.apply($('#messages'), items);
          }catch(e) {
            alert('Exception while request..');
          }
        }else{
        }
    }
    function addStatus(msg){
        var obj = JSON.parse(msg);
          try{
            var items=[];
            $.each(obj, function(i,val){
                items.push('<li>'+val.message+'</li>');
            });
            $('#messages').append.apply($('#messages'), items);
          }catch(e) {
            alert('Exception while request..');
          }
    }
    function waitForMsg(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "post",

      url:"<?php echo base_url('notiController/getNewNotify');?>
", 

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addmsg(data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    3000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    waitForMsg, /* Try again after.. */
                    15000); /* milliseconds (15seconds) */
            }
        });
    };
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
                    240000 /* ..after 1 seconds */
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
  </script>
<script>
  $(document).ready(function(){
      window.compare=0;
      waitForMsg(); /* Start the inital request */
      getStatus();
  });
</script>

</head>
<body>
<div id="messages">

</div>
</body>
</html><?php }} ?>
