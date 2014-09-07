<?php /* Smarty version Smarty-3.1.19, created on 2014-09-06 05:44:51
         compiled from "application\\views\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12905540a8333b7ba58-47825277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e72fc26fe6648a046f58e4dbbb7bb5db39ad66d3' => 
    array (
      0 => 'application\\\\views\\templates\\index.tpl',
      1 => 1409972657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12905540a8333b7ba58-47825277',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'description' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_540a8333c30431_76428610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540a8333c30431_76428610')) {function content_540a8333c30431_76428610($_smarty_tpl) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
