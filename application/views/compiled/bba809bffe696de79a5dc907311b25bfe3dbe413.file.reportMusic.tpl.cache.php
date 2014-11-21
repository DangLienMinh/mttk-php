<?php /* Smarty version Smarty-3.1.18, created on 2014-11-21 17:04:14
         compiled from "application\views\templates\reportMusic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19578546f627e0b3540-81671124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bba809bffe696de79a5dc907311b25bfe3dbe413' => 
    array (
      0 => 'application\\views\\templates\\reportMusic.tpl',
      1 => 1416585811,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19578546f627e0b3540-81671124',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546f627e1a0985_44405927',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546f627e1a0985_44405927')) {function content_546f627e1a0985_44405927($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;

      data=<?php echo $_smarty_tpl->tpl_vars['items']->value;?>


    reportFamousMusic(data);
    }
  </script>
  <script>
  $(document).ready(function() {
    getStatus();


   /* $('#notificationsBody ul').bind('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight) {
          var id=$(this).find('li:last').attr("id");
          moreNotify(id.substring(4));
        }
    });*/

  });
  </script>
 
</head>
<body>
      <div id="container"></div>
</body>
</html><?php }} ?>
