<?php /* Smarty version Smarty-3.1.18, created on 2014-10-21 16:58:08
         compiled from "application\views\templates\notiList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123554467480f25898-04922812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b58a766a422f99e878d6c37ea44d24e8f1dfe54' => 
    array (
      0 => 'application\\views\\templates\\notiList.tpl',
      1 => 1413903487,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123554467480f25898-04922812',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'item' => 0,
    'foo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544674810fc994_76292986',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544674810fc994_76292986')) {function content_544674810fc994_76292986($_smarty_tpl) {?><ul>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value) {
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
	    <li><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</li>
	<?php } ?>
<?php } ?>
</ul><?php }} ?>
