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

function addStatus(msg) {
	var obj = JSON.parse(msg);
	var numberToInsert = obj.length - window.compareStatus;
	if (obj.length > window.compareStatus) {
		window.compareStatus = obj.length;
		try {
			var items = [];
			$.each(obj, function(i, val) {
				i = i + 1;
				if (!val.picture) {
					val.picture = window.profilePic;
				}

				var is_delete="";
		          if(val.email==window.userLogin){
		            is_delete="stdelete";
		          }
				$('#container').append('<div class="item"><a href="#" class="'+is_delete+'"></a><div class="stimg"><img id="'+val.email+'" src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a><a href="#" class="playlist_button" id=playlist"' + val.status_id + '">Playlist</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:23px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea><br/><button value="Comment" class="comment_submit" id="' + val.status_id + '">Comment</button></div></div></div>');
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
				numberToInsert = numberToInsert - 1;
				if (numberToInsert == 0) {
					return false;
				}
			});
		} catch (e) {
			alert(e);
		}
	}
}

function addPlaylist(msg) {
	var obj = JSON.parse(msg);
	try {
		$.each(obj, function(i, val) {
			$('#playlistBox select').append('<option value="'+val.Playlist_id+'">'+val.Playlist_name+'</option>');
		});
		$('#playlistBox').append('<br/><a class="iframe" href="'+window.cretePlaylist+'">Create Playlist</a>');
		$(".iframe").colorbox({iframe:true, width:"50%", height:"50%"});
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
				i = i + 1;
				if (!val.picture) {
					val.picture = window.profilePic;
				}
				$('#container').append('<div class="item"><a href="#" class="stdelete"></a><div class="stimg"><img src="' + window.userPic + val.picture + '" style="width:70px;height:70px"/></div><div class="sttext"><div class="sttext_content"><b><a href="' + window.userWall + "/" + val.email + '">' + val.name + '</a></b><div class="sttime"><abbr class="timeago" title="' + val.created_at + '"></abbr></div><div class="strmsg">' + val.message + '</div><div id="jquery_jplayer_' + i + '" class="jp-jplayer"></div><div id="jp_container_' + i + '" class="jp-audio"><div class="jp-type-single" id="jp_interface_' + i + '">' + element + '</div></div></div></div><div class="sttext_content2"><div class="staction"><a href="#" class="like like_button icontext"  id="like' + val.status_id + '"></a><a href="#" class="comment_button icontext comment" id="' + val.status_id + '">Comment</a><a href="#" class="share_button" id=share"' + val.status_id + '">Share</a></div><ul class="loadplace" id="loadplace' + val.status_id + '"></ul><div id="flash' + val.status_id + '" class="flash_load"></div><div class="panel" id="slidepanel' + val.status_id + '"><div class="cmtpic"><img src="' + window.userPicCmt + '" style="width:33px;height:33px;" /></div><textarea style="width:305px;height:23px" placeholder=" Write your comment..." id="textboxcontent' + val.status_id + '"></textarea><br/><button value="Comment" class="comment_submit" id="' + val.status_id + '">Comment</button></div></div></div>');
				getComment(val.status_id);
				getLike(val.status_id);
				setSong('#jquery_jplayer_' + i, '#jp_interface_' + i, val.music, val.title);
				numberToInsert = numberToInsert - 1;
				if (numberToInsert == 0) {
					return false;
				}
			});
		} catch (e) {
			alert(e);
		}
	}
}

