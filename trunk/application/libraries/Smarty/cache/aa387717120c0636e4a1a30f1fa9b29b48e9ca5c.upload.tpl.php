<?php /*%%SmartyHeaderCode:13435542eb77d0f0731-94732139%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa387717120c0636e4a1a30f1fa9b29b48e9ca5c' => 
    array (
      0 => 'application\\views\\templates\\upload.tpl',
      1 => 1412346187,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13435542eb77d0f0731-94732139',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542eb77d2260f5_65557638',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542eb77d2260f5_65557638')) {function content_542eb77d2260f5_65557638($_smarty_tpl) {?><html>
<head>
<title>Upload Form</title>
</head>
<body>

<p>You did not select a file to upload.</p>
<form action="http://localhost:81/mttk-php/upload/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html><?php }} ?>
