<?php /*%%SmartyHeaderCode:717546f5538a4d560-68674811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '717546f5538a4d560-68674811',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546f5538e75961_35150244',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546f5538e75961_35150244')) {function content_546f5538e75961_35150244($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>MMusic Login</title>
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/login.css">
</head>
<body>
	<div class="error"></div>

  	<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>My<span>Music</span></div>
		</div>
		<br>
		<form action="http://localhost:81/mttk-php/userController/login1" method="post" accept-charset="utf-8">
		<div class="login">
				<input type="text" placeholder="Email..." name="email_login"><br>
				<input type="password" placeholder="Password..." name="pass_login"><br>
				<input type="submit" value="Login" /><br><br>
				<a href="#">Forgot your password?</a>
		</div>
		</form>
		<form action="http://localhost:81/mttk-php/userController/register" method="post" accept-charset="utf-8">
		<div class="register">
				<input type="text" placeholder="Your email..." name="email"><br>
				<input type="password" placeholder="Password" name="password"><br>
				<input type="password" placeholder="Re-type password" name="re_password"><br><br>
				<input type="text" placeholder="First name" name="first_name" class="nameInput">
				<input type="text" placeholder="Last name" name="last_name" class="nameInput"><br><br>
				<input type="date" name="birthday"/>
				<input type="submit" value="Register" />
		</div>
		</form>
</body>
</html><?php }} ?>
