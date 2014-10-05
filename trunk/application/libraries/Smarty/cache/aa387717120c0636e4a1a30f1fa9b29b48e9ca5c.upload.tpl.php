<?php /*%%SmartyHeaderCode:6897542ebac43137b3-99160074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa387717120c0636e4a1a30f1fa9b29b48e9ca5c' => 
    array (
      0 => 'application\\views\\templates\\upload.tpl',
      1 => 1412348610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6897542ebac43137b3-99160074',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542ebac442a0d1_66128293',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542ebac442a0d1_66128293')) {function content_542ebac442a0d1_66128293($_smarty_tpl) {?><html>
<head>
<title>Upload Form</title>
</head>
<body>

 
<form action="http://localhost:81/mttk-php/upload/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<textarea rows="4" cols="50" name="status"></textarea><br />
<input type="file" name="userfile" size="20" />

<br />

<input type="submit" value="upload" />

</form>

</body>
</html><?php }} ?>
