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
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540c5a26a175a6_75025128',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540c5a26a175a6_75025128')) {function content_540c5a26a175a6_75025128($_smarty_tpl) {?><html>
<head>
<title>My Form</title>
</head>
<body>

<form action="http://localhost:81/mttk-php/form" method="post" accept-charset="utf-8">


<h5>Username</h5>
<input type="text" name="username" size="50" />

<h5>Password</h5>
<input type="text" name="password"  size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
<?php }} ?>
