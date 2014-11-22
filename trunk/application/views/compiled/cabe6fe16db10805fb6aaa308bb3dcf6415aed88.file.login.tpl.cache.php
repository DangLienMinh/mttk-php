<?php /* Smarty version Smarty-3.1.18, created on 2014-11-22 20:05:47
         compiled from "application\views\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1218454708a2b208ac2-58939033%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cabe6fe16db10805fb6aaa308bb3dcf6415aed88' => 
    array (
      0 => 'application\\views\\templates\\login.tpl',
      1 => 1416410065,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1218454708a2b208ac2-58939033',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54708a2b2debb7_62044289',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54708a2b2debb7_62044289')) {function content_54708a2b2debb7_62044289($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>MMusic Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>
css/login.css">
</head>
<body>
	<div class="error"><?php echo validation_errors();?>
</div>

  	<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>My<span>Music</span></div>
		</div>
		<br>
		<?php echo form_open('userController/login1');?>

		<div class="login">
				<input type="text" placeholder="Email..." name="email_login"><br>
				<input type="password" placeholder="Password..." name="pass_login"><br>
				<input type="submit" value="Login" /><br><br>
				<a href="#">Forgot your password?</a>
		</div>
		<?php echo form_close();?>

		<?php echo form_open('userController/register');?>

		<div class="register">
				<input type="text" placeholder="Your email..." name="email"><br>
				<input type="password" placeholder="Password" name="password"><br>
				<input type="password" placeholder="Re-type password" name="re_password"><br><br>
				<input type="text" placeholder="First name" name="first_name" class="nameInput">
				<input type="text" placeholder="Last name" name="last_name" class="nameInput"><br><br>
				<input type="date" name="birthday"/>
				<input type="submit" value="Register" />
		</div>
		<?php echo form_close();?>

</body>
</html><?php }} ?>
