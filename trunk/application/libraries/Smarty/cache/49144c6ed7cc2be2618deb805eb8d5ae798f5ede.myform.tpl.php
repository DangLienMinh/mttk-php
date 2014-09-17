<?php /*%%SmartyHeaderCode:281185414edba31aa55-08006322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49144c6ed7cc2be2618deb805eb8d5ae798f5ede' => 
    array (
      0 => 'application\\views\\templates\\myform.tpl',
      1 => 1410097468,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281185414edba31aa55-08006322',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5414edba424a82_36313334',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5414edba424a82_36313334')) {function content_5414edba424a82_36313334($_smarty_tpl) {?><html>
<head>
<title>My Form</title>
<link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/main.css">
</head>
<body>

<form action="http://localhost:81/mttk-php/form" method="post" accept-charset="utf-8">


<h5 class="test">Username</h5>
<input type="text" name="username" size="50" />

<h5>Password</h5>
<input type="text" name="password"  size="50" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
<?php }} ?>
