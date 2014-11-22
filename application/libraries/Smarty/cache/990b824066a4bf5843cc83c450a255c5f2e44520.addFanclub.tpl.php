<?php /*%%SmartyHeaderCode:1209954703b89b8ad44-01650120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '990b824066a4bf5843cc83c450a255c5f2e44520' => 
    array (
      0 => 'application\\views\\templates\\addFanclub.tpl',
      1 => 1416641397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1209954703b89b8ad44-01650120',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54703b89ca7477_85572061',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54703b89ca7477_85572061')) {function content_54703b89ca7477_85572061($_smarty_tpl) {?><html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="http://localhost:81/mttk-php/assets/css/wall.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function() {
      $('#fanclubCreate').click(function(){
      	var name=$('#fanclubName').val();
      	var desc=$('#fanclubDesc').val();
      	var dataString = 'name=' + name+'&desc='+desc;
		  $.ajax({
		    type: "post",
		
		    url: "http://localhost:81/mttk-php/fanclubController/themFanclub",
		
		    data: dataString,
		    async: true,
		    cache: false,
		    timeout: 50000,
		    success: function(data) {
		      parent.jQuery.colorbox.close();
          window.parent.location.href=data;
		    }
		  });
      });

    });
  </script>
  
</head>
<body>
  <div id="fanclub">
    <h2>Create new group</h2>
    <label>Fanclub name</label>
    <input style="display: inline-block;" placeholder="Fanclub name" type="text" id="fanclubName"/>
    <br/>
    <label>Fanclub description</label>
    <textarea id="fanclubDesc" rows="4" placeholder="Fanclub description"></textarea>

    <br/><br/><br/>
    <button type="submit" id="fanclubCreate">Create</button>
    <button type="submit" id="fanclubCancel">Cancel</button>
  </div>
</body>
</html><?php }} ?>
