<?php /*%%SmartyHeaderCode:1090454537ea4020313-34092994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '1090454537ea4020313-34092994',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54537ea4187b66_96064139',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54537ea4187b66_96064139')) {function content_54537ea4187b66_96064139($_smarty_tpl) {?><html>
<head>
</head>
<body>
    <div>
    <form action="http://localhost:81/mttk-php/playlistController/createPlaylist" method="post" accept-charset="utf-8">
    <h5>Playlist name</h5>
    <input type="text" name="playlistName"/>
    <input type="submit" value="Create" />
    </form>
  </div>
</body>
</html><?php }} ?>
