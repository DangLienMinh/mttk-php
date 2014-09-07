<?php /* Smarty version Smarty-3.1.18, created on 2014-09-07 16:15:30
         compiled from "application\views\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4099540c6882d31ac2-76032868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f236344f758767274b9f1ae1516c1b2508109a8' => 
    array (
      0 => 'application\\views\\templates\\index.tpl',
      1 => 1410095923,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4099540c6882d31ac2-76032868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540c6882e02ea8_53984149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540c6882e02ea8_53984149')) {function content_540c6882e02ea8_53984149($_smarty_tpl) {?><p>index.tpl page shows the variables here:</p>
<p>title: <?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
</p>
<p>description: <?php echo $_smarty_tpl->tpl_vars['data']->value['password'];?>
</p><?php }} ?>
