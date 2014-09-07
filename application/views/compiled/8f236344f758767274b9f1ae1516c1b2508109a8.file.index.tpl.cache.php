<?php /* Smarty version Smarty-3.1.18, created on 2014-09-07 13:12:37
         compiled from "application\views\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21486540c3da566b3e0-30028257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f236344f758767274b9f1ae1516c1b2508109a8' => 
    array (
      0 => 'application\\views\\templates\\index.tpl',
      1 => 1410088350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21486540c3da566b3e0-30028257',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_540c3da57405f5_54638405',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_540c3da57405f5_54638405')) {function content_540c3da57405f5_54638405($_smarty_tpl) {?><p>index.tpl page shows the variables here:</p>
<p>title: <?php echo $_smarty_tpl->tpl_vars['data']->value['username'];?>
</p>
<p>description: <?php echo $_smarty_tpl->tpl_vars['data']->value['password'];?>
</p><?php }} ?>
