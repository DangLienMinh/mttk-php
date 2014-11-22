<?php /* Smarty version Smarty-3.1.18, created on 2014-11-22 08:49:46
         compiled from "application\views\templates\createPlaylist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:243585470401a8a0b17-09386251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cda175666a1f5230e4b659809cb8fe3d98501da' => 
    array (
      0 => 'application\\views\\templates\\createPlaylist.tpl',
      1 => 1416642497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243585470401a8a0b17-09386251',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5470401aa20d45_43156538',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5470401aa20d45_43156538')) {function content_5470401aa20d45_43156538($_smarty_tpl) {?><html>
<head>
<script type="text/javascript" src="<?php echo asset_url();?>
js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
      $('#playlistCreate').click(function(){
      	var name=$('#playlistName').val();
      	var dataString = 'playlistName=' + name;
		  $.ajax({
		    type: "post",
		
		    url: "<?php echo base_url('playlistController/createPlaylist');?>
",
		
		    data: dataString,
		    async: true,
		    cache: false,
		    timeout: 50000,
		    success: function(data) {
		      parent.jQuery.colorbox.close();
          	window.parent.location.href=data;
		    }
		  });
      });

    });
  </script>
  
</head>
<body>
    <div>
    <!-- <?php echo form_open('playlistController/createPlaylist');?>
 -->
    <h5>Playlist name</h5>
    <input type="text" name="playlistName" id="playlistName"/>
    <button type="submit" id="playlistCreate">Create</button>
<!--     <?php echo form_close();?>
 -->
  </div>
</body>
</html><?php }} ?>
