var element = '<div class="jp-gui jp-interface"> \
          <ul class="jp-controls"> \
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li> \
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li> \
            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li> \
            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> \
            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li> \
            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li> \
          </ul> \
          <div class="jp-progress"> \
            <div class="jp-seek-bar"> \
              <div class="jp-play-bar"></div> \
            </div> \
          </div> \
          <div class="jp-volume-bar"> \
            <div class="jp-volume-bar-value"></div> \
          </div> \
          <div class="jp-time-holder"> \
            <div class="jp-current-time"></div> \
            <div class="jp-duration"></div> \
              <ul class="jp-toggles"> \
              <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li> \
              <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li> \
            </ul> \
          </div> \
        </div> \
        <div class="jp-details"> \
          <ul> \
            <li><span class="jp-title"></span></li> \
          </ul> \
        </div> \
        <div class="jp-no-solution"> \
          <span>Update Required</span> \
          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>. \
        </div>';

var playlistElement = '<div class="jp-type-playlist"> \
        <div class="jp-gui jp-interface"> \
          <ul class="jp-controls"> \
            <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li> \
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li> \
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li> \
            <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li> \
            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li> \
            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> \
            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li> \
            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li> \
          </ul> \
          <div class="jp-progress"> \
            <div class="jp-seek-bar"> \
              <div class="jp-play-bar"></div> \
            </div> \
          </div> \
          <div class="jp-volume-bar"> \
            <div class="jp-volume-bar-value"></div> \
          </div> \
          <div class="jp-current-time"></div> \
          <div class="jp-duration"></div> \
          <ul class="jp-toggles"> \
            <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li> \
            <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">shuffle off</a></li> \
            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li> \
            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li> \
          </ul> \
        </div> \
        <div class="jp-playlist"> \
          <ul> \
            <li></li> \
          </ul> \
        </div> \
        <div class="jp-no-solution"> \
          <span>Update Required</span> \
          To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>. \
        </div> \
      </div> '


