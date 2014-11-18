<?php /* Smarty version Smarty-3.1.18, created on 2014-11-18 14:52:07
         compiled from "application\views\templates\createPlaylist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25102546b4f07490343-16361219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '25102546b4f07490343-16361219',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546b4f075a0ce3_09623275',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546b4f075a0ce3_09623275')) {function content_546b4f075a0ce3_09623275($_smarty_tpl) {?><html>
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
