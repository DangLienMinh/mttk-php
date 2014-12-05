<html>
<head>
	<link rel="stylesheet" type="text/css" href="{asset_url()}css/report.css">
	<script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">
  		window.userPic="{uploads_url()}img/";
  		window.picName="{$pic}";
  		window.status_id="{$status}";
  	</script>
  	<script>
  	{literal}
  		$(document).ready(function() {
  			$("#userInformation").prepend('<img src="'+window.userPic+window.picName+'" />');

  			$("button").click(function(){
  				var reason=$("input[type='radio'][name='reportType']:checked").val();
  				$.ajax({
			      type: "post",
			{/literal}
			      url: "{base_url('reportadminController/addReportStatus')}",
			{literal}
			      cache: false,
			      data: 'status_id=' + window.status_id+'&reason='+reason,
			      success: function() {
			        parent.jQuery.colorbox.close();
			      }
			    });
  			});
  		});
  	{/literal}
  	</script>
</head>
<body>
	<div id="reportHeader">	
		<h3 class="">Help Us Understand What's Happening</h3>
	</div>
	<div id="reportBody">
		<ul>
			<li>
				<div id="userInformation">
					<div><a>By {$name}</a></div>
				</div>
			</li>
			<li>
				<div class="option">
					<div class="_578f">Why don't you want to see this status?</div>
					<div class="optionCheck">
						<input type="radio" name="reportType" checked value="It is annoying or not interesting">It's annoying or not interesting<br>
						<input type="radio" name="reportType" value="I do not think it should be on MyMusic">I don't think it should be on MyMusic<br>
						<input type="radio" name="reportType" value="It is spam">It's spam
					</div>
					
				</div>
				
			</li>
		</ul>
	</div>
	<div id="reportFooter">
		<button value="1" type="submit">Continue</button>
	</div>
</body>

</html>