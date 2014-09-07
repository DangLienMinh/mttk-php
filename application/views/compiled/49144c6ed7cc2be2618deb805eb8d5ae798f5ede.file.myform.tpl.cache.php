<?php /* Smarty version Smarty-3.1.18, created on 2014-09-07 15:14:14
         compiled from "application\views\templates\myform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26697540c5a2682d302-65616967%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49144c6ed7cc2be2618deb805eb8d5ae798f5ede' => 
    array (
      0 => 'application\\views\\templates\\myform.tpl',
      1 => 1410092359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26697540c5a2682d302-65616967',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540c5a269c22c5_24207707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540c5a269c22c5_24207707')) {function content_540c5a269c22c5_24207707($_smarty_tpl) {?><html>
<head>
<title>My Form</title>
</head>
<body>
<?php echo validation_errors();?>

<?php echo form_open('form');?>



<h5>Username</h5>
<input type="text" name="username" size="50" />

<h5>Password</h5>
<input type="text" name="password"  size="50" />

<div><input type="submit" value="Submit" /></div>

<?php echo form_close();?>


</body>
</html>
<?php }} ?>
