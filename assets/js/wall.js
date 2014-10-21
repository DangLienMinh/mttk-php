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

function setPop(name, img) {
	$("#pop img").replaceWith('<img src="' + img + '"style="width:106px;height:106px"/>');
	$("#pop h2").replaceWith('<h2>' + name + '</h2>');
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

$(document).on('mouseover', '.stimg,.load_comment>img', function() {
	if ($(this).hasClass("stimg")) {
		var element = $(this).find("img");
		var img = element.attr("src");
		element = $(this).next("div").find("b");
		var name = element.text();

	} else {
		var element = $(this);
		var img = element.attr("src");
		element = $(this).parent().find("span");
		var name = element.attr('id');
	}
	setPop(name, img);
	$("#pop").show();

});

$(document).on('mouseout', '.stimg,.load_comment>img', function() {
	$("#pop").hide();
});

$(document).on('mousemove', '.stimg,.load_comment>img', function(e) {
	var moveLeft = 0;
	var moveDown = 0;
	var target = '#pop';
	leftD = e.pageX + parseInt(moveLeft);
	maxRight = leftD + $(target).outerWidth();
	windowLeft = $(window).width() - 40;
	windowRight = 0;
	maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
	if (maxRight > windowLeft && maxLeft > windowRight) {
		leftD = maxLeft;
	}
	topD = e.pageY - parseInt(moveDown);
	maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
	windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
	maxTop = topD;
	windowTop = parseInt($(document).scrollTop());
	if (maxBottom > windowBottom) {
		topD = windowBottom - $(target).outerHeight() - 20;
	} else if (maxTop < windowTop) {
		topD = windowTop + 20;
	}
	$(target).css('top', topD).css('left', leftD);
});