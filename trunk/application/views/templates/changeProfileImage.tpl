<!doctype html>
<html lang="en">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="{asset_url()}css/firstTime.css">
  <link rel="stylesheet" href="{asset_url()}css/imgcropstyle.css">
  <script type="text/javascript" src="{asset_url()}js/jquery-2.1.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
  <script type="text/javascript" src="{asset_url()}js/cropbox.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.watermarkinput.js"></script>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  <script type="text/javascript">
  {literal}
    $(window).load(function() {
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: window.emotionsFolder+'avatar.png'
        }
        var cropper = $('.imageBox').cropbox(options);
        $('#file').on('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = $('.imageBox').cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })

        $('#btnCrop').on('click', function(){
            var img = cropper.getDataURL();
            $('.cropped').append('<img src="'+img+'">');
            $.ajax({  
            type: "POST",  
{/literal}
                url:"{base_url('profileController/updateImage')}",
{literal}
            data: {image: img},
            success: function() {
              alert("Success");
            }
        });
        });
        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })
        $('#btnZoomOut').on('click', function(){
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