<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <link rel="stylesheet" href="{asset_url()}css/firstTime.css">
  <link rel="stylesheet" href="{asset_url()}css/imgcropstyle.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="{asset_url()}js/cropbox.js"></script>
  <script type="text/javascript">
  window.avatarFolder="{asset_url()}img/";
  window.userPic="{uploads_url()}img/";
{literal}
  $(window).load(function() {
    var options = {
      thumbBox: '.thumbBox',
      spinner: '.spinner',
      imgSrc: window.avatarFolder + 'avatar.png'
    }
    var cropper = $('.imageBox').cropbox(options);
    $('#file').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(e) {
        options.imgSrc = e.target.result;
        cropper = $('.imageBox').cropbox(options);
      }
      reader.readAsDataURL(this.files[0]);
      this.files = [];
    });

    $('#btnCrop').on('click', function() {
      var img = cropper.getDataURL();
      $('.cropped').append('<img src="' + img + '">');
      $.ajax({
        type: "POST",
{/literal}
        url: "{base_url('profileController/updateImage')}",
{literal}
        data: {
          image: img
        },
        success: function(data) {
          parent.jQuery.colorbox.close();
          //$(".headlineLeft").hide();
          window.parent.$('.coverImg').css('background', 'url("' + window.userPic+data + '")');
          window.parent.$('.stimg img').replaceWith('<img id="anhtiminh@yahoo.com" src="'+window.userPic+data+'" style="width:70px;height:70px">');
          window.parent.$('.cmtpic img').replaceWith('<img src="'+window.userPic+data+'" style="width:33px;height:33px;">');
          window.parent.$('.loginUser').replaceWith('<img class="loginUser" style="width:33px;height:33px;vertical-align:middle;margin-right:7px;float:left" src="'+window.userPic+data+'"/>');
          //parent.window.location.href = data;
        }
      });
    });

    $('#btnZoomIn').on('click', function() {
      cropper.zoomIn();
    })
    $('#btnZoomOut').on('click', function() {
      cropper.zoomOut();
    })
  });
</script>
{/literal}
</head>
<body>
<div class="container">
    <div class="imageBox">
        <div class="thumbBox"></div>
        <div class="spinner" style="display: none">Loading...</div>
    </div>
    <div class="action">
        <input type="file" id="file" style="float:left; width: 250px"/>
        <div id="zoom">
          <h3>Zoom</h3>
          <input type="button" id="btnZoomOut" value="-" style="float: right"/>
          <input type="button" id="btnZoomIn" value="+" style="float: right"/>
        </div>
    </div>
    <div class="cropped">
    </div>
    <input type="button" id="btnCrop" value="Finish"/>
</div>
</body>