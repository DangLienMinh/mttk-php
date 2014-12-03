<div id="container">
  <div class="timeline_container">
    <div class="timeline">
      <div class="plus"></div>
    </div>
  </div>
  <div class="item" id="updateWallStatus">
    {$postStatus}
    <div id="tabs">
      <ul>
        <li><a href="#tabs-1">Choose music</a></li>
        <li><a href="#tabs-2">Upload music</a></li>
        <li><a href="#tabs-3">Playlist</a></li>
      </ul>
      <div id="tabs-1">
        <textarea name="status" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <input type="text" name="music_name" id="music_name" placeholder="Song name?"/>
        <input type="hidden" name="fanclub_id"/>
        <input type="hidden" name="music_url" id="music_url" />
        <input type="hidden" name="title" id="title" />
        <div id="musicContainer">
          <div id="musicBody" class="musics">
            <ul id="finalResult"></ul>
          </div>
        </div>
        <div id="jquery_jplayer_1" class="jp-jplayer"></div>
        <div id="jp_container_1" class="jp-audio centerAlign">
          <div class="jp-type-single">
            <div class="jp-gui jp-interface">
              <div class="jp-controls">
                <button class="jp-play" role="button" tabindex="0">play</button>
                <button class="jp-stop" role="button" tabindex="0">stop</button>
              </div>
              <div class="jp-progress">
                <div class="jp-seek-bar">
                  <div class="jp-play-bar"></div>
                </div>
              </div>
              <div class="jp-volume-controls">
                <button class="jp-mute" role="button" tabindex="0">mute</button>
                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                <div class="jp-volume-bar">
                  <div class="jp-volume-bar-value"></div>
                </div>
              </div>
              <div class="jp-time-holder">
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                <div class="jp-toggles">
                  <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                </div>
              </div>
            </div>
            <div class="jp-details">
              <div class="jp-title" aria-label="title">&nbsp;</div>
            </div>
            <div class="jp-no-solution">
              <span>Update Required</span>
              To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
            </div>
          </div>
        </div>
      </div>
      <div id="tabs-2">
        <textarea name="status2" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <input type="file" name="musicFile" size="20"/>
      </div>
      <div id="tabs-3">
        <div id="playlistBoxUpdateStatus">
          <select></select>
          <input type="hidden" name="playlist_id" id="playlist_id" />
        </div>
        <textarea name="status3" id="target" rows="4" placeholder="What's on your mind?"></textarea>
        <br/>
        <div id="jquery_jplayer_2" class="jp-jplayer"></div>
        <div id="jp_container_2" class="jp-audio centerAlign">
          <div class="jp-type-playlist">
    <div class="jp-gui jp-interface">
      <div class="jp-controls">
        <button class="jp-previous" role="button" tabindex="0">previous</button>
        <button class="jp-play" role="button" tabindex="0">play</button>
        <button class="jp-next" role="button" tabindex="0">next</button>
        <button class="jp-stop" role="button" tabindex="0">stop</button>
      </div>
      <div class="jp-progress">
        <div class="jp-seek-bar">
          <div class="jp-play-bar"></div>
        </div>
      </div>
      <div class="jp-volume-controls">
        <button class="jp-mute" role="button" tabindex="0">mute</button>
        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
        <div class="jp-volume-bar">
          <div class="jp-volume-bar-value"></div>
        </div>
      </div>
      <div class="jp-time-holder">
        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
      </div>
      <div class="jp-toggles">
        <button class="jp-repeat" role="button" tabindex="0">repeat</button>
        <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
      </div>
    </div>
    <div class="jp-playlist">
      <ul>
        <li>&nbsp;</li>
      </ul>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
        </div>
        <!--cai playlist de day dung ajax load vao combo-->
      </div>
      <div id="privacyRight">
        <select name="privacy" id="privacy">
          <option selected value="1">Public</option>
          <option value="2">Friend</option>
          <option value="3">Custom</option>
          <option value="4">Private</option>
        </select>
        <input type="submit" value="Post" id="postStatus"/>
      </div>
    </div>
    {form_close()}
  </div>
</div>
<div id="pop">
  <img/>
  <h2></h2>
</div>
<div style="display: none; border: 1px solid black; height: 50px; width: 180px; 
  padding: 5px; position: absolute; left: 100px; top: 100px; 
  background-color: silver;" id="playlistBox">
  <select></select>
  <input type="hidden" id="titleMusic"/>
  <input type="hidden" id="urlMusic"/>
  <button id="savePlaylist">Save</button>
</div>