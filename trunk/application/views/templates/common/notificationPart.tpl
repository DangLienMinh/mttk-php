<div id="m">
        <a><img src="{asset_url()}img/logo.png" class="logo"></a>
        <ul id="mon_menu">
          <li id="personalPage">
          </li>
          <li><a href="#" id="homePage">HOME</a></li>
          <li id="friend_li">
            <span id="friend_count"></span>
            <a href="#" id="friendLink">FRIENDS</a>
            <div id="friendContainer">
              <div id="friendTitle">Friend requests</div>
              <div id="friendBody" class="friend">
                <ul></ul>
              </div>
              <div id="friendFooter">
                <h3>Suggest Friends</h3>
                <ul id="facebook"></ul>
              </div>
            </div>
          </li>
          <li>
            <span id="message_count"></span>
            <a href="#" id="chatPage">MESSAGES</a>
          </li>
          <li id="notification_li">
            <span id="notification_count"></span>
            <a href="#" id="notificationLink">NOTIFICATIONS</a>
            <div id="notificationContainer">
              <div id="notificationTitle">
                Notifications
                <a href="#" id="markRead">Mark all read</a>
              </div>
              <div id="notificationsBody" class="notifications">
                <ul></ul>
              </div>
              <div id="notificationFooter"><a href="#">See All</a></div>
            </div>
          </li>
        </ul>
        <!-- <div id="logoutContainer" class="social"> -->
        <div class="settingDropdown social">
          <a class="settingIcon" ></a>
          <div class="settingSubmenu" style="display: none;">
            <ul class="root">
              <li class="settingPassword"></li>
              <li class="settingLogout"></li>
            </ul>
          </div>
        </div>
        <input type="text" class="search" id="searchbox" placeholder="Search for people, fanclub"/><br />
        <div id="displayUserBox">
        </div>
      </div>