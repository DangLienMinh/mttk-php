<html>
<head>
	<title>Page test</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="skin/blue.monday/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>

	
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
</head>


<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<input type="text" name="music_name"/>
		<input type="submit" value="search"/>
	</form>
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
</body>
</html>
<?php
	$music=$_POST["music_name"];
	$music = str_replace(' ', '+', $music);
	$urlMusic="http://j.ginggong.com/jOut.ashx?k=".$music."&h=mp3.zing.vn&code=eaf53a54-3147-483c-97ba-f7e3e2d0145b";
	$json = file_get_contents($urlMusic);
	$obj = json_decode($json);
	foreach ($obj as $value) {
		$new=$value->UrlJunDownload;
  	 	echo "<a id='a' href='#'  onclick='testXem(".json_encode($new).")'>".$value->Title."</a>";
  	 	echo "<br>";
	}
	

?>
