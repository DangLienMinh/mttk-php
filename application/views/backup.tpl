<html>
<head>
	<title>Page test</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<link rel="stylesheet" type="text/css" href="{asset_url()}css/jplayer.blue.monday.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="{asset_url()}js/jquery.jplayer.min.js"></script>
	{literal}
	<script type="text/javascript">
	$(document).ready(function(){
		$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				title: "",
				mp3: ""
			}).jPlayer("play");
		},
		swfPath: "js",
		supplied: "mp3",
		wmode: "window",
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
		});

		$("#music_name").keyup(function(){
	  	if($("#music_name").val().length > 1) 
		{
		$.ajax({
			type: "post",
			url: "http://localhost:81/mttk-php/index.php/addFriend/",
			cache: false,
			data:'music_name='+$("#music_name").val(),
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
	<script type="text/javascript">
		function testXem(guid){
			$("#jquery_jplayer_1").jPlayer( "destroy" );
	        var player = $("#jquery_jplayer_1");
	        player.jPlayer({
	        ready: function (event) {
						$(this).jPlayer("setMedia", {
							title: "Bubble",
							mp3: guid
						}).jPlayer("play");
					},
					swfPath: "js",
					supplied: "mp3",
					wmode: "window",
					smoothPlayBar: true,
					keyEnabled: true,
					remainingDuration: true,
					toggleDuration: true
					});
	    }
	</script>
	{/literal}
</head>
<body>
	{form_open('upload/chooseMusic')}
		<!--<input type="text" name="music_name"/>
		<input type="submit" value="search"/>-->
		<input type="text" name="music_name" id="music_name" />
		<ul id="finalResult"></ul>
	{form_close()}
	<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div id="jp_container_1" class="jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>

						<ul class="jp-toggles">
							<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
							<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
						</ul>
					</div>
				</div>
				<div class="jp-details">
					<ul>
						<li><span class="jp-title"></span></li>
					</ul>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>
		{$musicLink}
</body>
</html>