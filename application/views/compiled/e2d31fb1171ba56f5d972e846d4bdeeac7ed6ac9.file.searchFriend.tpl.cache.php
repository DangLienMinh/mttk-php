<?php /* Smarty version Smarty-3.1.18, created on 2014-10-06 17:04:52
         compiled from "application\views\templates\searchFriend.tpl" */ ?>
<?php /*%%SmartyHeaderCode:281905432af942fd228-49966894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2d31fb1171ba56f5d972e846d4bdeeac7ed6ac9' => 
    array (
      0 => 'application\\views\\templates\\searchFriend.tpl',
      1 => 1412301512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281905432af942fd228-49966894',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5432af943aa628_76336298',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5432af943aa628_76336298')) {function content_5432af943aa628_76336298($_smarty_tpl) {?><html>
<head>
	
<style>
#search {
	background-color: lightyellow;
	outline: medium none;
	padding: 8px;
	width: 300px;
	border-radius: 2px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	border: 2px solid orange;
}

ul {
	width: 300px;
	margin: 0px;
	padding-left: 0px;
}

ul li {
	list-style: none;
	background-color: lightgray;
	margin: 1px;
	padding: 1px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
}
</style>

<script type="text/javascript" language="javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<script>
	$(document).ready(function(){
	  $("#search").keyup(function(){
	  	if($("#search").val().length > 1) 
		{
		$.ajax({
			type: "post",
			url: "http://localhost:81/mttk-php/index.php/addFriend/",
			cache: false,
			data:'search='+$("#search").val(),
			success: function(response){
				$('#finalResult').html("");
				var obj = JSON.parse(response);
				if(obj.length>0){
					try{
						var items=[];
						$.each(obj, function(i,val){
						    //items.push($("<li />").text(val.first_name + " " + val.last_name));
						    items.push('<li><a href="seeWall/' + val.email + '">' + val.first_name+" "+val.last_name + '</a></li>');
						});
						$('#finalResult').append.apply($('#finalResult'), items);
					}catch(e) {
						alert('Exception while request..');
					}
				}else{
					$('#finalResult').html($('<li/>').text("No Data Found"));
				}
			},
			error: function(){
				alert('Error while request..');
			}

		});
		}
	  });
	});
</script>

</head>
<body>
<div id="container">
<p>Note:- Please start typing surname as "Chavan", "Patil"</p>
<input type="text" name="search" id="search" />
<ul id="finalResult"></ul>
</div>
</body>
</html><?php }} ?>
