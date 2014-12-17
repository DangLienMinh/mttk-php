//jplayer audio structure
var element = '<div class="jp-type-single"> \
    <div class="jp-gui jp-interface"> \
      <div class="jp-controls"> \
        <button class="jp-play" role="button" tabindex="0">play</button> \
        <button class="jp-stop" role="button" tabindex="0">stop</button> \
      </div> \
      <div class="jp-progress"> \
        <div class="jp-seek-bar"> \
          <div class="jp-play-bar"></div> \
        </div> \
      </div> \
      <div class="jp-volume-controls"> \
        <button class="jp-mute" role="button" tabindex="0">mute</button> \
        <button class="jp-volume-max" role="button" tabindex="0">max volume</button> \
        <div class="jp-volume-bar"> \
          <div class="jp-volume-bar-value"></div> \
        </div> \
      </div> \
      <div class="jp-time-holder"> \
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div> \
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div> \
        <div class="jp-toggles"> \
          <button class="jp-repeat" role="button" tabindex="0">repeat</button> \
        </div> \
      </div> \
    </div> \
    <div class="jp-details"> \
      <div class="jp-title" aria-label="title">&nbsp;</div> \
    </div> \
    <div class="jp-no-solution"> \
      <span>Update Required</span> \
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>. \
    </div>';

//jplayer playlist structure
var playlistElement = '<div class="jp-type-playlist"> \
    <div class="jp-gui jp-interface"> \
      <div class="jp-controls"> \
        <button class="jp-previous" role="button" tabindex="0">previous</button> \
        <button class="jp-play" role="button" tabindex="0">play</button> \
        <button class="jp-next" role="button" tabindex="0">next</button> \
        <button class="jp-stop" role="button" tabindex="0">stop</button> \
      </div> \
      <div class="jp-progress"> \
        <div class="jp-seek-bar"> \
          <div class="jp-play-bar"></div> \
        </div> \
      </div> \
      <div class="jp-volume-controls"> \
        <button class="jp-mute" role="button" tabindex="0">mute</button> \
        <button class="jp-volume-max" role="button" tabindex="0">max volume</button> \
        <div class="jp-volume-bar"> \
          <div class="jp-volume-bar-value"></div> \
        </div> \
      </div> \
      <div class="jp-time-holder"> \
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div> \
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div> \
      </div> \
      <div class="jp-toggles"> \
        <button class="jp-repeat" role="button" tabindex="0">repeat</button> \
        <button class="jp-shuffle" role="button" tabindex="0">shuffle</button> \
      </div> \
    </div> \
    <div class="jp-playlist"> \
      <ul> \
        <li>&nbsp;</li> \
      </ul> \
    </div> \
    <div class="jp-no-solution"> \
      <span>Update Required</span> \
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>. \
    </div> \
  </div>';

