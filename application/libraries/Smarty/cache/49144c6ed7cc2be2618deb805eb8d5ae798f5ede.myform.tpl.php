<?php /*%%SmartyHeaderCode:284635468a99885aa24-41565851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49144c6ed7cc2be2618deb805eb8d5ae798f5ede' => 
    array (
      0 => 'application\\views\\templates\\myform.tpl',
      1 => 1414459575,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284635468a99885aa24-41565851',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5468a998a2b668_17224947',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5468a998a2b668_17224947')) {function content_5468a998a2b668_17224947($_smarty_tpl) {?><html>
<head>
<title>My Form</title>
<link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/main.css">
</head>
<body>

<form action="http://localhost:81/mttk-php/userController/register" method="post" accept-charset="utf-8">

<h1>Register account</h1>
<h5 class="test">Email</h5>
<input type="text" name="email"/>

<h5>Password</h5>
<input type="text" name="password"/>

<h5>First name</h5>
<input type="text" name="first_name"/>

<h5>Last name</h5>
<input type="text" name="last_name"/>

<h5>Birthday</h5>
<input type="text" name="birthday"/>


<div><input type="submit" value="Submit" /></div>

</form>

<form action="http://localhost:81/mttk-php/userController/login1" method="post" accept-charset="utf-8">
<h5>email name</h5>
<input type="text" name="email_login"/>

<h5>ps</h5>
<input type="text" name="pass_login"/>
<div><input type="submit" value="Login" /></div>
</form>
</body>
</html>
<?php }} ?>
