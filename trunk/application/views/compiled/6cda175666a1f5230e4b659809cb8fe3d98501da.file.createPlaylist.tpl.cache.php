<?php /* Smarty version Smarty-3.1.18, created on 2014-10-25 09:13:58
         compiled from "application\views\templates\createPlaylist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22349544b4db6988800-53404883%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cda175666a1f5230e4b659809cb8fe3d98501da' => 
    array (
      0 => 'application\\views\\templates\\createPlaylist.tpl',
      1 => 1414156786,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22349544b4db6988800-53404883',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544b4db6a7f339_70787947',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544b4db6a7f339_70787947')) {function content_544b4db6a7f339_70787947($_smarty_tpl) {?><html>
<head>
</head>
<body>
    <div>
    <?php echo form_open('playlistController/createPlaylist');?>

    <h5>Playlist name</h5>
    <input type="text" name="playlistName"/>
    <input type="submit" value="Create" />
    <?php echo form_close();?>

  </div>
</body>
</html><?php }} ?>