function addFriendRequest(msg) {
	var obj = JSON.parse(msg);
	if (obj.length > 0) {
		$(".friend_bubble").replaceWith('<div class="friend_bubble">' + obj.length + '</div>');
		try {
			var items = [];
			var count = 0;
			$.each(obj, function(i, val) {
				if (count <= 6) {
					$('#friend_content>ul').append('<li style="background:#f4f6f9"  class="noti"><a href="' + window.userWall + "/" + val.email + '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/><span>' + val.name + '</span></a><div class="friendAction"><button id="friendAccept" onClick="window.location.href='+"'"+window.friendController+ "/acceptFriendRequest/" + val.email +"'"+'">Accept</button><button id="friendDecline" onClick="window.location.href='+"'"+window.friendController+ "/removeFriendRequest/" + val.email +"'"+'">Decline</button></div></li>');
					count = count + 1;
				} else {
					$('#friend_content>ul').append('<li class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + '">See all</a></li>');
					return false;
				}
				if (count == obj.length) {
					$('#friend_content>ul').append('<li class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + '">See all</a></li>');
					return false;
				}
			});
		} catch (e) {
			alert('Exception while request..' + e);
		}
	}else {
		$(".friend_bubble").hide();
	}
}

function addmsg(msg, times) {
	var obj = JSON.parse(msg);
	if (times > 0) {
		$(".noti_bubble").replaceWith('<div class="noti_bubble">' + times + '</div>');
	} else {
		$(".noti_bubble").hide();
	}

	if (obj.length > window.compare) {
		window.compare = obj.length;
		try {
			var items = [];
			var count = 0;
			$.each(obj, function(i, val) {
				if (count <= 6) {
					var noti_icon = "";
					if (val.type == "1") {
						notiIcon = "noti_like";
					} else {
						notiIcon = "noti_comment";
					}
					if (times > 0) {
						$('#noti_content>ul').append('<li style="background:#f4f6f9"  class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + "/" + val.notification_id + '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/><span>' + val.msg + '</span><br/><abbr class="timeago ' + notiIcon + '" title="' + val.created_at + '"></abbr></a></li>');
						times = times - 1;
					} else {
						$('#noti_content>ul').append('<li class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + '"><img style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="' + window.userPic + val.picture + '"/><span>' + val.msg + '</span><br/><abbr class="timeago ' + notiIcon + '" title="' + val.created_at + '"></abbr></a></li>');
					}
					count = count + 1;
				} else {
					$('#noti_content>ul').append('<li class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + '">See all</a></li>');
					return false;
				}
				if (count == obj.length) {
					$('#noti_content>ul').append('<li class="noti"><a href="' + window.notifyStatus + "/" + val.status_id + '">See all</a></li>');
					return false;
				}

			});
		} catch (e) {
			alert('Exception while request..' + e);
		}
	}
}

$(document).on('click', '.comment_button', function() {
	var element = $(this);
	var I = element.attr("id");
	$("#textboxcontent" + I).focus();
	return false;
});

$(document).on('click', '.playlist_button', function() {
	var $this = $(this);
	var musicUrl=$this.parents().eq(2).find('[id^="jp_audio_"]').attr('src');
	var title=$this.parents().eq(2).find('[id^="jp_audio_"]').attr('title');
	$('#playlistBox #titleMusic').replaceWith('<input type="hidden" id="titleMusic" value="'+title+'"/>');
	$('#playlistBox #urlMusic').replaceWith('<input type="hidden" id="urlMusic" value="'+musicUrl+'"/>');
    $('#playlistBox').css({
        left: $this.offset().left,
        top: $this.offset().top+$this.height(),
    }).toggle();
});

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

function Arrow_Points() {
	var s = $('#container').find('.item');
	$.each(s, function(i, obj) {
		var posLeft = $(obj).css("left");
		$(obj).addClass('borderclass');
		if (posLeft == "0px") {
			html = "<span class='rightCorner'></span>";
			$(obj).prepend(html);
		} else {
			html = "<span class='leftCorner'></span>";
			$(obj).prepend(html);
		}
	});
}

function Arrow_Points1() {
	var s = $('#container').find('.item');
	$.each(s, function(i, obj) {
		var posLeft = $(obj).css("left");
		$(obj).addClass('borderclass');
		if (posLeft == "0px") {
			html = "<span class='leftCorner'></span>";
			$(obj).prepend(html);
		} else {
			html = "<span class='rightCorner'></span>";
			$(obj).prepend(html);
		}
	});
}

$(document).on('click', '.stdelete', function() {
	if (confirm("Are your sure?")) {
		$(this).parent().fadeOut('slow');
		$('#container').masonry('remove', $(this).parent());
		$('#container').masonry({
			itemSelector: '.item',
		});
		$('.rightCorner').hide();
		$('.leftCorner').hide();
		Arrow_Points1();
	}
	return false;
});

function setPop(email,name, img) {
	$("#pop img").replaceWith('<img src="' + img + '"style="width:106px;height:106px"/>');
	$("#pop h2").replaceWith('<h2><a href="'+ window.userWall+"/"+email+'">' + name + '</a></h2>');
}

$(document).on('mouseover', '.item', function() {
	var item1 = $(".stdelete");
	var element = $(this).find(item1);
	element.show();
});

$(document).on('mouseout', '.item', function() {
	var item1 = $(".stdelete");
	var element = $(this).find(item1);
	element.hide();
});

$(document).on('mouseover', '.load_comment', function() {
	var element = $(this).find('a');
	element.show();
});

$(document).on('mouseout', '.load_comment', function() {
	var element = $(this).find('a');
	element.hide();
});

$(document).on('mouseover', '.stimg,.load_comment>img', function(event) {
	if ($(this).hasClass("stimg")) {
		var element = $(this).find("img");
		var img = element.attr("src");
		var email=element.attr("id");
		element = $(this).next("div").find("b");
		var name = element.text();

	} else {
		var element = $(this);
		var img = element.attr("src");
		var email=element.attr("id");
		element = $(this).parent().find("span");
		var name = element.attr('id');
	}
	setPop(email,name, img);

	$(this).qtip({
		overwrite: false,
        content: $('#pop'),
        style: {
        	classes: 'qtip-jtools qtip-rounded qtip-shadow popup',
   		},
        show: {
            event: event.type, // Use the same show event as the one that triggered the event handler
            ready: true // Show the tooltip as soon as it's bound, vital so it shows up the first time you hover!
        },hide: {
	        delay: 200,
	        fixed: true
	    }
    }, event); // Pass through our original event to qTip
});
