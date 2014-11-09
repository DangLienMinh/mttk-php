<?php /* Smarty version Smarty-3.1.18, created on 2014-11-09 01:47:34
         compiled from "application\views\templates\createPlaylist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14436545eb9a6e9c322-68817501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '14436545eb9a6e9c322-68817501',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_545eb9a7034ac7_29259194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545eb9a7034ac7_29259194')) {function content_545eb9a7034ac7_29259194($_smarty_tpl) {?><html>
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