//add new music status
function playSelectedSong(guid, title) {
	window.chosenMusic = guid;
	window.title = title;
	//initialize jplayer
	var player = $("#jquery_jplayer_1");
	player.jPlayer("destroy");
	player.jPlayer({
		ready: function(event) {
			$(this).jPlayer("setMedia", {
				title: title,
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

//add new playlist status music
function displaySongUpdateStatus(data) {
	var obj = JSON.parse(data);
	var cssSelector = {
		jPlayer: "#jquery_jplayer_2",
		cssSelectorAncestor: "#jp_container_2"
	};
	var playlist = [];
	var options = {
		swfPath: "js",
		supplied: "mp3",
		useStateClassSkin: true
	};
	var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
	/*Loop through the JSon array and add it to the playlist*/
	var l=obj.length;
	for (var i=0;i<l; i++) {
    	myPlaylist.add({
			title: obj[i].title,
			mp3: obj[i].mp3
		});
	}
}

//get user first 20 status
function addStatus(msg) {
	var obj = JSON.parse(msg);
	if (obj.length > window.compareStatus) {
		
		var numberToInsert = obj.length - window.compareStatus;
		window.compareStatus = obj.length;
		try {
			var container=$('#container');
			$.each(obj, function(i, val) {
				i = i + 3;
				if (!val.picture) {
					val.picture = window.userPic + '/profilePic.jpg/';
				}
				var is_delete = "";
				if (val.email == window.userLogin) {
					is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
				}else{
					is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stUnfollow"><a rel="'+val.email+'" href="#" >Unfollow</a></li><li class="stReport"><a class="iframe" rel="'+val.status_id+'" href="'+window.reportAdmin+'/'+val.email+'/'+ val.name+'/'+val.picture+'/'+val.status_id+'" >Report</a></li></ul></div></div>';
				}
				var privacy;
				if(val.privacy_type_id==1){
					privacy="Shared with: public";
				}else{
					privacy="Only me";
				}
				var checkPlaylist = parseInt(val.music);
				//truong hop playlist
				if (checkPlaylist == 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				//truong hop upload
				} else if (checkPlaylist > 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				//truong hop nhac online
				} else {
					if(val.music==""){
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					}else{
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					}
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				}
		        //$(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
			});
		} catch (e) {
			alert(e);
		}
	}
}

//Report top 10 music
function reportFamousMusic(obj) {
	try {
		var container=$('#container');
		$.each(obj, function(i, val) {
			i = i + 1;
			var content = '<div class="item"><span id="arrow"></span><div class="sttext"><div class="sttext_content"><b>Number: ' + i + '</b><p>Number of likes: ' + val.thumbs_up + '</p><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><br/><br/></div>';
			container.append(content);
			setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
			if (i == obj.length) {
				container.masonry({
					itemSelector: '.item'
				});
				Arrow_Points();
			}
		});
	} catch (e) {
		alert(e);
	}
}

//get user next 10 status
function addMoreStatus(msg, jplayer_id) {
	var obj = JSON.parse(msg);
	try {
		var container=$('#container');
		$.each(obj, function(i, val) {
			i = i + 1 + parseInt(jplayer_id);
			if (!val.picture) {
				val.picture = window.userPic + '/profilePic.jpg/';
			}
			var is_delete = "";
			if (val.email == window.userLogin) {
				is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
			}
			var privacy;
			if(val.privacy_type_id==1){
				privacy="Shared with: public";
			}else{
				privacy="Only me";
			}
			var checkPlaylist = parseInt(val.music);
			//truong hop playlist
			if (checkPlaylist == 1) {
				var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				container.append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
				//truong hop upload
			} else if (checkPlaylist > 1) {
				var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				container.append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
				//truong hop nhac online
			} else {
				if(val.music==""){
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				}else{
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				}
				container.append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
			}
		});
	} catch (e) {
		alert(e);
	}
}

//first 20 user wall status
function addStatusUserWall(obj) {
	if (obj.length > window.compareStatus) {
		window.compareStatus = obj.length;
		try {
			var container=$('#container');
			$.each(obj, function(i, val) {
				i = i + 3;
				if (!val.picture) {
					val.picture = window.userPic + '/profilePic.jpg/';
				}
				var is_delete = "";
				var privacy;
				if (val.email == window.userLogin) {
					is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
				}
				if(val.privacy_type_id==1){
					privacy="Shared with: public";
				}else{
					privacy="Only me";
				}
				var hideAction="";
				if(window.relation==1){
					if(checkPlaylist == 1){
						hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
					}else if(checkPlaylist>1){
						hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
					}
					else{
						if(val.music!=""){
							hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
						}else{
							hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
						}
					}
				}else{
					hideAction='<ul class="loadplace" id="loadplace' + val.status_id + '"></ul>';
				}
				var checkPlaylist = parseInt(val.music);
				if (checkPlaylist == 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
				} else if (checkPlaylist > 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy+ '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
				} else {
					if(val.music==""){
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					}else{
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					}
					container.append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
				}
			});
		} catch (e) {
			alert(e);
		}
	}
}

function addMoreWallStatus(msg, jplayer_id) {
	var obj = JSON.parse(msg);
	try {
		var container=$('#container');
		$.each(obj, function(i, val) {
			i = i + 1 + parseInt(jplayer_id);
			if (!val.picture) {
				val.picture = window.userPic + '/profilePic.jpg/';
			}
			var is_delete = "";
			if (val.email == window.userLogin) {
				is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
			}
			var privacy;
			if(val.privacy_type_id==1){
				privacy="Shared with: public";
			}else{
				privacy="Only me";
			}
			var hideAction="";
				if(window.relation==1){
					if(checkPlaylist == 1){
						hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
					}else if(checkPlaylist>1){
						hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
					}
					else{
						if(val.music!=""){
							hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
						}else{
							hideAction='<div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a class="iframe share_button" href="'+window.shareStatus+'/'+val.status_id+'">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div>';
						}
					}
				}else{
					hideAction='<ul class="loadplace" id="loadplace' + val.status_id + '"></ul>';
				}
				var checkPlaylist = parseInt(val.music);
				if (checkPlaylist == 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					container.append($content).masonry("appended", $content);
					getComment(val.status_id);
					getLike(val.status_id);
					getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
				} else if (checkPlaylist > 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy+ '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					container.append($content).masonry("appended", $content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
				} else {
					if(val.music==""){
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					}else{
						var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><div class="topPart"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr><br><abbr class="privacy" title="' + privacy + '"></abbr></div></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2">'+hideAction+'</div></div></div>');
					}
					container.append($content).masonry("appended", $content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
				}
			});
	} catch (e) {
		alert(e);
	}
}    



//get chat message
function addConversation(msg) {
	var obj = JSON.parse(msg);
	var b = $("#inline_content ol li:last").attr("id");
	if (typeof b === 'undefined') {
		b = 0;
	}
	b = parseInt(b);
	try {
		$.each(obj, function(i, val) {
			if (val.message_id > b) {
				if (val.email != window.userChat) {
					var div_data = '<li class="chatRight" id="' + val.message_id + '"><p>' + val.message + "</p></li>";
					$(div_data).appendTo('#inline_content ol').emotions();
					$('#inline_content ol li:last-child').show('fast', function() {
					    $("#cboxLoadedContent").animate({
						    scrollTop: $("#cboxLoadedContent")[0].scrollHeight
						 },'fast');
					});
				} else {
					if(b!=0){
						$('#chatAudio')[0].play();
					}
					var div_data = '<li class="chatLeft" id="' + val.message_id + '"><span>' + val.message + "</span></li>";
					$(div_data).appendTo('#inline_content ol').emotions();
					$('#' + val.message_id).prepend('<img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/>');
					$('#inline_content ol li:last-child').show('fast', function() {
					    $("#cboxLoadedContent").animate({
						    scrollTop: $("#cboxLoadedContent")[0].scrollHeight
						 },'fast');
					});
				}
			}
		});
		$('#content').focus();
		window.currentChatPosition = $("#inline_content ol li:first").attr("id");
	} catch (e) {
		alert(e);
	}
}

//get more chat message by click read more
function addMoreConversation(msg) {
	var obj = JSON.parse(msg);
	try {
		$.each(obj, function(i, val) {
			if (val.email != window.userChat) {
				var div_data = '<li class="chatRight" id="' + val.message_id + '"><p>' + val.message + "</p></li>";
				$(div_data).prependTo('#inline_content ol').emotions();
			} else {
				var div_data = '<li class="chatLeft" id="' + val.message_id + '"><span>' + val.message + "</span></li>";
				$(div_data).prependTo('#inline_content ol').emotions();
				$('#' + val.message_id).prepend('<img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/>');
			}
		});
		window.currentChatPosition = $("#inline_content ol li:first").attr("id");
		if ($('#inline_content ol>div>a').length) {} else
			$('#inline_content ol').prepend('<div class="morebox"><a href="#" class="more" id="' + window.currentChatPosition + '">more</a></div>');
	} catch (e) {
		alert(e);
	}
}

//set jplayer song name and url
function setSong(name, inter, songUrl, title) {
	$(name).jPlayer({
		ready: function(event) {
			$(this).jPlayer("setMedia", {
				title: title,
				mp3: songUrl
			});
		},
		swfPath: "js",
		cssSelectorAncestor: inter,
		supplied: "mp3",
		wmode: "window",
		smoothPlayBar: true,
		keyEnabled: true,
		useStateClassSkin: true,
		remainingDuration: true,
		toggleDuration: true
	});
}

//get share status to display in the share dialog
function addStatusShare(obj) {
    try {
      var container=$('#reportBody');
      $.each(obj, function(i, val) {
        i = i + 3;
        var checkPlaylist = parseInt(val.music);
        if (checkPlaylist == 1) {
          var $content = $('<div id="status' + val.status_id + '"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div>');
          container.append($content);
          getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
        } else if (checkPlaylist > 1) {
          var $content = $('<div id="status' + val.status_id + '"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div>');
          container.append($content);
          setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
        } else {
          if(val.music==""){
            var $content = $('<div id="status' + val.status_id + '"></div>');
          }else{
            var $content = $('<div id="status' + val.status_id + '"><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div>');
          }
          container.append($content);
          setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
        }
      });
    } catch (e) {
      alert(e);
    }
  }

//display song in playlists
function displaySong(name, inter, data) {
	var obj = JSON.parse(data);
	var cssSelector = {
		jPlayer: name,
		cssSelectorAncestor: inter
	};
	/*An Empty Playlist*/
	var playlist = [];
	var options = {
		swfPath: "js",
		useStateClassSkin: true,
		supplied: "mp3"
	};
	var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
	/*Loop through the JSon array and add it to the playlist*/
	var l=obj.length;
	for (var i=0;i<l; i++) {
    	myPlaylist.add({
			title: obj[i].title,
			mp3: obj[i].mp3
		});
	}
}

//add arrow for each status in timeline vertical line
function Arrow_Points() {
	var s = $('#container').find('.item');
	var l=s.length;
	for (var i=0;i<l; i++) {
		var posLeft = $(s[i]).css("left");
		$(s[i]).addClass('borderclass');
		if (posLeft == "0px") {
			html = "<span id='arrow' class='rightCorner'></span>";
			$(s[i]).find('#arrow').replaceWith(html);
		} else {
			html = "<span id='arrow' class='leftCorner'></span>";
			$(s[i]).find('#arrow').replaceWith(html);
		}
	}
}

//home page click
$(document).on('click', '#homePage', function() {
	window.location = window.mainController;
});

//message page click
$(document).on('click', '#chatPage', function() {
	window.location = window.mainController + 'main/chat/';
});

//setting status pane
$(document).on('click', '.account', function() {
	var X = $(this).attr('id');

	if (X == 1) {
		$(this).parent().find(".submenu").hide();
		$(this).attr('id', '0');
	} else {
		$(this).parent().find(".submenu").show();
		$(this).attr('id', '1');
	}
});

//notification panel setting status pane
$(document).on('click', '.settingIcon', function() {
	var X = $(this).attr('id');

	if (X == 1) {
		$(this).parent().find(".settingSubmenu").hide();
		$(this).attr('id', '0');
	} else {
		$(this).parent().find(".settingSubmenu").show();
		$(this).attr('id', '1');
	}
});

//click on user chat head
$(document).on('click', '.inline', function(e) {
	e.preventDefault();
	var userEmail = $(this).find('span').attr('class');
	getConversation(userEmail);
	$('#toUser').val(userEmail);
	if ($('#inline_content ol>div>a').length) {} else {
		$('#inline_content ol').prepend('<div class="morebox"><a href="#" class="more" id="' + window.currentChatPosition + '">more</a></div>');
	}
});

//more chat message
$(document).on('click', '.more', function(e) {
	var userEmail = $('#toUser').val();
	var last_id = $(this).attr('id');
	$(this).parent().remove();
	getMoreConversation(userEmail, last_id);
	return false;
});

//comment button click on each status
$(document).on('click', '.comment_button', function() {
	var element = $(this);
	var I = element.attr("id");
	$("#textboxcontent" + I).focus();
	return false;
});

//playlist button click on each status
$(document).on('click', '.playlist_button', function() {
	var $this = $(this);
	var musicUrl = $this.parents().eq(2).find('[id^="jp_audio_"]').attr('src');
	var title = $this.parents().eq(2).find('[id^="jp_audio_"]').attr('title');
	$('#playlistBox #titleMusic').replaceWith('<input type="hidden" id="titleMusic" value="' + title + '"/>');
	$('#playlistBox #urlMusic').replaceWith('<input type="hidden" id="urlMusic" value="' + musicUrl + '"/>');
	$('#playlistBox').css({
		left: $this.offset().left,
		top: $this.offset().top + $this.height(),
	}).toggle();
	return false;
});

//vertical timeline line hover
$('.timeline_container').mousemove(function(e) {
	var topdiv = $("#containertop").height();
	var pag = e.pageY - topdiv - 26;
	$('.plus').css({
		"top": pag + "px",
		"background": "url('images/plus.png')",
		"margin-left": "1px"
	});
}).mouseout(function() {
	$('.plus').css({
		"background": "url('')"
	});
});

// user icon hover display bigger image
function setPop(email, name, img) {
	$("#pop img").replaceWith('<img src="' + img + '"style="width:106px;height:106px"/>');
	$("#pop h2").replaceWith('<h2><a href="' + window.userWall + "/" + email + '">' + name + '</a></h2>');
}

//choose music from the suggest box
$(document).on('click', '#finalResult>li a', function() {
	$("#music_url").val(window.chosenMusic);
	$("#title").val(window.title);
	$('#music_name').val('');
});

//select the other playlist name, update all song in that playlsit
$(document).on('change', '#playlistBoxUpdateStatus select', function() {
	var id = $(this).parent().find('select').find(":selected").val();
	getSongUpdateStatus(id);
});

//notification click display the notification pane
$(document).on('click', '#notificationLink', function() {
	$("#friendContainer").hide();
	$("#notificationContainer").fadeToggle(300);
	$("#notification_count").fadeOut("slow");
	return false;
});

//add friend notification click display the friend pane
$(document).on('click', '#friendLink', function() {
	$("#notificationContainer").hide();
	$("#friendContainer").fadeToggle(300);
	$("#friend_count").fadeOut("slow");
	return false;
});

//add new song in status to playlsit
$(document).on('click', '#savePlaylist', function() {
	var id = $(this).parent().find('select').find(":selected").val();
	var title = $(this).parent().find('#titleMusic').val();
	var music = $(this).parent().find('#urlMusic').val();
	savePlaylist(id, title, music);
});

//window scroll event
$(window).scroll(function() {
	//scroll to the bottom of window
	if ($(window).scrollTop() == $(document).height() - $(window).height()) {
		var element = $('#container').find('.item:last');
		var id = element.attr('id').substring(6);
		var jplayer_id;
		if(element.find('.jp-jplayer').length>0){
			 jplayer_id= element.find('.jp-jplayer').attr('id').substring(15);
		}else{
			jplayer_id=$('#container').find(".item").length;
		}
		if (window.location.href.indexOf("layDSWallStatus") > -1) {
			var st = "layDSWallStatus/";
			var userEmail = window.location.href.substring(window.location.href.indexOf(st) + st.length);
			moreWallStatus(id, jplayer_id, userEmail);
		} else if (window.location.href.indexOf("layDSFanclubStatus") > -1) {

		} else if(window.location.href.indexOf("hienThiNotiStatus") > -1){

		}
		 else if(window.location.href.indexOf("hienThiShareStatus") > -1){

		}else {
			moreStatus(id, jplayer_id);
		}
	}
});

//window click and hide some child container if they are opened
$(document).click(function(e) {
	var container = $("#notificationContainer");

	if (!container.is(e.target) // if the target of the click isn't the container...
		&& container.has(e.target).length === 0) // ... nor a descendant of the container
	{
		container.hide();
	}
	container = $("#friendContainer");

	if (!container.is(e.target)
		&& container.has(e.target).length === 0)
	{
		container.hide();
	}
	$("#musicContainer").hide();
	container = $("#playlistBox");

	if (!container.is(e.target)
		&& container.has(e.target).length === 0)
	{
		container.hide();
	}
});

//window click and hide some child container if they are opened
$(document).mouseup(function(e) {
	$(".submenu").hide();
	$(".account").attr('id', '');
	$('.edit').hide();
	$('.text_wrapper').show();
	$('.text_wrapper1').show();
	$('#displayUserBox').hide();
	var container = $("#displayUserFanclubBox");

	if (!container.is(e.target) // if the target of the click isn't the container...
		&& container.has(e.target).length === 0) // ... nor a descendant of the container
	{
		container.hide();
	}
	container = $("#display");

	if (!container.is(e.target) && container.has(e.target).length === 0) {
		container.hide();
	}
});

//
$(document).on('click', '.delete', function() {
	var element = $(this);
	var I = element.attr("id");
	$('#list' + I).fadeOut('slow', function() {
		$(this).remove();
	});
	return false;
});

//status delete
$(document).on('click', '.stdelete', function() {
	var container=$('#container');
	if (confirm("Are your sure?")) {
		var topParent = $(this).parent().parent().parent().parent();
		var status_id = topParent.find('.staction').find('.comment_button').attr('id');
		deleteStatus(status_id);
		topParent.fadeOut('slow');
		container.masonry('remove', topParent);
		container.masonry({
			itemSelector: '.item'
		});
		var msnry = container.data('masonry');
		msnry.on('layoutComplete', function() {
			Arrow_Points();
		});
		return false;
	}
});

//status edit
$(document).on('click', '.stedit', function(e) {
	e.preventDefault();
	var topParent = $(this).parent().parent().parent().parent();
	var status_id = topParent.find('.staction').find('.comment_button').attr('id');
	var status_msg = topParent.find('.strmsg').html();
	topParent.find('.strmsg').html("");
	topParent.find('.strmsg').append('<textarea style="width:288px;height:40px">' + status_msg + '</textarea><br/><button id="' + status_id + '" value="Change" class="editStatus">Finish editing</button><button value="Change" class="cancelEdit">Cancel</button>');
});

//unfollow on each friend post
$(document).on('click', '.stUnfollow a', function(e) {
	e.preventDefault();
	var friendName =$(this).attr('rel');
	unfollowUser(friendName);
	location.reload();
});

//wall unfollow button click
$(document).on('click', '#wallUnfollow', function() {
	var friendName = $(this).attr('rel');
	unfollowUser(friendName);
});

//finish edit button
$(document).on('click', '.editStatus', function() {
	var id = $(this).attr('id');
	var content = $(this).prev().prev().val();
	suaStatus(id, content);
	$(this).parent().html($(this).parent().find('textarea').val());
});

$(document).on('click', '.cancelEdit', function() {
	$(this).parent().html($(this).parent().find('textarea').val());

});

//edit personal information button click
$(document).on('click', '.edit_link', function() {
	var parent = $(this).parent();
	var checkType = parent.find('.text_wrapper');
	if (checkType.length > 0) {
		parent.find('.text_wrapper').hide();
		var data = parent.find('.text_wrapper').html();
		parent.find('.edit').show();
		parent.find('.editbox').html(data);
		parent.find('.editbox').focus();
	} else {
		parent.find('.text_wrapper1').hide();
		var data = parent.find('.text_wrapper1').html();
		parent.find('.edit').show();
		parent.find('.editInput').val(data);
		parent.find('.editInput').focus();
		parent.find('.editbox').val(data);
		parent.find('.editbox').focus();
	}
	return false;
});

$(document).on('click', '.insertAbout', function() {
	var parent = $(this).parent();
	$(this).hide();
	parent.find('.edit_link').css("display", "block");
	parent.find('.edit').show();
	return false;
});

//edit personal information textarea mousup
$(document).on('mouseup', '.editbox', function() {
	return false;
});

//edit personal information input mousup
$(document).on('mouseup', '.editInput', function() {
	return false;
});

//status hover event
$(document).on('mouseover', '.item', function() {
	var item1 = $(".dropdown");
	var element = $(this).find(item1);
	element.show();
});

//status blur event
$(document).on('mouseout', '.item', function() {
	var item1 = $(".dropdown");
	var element = $(this).find(item1);
	element.hide();
});

//personal page user image hover 
$(document).on('mouseover', '.hexagon-in2', function() {
	$(".coverUpdate").fadeTo('slow', 1.0, function() {});
});

//personal page user image hover 
$(document).on('mouseover', '.coverUpdate', function() {
	$(".coverUpdate").fadeTo('fast', 1.0, function() {});
});
$(document).on('mouseout', '.hexagon-in2', function() {
	$(".coverUpdate").fadeTo(0, 0, function() {});
});

//personal page user image blur 
$(document).on('mouseout', '.coverUpdate', function() {
	$(".coverUpdate").fadeTo(0, 0, function() {});
});

//comment hover
$(document).on('mouseover', '.load_comment', function() {
	var element = $(this).find('a');
	element.show();
});

//comment blur
$(document).on('mouseout', '.load_comment', function() {
	var element = $(this).find('a');
	element.hide();
});

//notification mark all read
$(document).on('click', '#markRead', function(e) {
	e.preventDefault();
	var element = $(this).parent().parent().find('ul').find('li');
	for (var i=0;i<element.length; i++) {
		$(element[i]).css('background-color', 'white');
	}
	setAllNotifyIsRead();
	return false;
});

//hover user img in status or comment display the big picture
$(document).on('mouseover', '.stimg,.load_comment>img', function(event) {
	if ($(this).hasClass("stimg")) {
		var element = $(this).find("img");
		var img = element.attr("src");
		var email = element.attr("id");
		element = $(this).next("div").find("b");
		var name = element.text();

	} else {
		var element = $(this);
		var img = element.attr("src");
		var email = element.attr("id");
		element = $(this).parent().find("span");
		var name = element.attr('id');
	}
	setPop(email, name, img);

	$(this).qtip({
		overwrite: false,
		content: $('#pop'),
		style: {
			classes: 'qtip-jtools qtip-rounded qtip-shadow popup',
		},
		show: {
			event: event.type, 
			ready: true
		},
		hide: {
			delay: 200,
			fixed: true
		}
	}, event);
});

//fanclub name hover display settings
$(document).on('mouseover', '.fanclubUserBox', function() {
	var item1 = $(".leaveClub");
	var element = $(this).find(item1);
	element.show();
});

//fanclub name blur hide settings
$(document).on('mouseout', '.fanclubUserBox', function() {
	var item1 = $(".leaveClub");
	var element = $(this).find(item1);
	element.hide();
});

//change cover image in personal page
$(document).on('click', '#changeCover', function() {
	$(".headlineLeft").show();
	$('.imageBox').css('display', 'block');
});

$(document).on('click', '#btnCancel', function() {
	$(".headlineLeft").hide();
	$('.imageBox').css('display', 'none');
});


//first fanclub menu click 
$(document).on('click', '#headlineFanclub', function() {
	$('#fanclubContainer').find('#view1').show();
	$('#fanclubContainer').find('#view1').siblings('div').hide();
	$('#container').masonry({
		itemSelector: '.item'
	});
	Arrow_Points();
});

//second fanclub menu click 
$(document).on('click', '#headlineMembers', function() {
	$('#fanclubContainer').find('#view2').show();
	$('#fanclubContainer').find('#view2').siblings('div').hide();
});

//fanclub menu css bold 
$(document).on('click', '.headlineRight a', function() {
	$(this).find('span').css("display", "block");
	$(this).siblings("a").find('span').css("display", "none");
	return false;
})

//second personal page menu click 
$(document).on('click', '#headlineFriendList', function() {
	$('#wallContainer').find('#view2').show();
	$('#wallContainer').find('#view2').siblings('div').hide();
});

//first personal page menu click 
$(document).on('click', '#headlineTimeline', function() {
	$('#wallContainer').find('#view1').show();
	$('#wallContainer').find('#view1').siblings('div').hide();
	$('#container').masonry({
		itemSelector: '.item'
	});
});

//fourth personal page menu click 
$(document).on('click', '#headlinePlaylist', function() {
	$('#wallContainer').find('#view3').show();
	$('#wallContainer').find('#view3').siblings('div').hide();
});

//third personal page menu click 
$(document).on('click', '#headlineAbout', function() {
	$('#wallContainer').find('#view4').show();
	$('#wallContainer').find('#view4').siblings('div').hide();
});

//about pane education in personal page click 
$(document).on('click', '#aboutLeft1', function() {
	$('#aboutRight').find('#about1').show();
	$('#aboutRight').find('#about1').siblings('div').hide();
	$(this).addClass("aboutLeftSelected");
	$(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
	return false;
});

//about pane contact info in personal page click 
$(document).on('click', '#aboutLeft2', function() {
	$('#aboutRight').find('#about2').show();
	$('#aboutRight').find('#about2').siblings('div').hide();
	$(this).addClass("aboutLeftSelected");
	$(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
	return false;
});

//about pane details about you in personal page click 
$(document).on('click', '#aboutLeft3', function() {
	$('#aboutRight').find('#about3').show();
	$('#aboutRight').find('#about3').siblings('div').hide();
	$(this).addClass("aboutLeftSelected");
	$(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
	return false;
});

//about pane favorite in personal page click 
$(document).on('click', '#aboutLeft4', function() {
	$('#aboutRight').find('#about4').show();
	$('#aboutRight').find('#about4').siblings('div').hide();
	$(this).addClass("aboutLeftSelected");
	$(this).parent().siblings('li').find('a').removeClass("aboutLeftSelected");
	return false;
});