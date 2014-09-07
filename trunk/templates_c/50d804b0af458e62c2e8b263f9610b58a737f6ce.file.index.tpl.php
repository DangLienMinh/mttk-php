<?php /* Smarty version Smarty-3.1.18, created on 2014-09-06 16:57:06
         compiled from "application\\views\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31471540b20c2edce94-32459002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50d804b0af458e62c2e8b263f9610b58a737f6ce' => 
    array (
      0 => 'application\\\\views\\templates\\index.tpl',
      1 => 1409972657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31471540b20c2edce94-32459002',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'description' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540b20c3073fb2_20344923',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540b20c3073fb2_20344923')) {function content_540b20c3073fb2_20344923($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Smarty Test Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />         
  </head>
  <body>
      <div class="container" id="container">
        <h2><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h2>
        <p><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</p>
      </div>          
  </body>
</html><?php }} ?>
