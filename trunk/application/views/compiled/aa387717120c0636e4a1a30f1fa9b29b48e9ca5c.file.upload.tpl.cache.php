<?php /* Smarty version Smarty-3.1.18, created on 2014-10-03 16:49:33
         compiled from "application\views\templates\upload.tpl" */ ?>
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
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542eb77d1e6a58_26342310',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542eb77d1e6a58_26342310')) {function content_542eb77d1e6a58_26342310($_smarty_tpl) {?><html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

<?php echo form_open_multipart('upload/do_upload');?>


<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

<?php echo form_close();?>


</body>
</html><?php }} ?>