function playSelectedSong(guid, title) {
	window.chosenMusic = guid;
	window.title = title;
	$("#jquery_jplayer_1").jPlayer("destroy");
	var player = $("#jquery_jplayer_1");
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

function displaySongUpdateStatus(data) {
	var obj = JSON.parse(data);
	var cssSelector = {
		jPlayer: "#jquery_jplayer_2",
		cssSelectorAncestor: "#jp_container_2"
	};
	/*An Empty Playlist*/
	var playlist = [];
	var options = {
		swfPath: "js",
		supplied: "mp3"
	};
	var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
	/*Loop through the JSon array and add it to the playlist*/
	$.each(obj, function(i, val) {
		myPlaylist.add({
			title: val.title,
			mp3: val.mp3
		});
	});
}

function addStatus(msg) {
	var obj = JSON.parse(msg);
	if (obj.length > window.compareStatus) {
		var numberToInsert = obj.length - window.compareStatus;
		window.compareStatus = obj.length;
		try {
			var items = [];
			$.each(obj, function(i, val) {
				i = i + 3;
				if (!val.picture) {
					val.picture = window.profilePic;
				}
				var is_delete = "";
				if (val.email == window.userLogin) {
					is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
				}
				var checkPlaylist = parseInt(val.music);
				if (checkPlaylist == 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				} else if (checkPlaylist > 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				} else {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				}
			});
		} catch (e) {
			alert(e);
		}
	}
}

function addMoreStatus(msg, jplayer_id) {
	var obj = JSON.parse(msg);
	try {
		var items = [];
		$.each(obj, function(i, val) {
			i = i + 1 + parseInt(jplayer_id);
			if (!val.picture) {
				val.picture = window.profilePic;
			}
			var is_delete = "";
			if (val.email == window.userLogin) {
				is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
			}
			var checkPlaylist = parseInt(val.music);
			if (checkPlaylist == 1) {
				var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				$('#container').append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
			} else if (checkPlaylist > 1) {
				var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				$('#container').append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
			} else {
				var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
				$('#container').append($content).masonry("appended", $content);
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
			}
		});
	} catch (e) {
		alert(e);
	}
}

function addStatusUserWall(obj) {
	var numberToInsert = obj.length - window.compareStatus;
	if (obj.length > window.compareStatus) {
		window.compareStatus = obj.length;
		try {
			var items = [];
			$.each(obj, function(i, val) {
				i = i + 3;
				if (!val.picture) {
					val.picture = window.profilePic;
				}
				var is_delete = "";
				if (val.email == window.userLogin) {
					is_delete = '<div class="dropdown"><a class="account" ></a><div class="submenu" style="display: none; "><ul class="root"><li class="stedit"><a href="#" >Edit</a></li><li class="stdelete"><a href="#" >Delete</a></li></ul></div></div>';
				}
				var checkPlaylist = parseInt(val.music);
				if (checkPlaylist == 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio">' + playlistElement + '</div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:32px" placeholder=" Write your comment..." class="commentInput" id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					getSong('#jquery_jplayer_' + i, '#jp_container_' + i, checkPlaylist);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				} else if (checkPlaylist > 1) {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, window.userMusic + '/' + val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				} else {
					var $content = $('<div class="item" id="status' + val.status_id + '"><span id="arrow"></span>' + is_delete + '<div class="stimg"><img id="' + val.email + '" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id="playlist' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea class="commentInput" style="width:305px;height:32px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea></div></div></div>');
					$('#container').append($content);
					getComment(val.status_id);
					getLike(val.status_id);
					setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
					numberToInsert = numberToInsert - 1;
					if (numberToInsert == 0) {
						return;
					}
				}
			});
		} catch (e) {
			alert(e);
		}
	}
}

function addConversation(msg) {
	var obj = JSON.parse(msg);
	//$("#inline_content ol").empty();
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
				} else {
					$('#chatAudio')[0].play();
					var div_data = '<li class="chatLeft" id="' + val.message_id + '"><span>' + val.message + "</span></li>";
					$(div_data).appendTo('#inline_content ol').emotions();
					$('#' + val.message_id).prepend('<img style="width:30px;height:30px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/>');
				}
			}
		});
		$('#content').focus();
		window.currentChatPosition = $("#inline_content ol li:first").attr("id");
	} catch (e) {
		alert(e);
	}
}

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
			//$('#inline_content ol').prepend(div_data).emotions();
		});
		window.currentChatPosition = $("#inline_content ol li:first").attr("id");
		if ($('#inline_content ol>div>a').length) {} else
			$('#inline_content ol').prepend('<div class="morebox"><a href="#" class="more" id="' + window.currentChatPosition + '">more</a></div>');
	} catch (e) {
		alert(e);
	}
}

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
		remainingDuration: true,
		toggleDuration: true
	});
}

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
		supplied: "mp3"
	};
	var myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
	/*Loop through the JSon array and add it to the playlist*/
	$.each(obj, function(i, val) {
		myPlaylist.add({
			title: val.title,
			mp3: val.mp3
		});
	});
}

function Arrow_Points() {
	var s = $('#container').find('.item');
	$.each(s, function(i, obj) {
		var posLeft = $(obj).css("left");
		$(obj).addClass('borderclass');
		if (posLeft == "0px") {
			html = "<span id='arrow' class='rightCorner'></span>";
			$(obj).find('#arrow').replaceWith(html);
		} else {
			html = "<span id='arrow' class='leftCorner'></span>";
			$(obj).find('#arrow').replaceWith(html);
		}
	});
}
$(document).on('click', '#homePage', function() {
	window.location=window.homePage;
});

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

//Textarea without editing.
$(document).mouseup(function() {
	$(".submenu").hide();
	$(".account").attr('id', '');
});


$(document).on('click', '.inline', function(e) {
	e.preventDefault();
	//alert($(this).find('span').text());
	var userEmail = $(this).find('span').attr('class');
	getConversation(userEmail);
	$('#toUser').val(userEmail);
	if ($('#inline_content ol>div>a').length) {} else {
		$('#inline_content ol').prepend('<div class="morebox"><a href="#" class="more" id="' + window.currentChatPosition + '">more</a></div>');
	}
});

$(document).on('click', '.more', function(e) {
	var userEmail = $('#toUser').val();
	var last_id = $(this).attr('id');
	$(this).parent().remove();
	getMoreConversation(userEmail, last_id);
	return false;
});

$(document).on('click', '.comment_button', function() {
	var element = $(this);
	var I = element.attr("id");
	$("#textboxcontent" + I).focus();
	return false;
});

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

function setPop(email, name, img) {
	$("#pop img").replaceWith('<img src="' + img + '"style="width:106px;height:106px"/>');
	$("#pop h2").replaceWith('<h2><a href="' + window.userWall + "/" + email + '">' + name + '</a></h2>');
}

