<?php /* Smarty version Smarty-3.1.18, created on 2014-11-22 07:44:56
         compiled from "application\views\templates\reportMusic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32496547030e8d82bb5-33692306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bba809bffe696de79a5dc907311b25bfe3dbe413' => 
    array (
      0 => 'application\\views\\templates\\reportMusic.tpl',
      1 => 1416638689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32496547030e8d82bb5-33692306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_547030e8eae977_86015690',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547030e8eae977_86015690')) {function content_547030e8eae977_86015690($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


function getStatus(){
      var data;

      data=<?php echo $_smarty_tpl->tpl_vars['items']->value;?>


    reportFamousMusic(data);
    }
  </script>
  <script>
  $(document).ready(function() {
    getStatus();
    var msnry = $('#container').data('masonry');
    msnry.on( 'layoutComplete', masonry_refresh );
    function masonry_refresh(){
      Arrow_Points();
    }
  });
  </script>
 
</head>
<body>
        <h1 id="reportMusicTitle">10 bài hát được yêu thích nhất</h1>
    <div id="container">

        <div class="timeline_container">
          <div class="timeline">
            <div class="plus"></div>
          </div>
      </div>
    </div>
</body>
</html><?php }} ?>
