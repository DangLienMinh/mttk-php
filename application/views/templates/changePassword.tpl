<html>
<head>
	<link rel="stylesheet" type="text/css" href="{asset_url()}css/report.css">
	<script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">
  		window.password="{$password}";
  	</script>
  	<script>
  	{literal}
  		$(document).ready(function() {
  			$(".cancelButton").click(function(){
  				parent.jQuery.colorbox.close();
  			});

  			$(".submitButton").click(function(){
  				var oldPass=$("#password_old").val();
  				var newPass=$("#password_new").val();
  				var confirmPass=$("#password_confirm").val();
  				if(oldPass!=window.password){
  					alert("Old password is not right");
  				}else{
  					if(newPass!=confirmPass){
  						alert("New password must be the same as retype password");
  					}else{
  						$.ajax({
					      type: "post",
					{/literal}
					      url: "{base_url('userController/suaPassword')}",
					{literal}
					      cache: false,
					      data: 'pass=' + newPass,
					      success: function() {
					        parent.jQuery.colorbox.close();
					      }
					    });
  					}
  				}
  			});
  		});
  	{/literal}
  	</script>
</head>
<body>
	<div id="reportHeader">	
		<h3 class="">Change your password</h3>
	</div>
	<div id="reportBody">
		<ul>
			<li>
				<div class="option">
					<div class="ptm"><table class="uiInfoTable uiInfoTableFixed noBorder" role="presentation"><tbody><tr class="dataRow"><th class="label"><label for="password_old">Current</label></th><td class="data"><input type="password" class="inputtext" name="password_old" id="password_old"></td></tr><tr><th class="label noLabel"></th><td class="data"><div>&nbsp;</div></td></tr><tr class="dataRow"><th class="label"><label for="password_new">New</label></th><td class="data"><input type="password" class="inputtext" name="password_new" id="password_new" autocomplete="off"></td></tr><tr><th class="label noLabel"></th><td class="data"><div id="password_new_status">&nbsp;</div></td></tr><tr class="dataRow"><th class="label"><label for="password_confirm">Retype new</label></th><td class="data"><input type="password" class="inputtext" name="password_confirm" id="password_confirm" autocomplete="off"></td></tr><tr><th class="label noLabel"></th><td class="data"><div id="password_confirm_status">&nbsp;</div></td></tr></tbody></table></div>
				</div>
				
			</li>
		</ul>
	</div>
	<div id="reportFooter">
		<button class="cancelButton">Cancel</button>
		<button value="1" class="submitButton" type="submit">Save password</button>
	</div>
</body>

</html>