$(document).on('click', '#finalResult>li a', function() {
	$("#music_url").val(window.chosenMusic);
	$("#title").val(window.title);
	$('#music_name').val('');
});

$(document).on('change', '#playlistBoxUpdateStatus select', function() {

	var id = $(this).parent().find('select').find(":selected").val();
	getSongUpdateStatus(id);
});

$(document).on('click', '#notificationLink', function() {
	$("#friendContainer").hide();
	$("#notificationContainer").fadeToggle(300);
	$("#notification_count").fadeOut("slow");
	return false;
});

$(document).on('click', '#friendLink', function() {
	$("#notificationContainer").hide();
	$("#friendContainer").fadeToggle(300);
	$("#friend_count").fadeOut("slow");
	return false;
});

$(document).on('click', '#savePlaylist', function() {
	var id = $(this).parent().find('select').find(":selected").val();
	var title = $(this).parent().find('#titleMusic').val();
	var music = $(this).parent().find('#urlMusic').val();
	savePlaylist(id, title, music);
});

$(window).scroll(function() {
	if ($(window).scrollTop() == $(document).height() - $(window).height()) {
		var element = $('#container').find('.item:last');
		var id = element.attr('id').substring(6);
		var jplayer_id = element.find('.jp-jplayer').attr('id').substring(15);
		if (window.location.href.indexOf("layDSWallStatus") > -1) {
			var st="layDSWallStatus/";
			var userEmail=window.location.href.substring(window.location.href.indexOf(st)+st.length);
		    moreWallStatus(id, jplayer_id,userEmail);
		}else{
			moreStatus(id, jplayer_id);
		}
	}
});

$(document).click(function() {
	$("#notificationContainer").hide();
	$("#friendContainer").hide();
	$("#musicContainer").hide();
});

$(document).on('click', '.delete', function() {
	var element = $(this);
	var I = element.attr("id");
	$('#list' + I).fadeOut('slow', function() {
		$(this).remove();
	});
	return false;
});

$(document).on('click', '.stdelete', function() {
	if (confirm("Are your sure?")) {
		var topParent = $(this).parent().parent().parent().parent();
		var status_id = topParent.find('.staction').find('.comment_button').attr('id');
		//deleteStatus(status_id);
		topParent.fadeOut('slow');
		$('#container').masonry('remove', topParent);
		$('#container').masonry({
			itemSelector: '.item'
		});
		var msnry = $('#container').data('masonry');
        msnry.on( 'layoutComplete', function(){
        	Arrow_Points();
        } );
        return false;
	}
});

$(document).on('click', '.stedit', function(e) {
	e.preventDefault();
	var topParent = $(this).parent().parent().parent().parent();
	var status_id = topParent.find('.staction').find('.comment_button').attr('id');
	var status_msg = topParent.find('.strmsg').html();
	topParent.find('.strmsg').html("");
	topParent.find('.strmsg').append('<textarea style="width:288px;height:40px">' + status_msg + '</textarea><br/><button id="' + status_id + '" value="Change" class="editStatus">Finish editing</button><button value="Change" class="cancelEdit">Cancel</button>');
});

$(document).on('click', '.editStatus', function() {
	var id = $(this).attr('id');
	var content = $(this).prev().prev().val();
	suaStatus(id, content);
	$(this).parent().html($(this).parent().find('textarea').val());
});

$(document).on('click', '.cancelEdit', function() {
	$(this).parent().html($(this).parent().find('textarea').val());

});

$(document).on('mouseover', '.item', function() {
	var item1 = $(".dropdown");
	var element = $(this).find(item1);
	element.show();
});

$(document).on('mouseout', '.item', function() {
	var item1 = $(".dropdown");
	var element = $(this).find(item1);
	element.hide();
});

$(document).on('mouseover', '.load_comment', function() {
	var element = $(this).find('a');
	element.show();
});

$(document).on('click', '#markRead', function(e) {
	e.preventDefault();
	var element = $(this).parent().parent().find('ul').find('li');
	element.each(function() {
		$(this).css('background-color', 'white');
	});
	setAllNotifyIsRead();
	return false;
});

$(document).on('mouseout', '.load_comment', function() {
	var element = $(this).find('a');
	element.hide();
});

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
			event: event.type, // Use the same show event as the one that triggered the event handler
			ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
		},
		hide: {
			delay: 200,
			fixed: true
		}
	}, event); // Pass through our original event to qTip
});