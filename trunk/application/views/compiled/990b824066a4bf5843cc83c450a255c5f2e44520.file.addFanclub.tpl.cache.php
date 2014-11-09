<?php /* Smarty version Smarty-3.1.18, created on 2014-11-09 08:35:02
         compiled from "application\views\templates\addFanclub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17443545f1926644b20-74097043%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '990b824066a4bf5843cc83c450a255c5f2e44520' => 
    array (
      0 => 'application\\views\\templates\\addFanclub.tpl',
      1 => 1415518454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17443545f1926644b20-74097043',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_545f192677c516_36078912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545f192677c516_36078912')) {function content_545f192677c516_36078912($_smarty_tpl) {?><html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/wall.css">
  <style type="text/css">
  

  </style>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.autogrowtextarea.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jquery.jplayer.min.js"></script>
  <script type="text/javascript" src="<?php echo asset_url();?>
js/jplayer.playlist.min.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function() {
      /*$("#music_name").keyup(function(){
        $("#musicContainer").show();
        $.ajax({
          type: "post",

          url:"<?php echo base_url('statusController/chooseMusic');?>
", 

          cache: false,
          data:'music_name='+$("#music_name").val(),
          success: function(response){
            $('#finalResult').html("");
            $('#finalResult').append(response);
          }
        });
      });*/

      $('#fanclubCreate').click(function(){
      	var name=$('#fanclubName').val();
      	var desc=$('#fanclubDesc').val();
      	var dataString = 'name=' + name+'&desc='+desc;
		  $.ajax({
		    type: "post",
		
		    url: "<?php echo base_url('fanclubController/themFanclub');?>
",
		
		    data: dataString,
		    async: true,
		    cache: false,
		    timeout: 50000,
		    success: function(data) {
		      //addMoreStatus(data,jplayer_id);
		      alert("complete");
		    }
		  });
      });

    });
  </script>
  
</head>
<body>
  <div id="fanclub">
    <h2>Create new group</h2>
    <label>Fanclub name</label>
    <input style="display: inline-block;" placeholder="Fanclub name" type="text" id="fanclubName"/>
    <br/>
    <label>Fanclub description</label>
    <textarea id="fanclubDesc" rows="4" placeholder="Fanclub description"></textarea>

    <br/><br/><br/>
    <button type="submit" id="fanclubCreate">Create</button>
    <button type="submit" id="fanclubCancel">Cancel</button>
  </div>
</body>
</html><?php }} ?>
