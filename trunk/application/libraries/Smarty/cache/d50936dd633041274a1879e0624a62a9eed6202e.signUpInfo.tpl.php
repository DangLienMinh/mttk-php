<?php /*%%SmartyHeaderCode:26573546cb5f8eda172-18396414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd50936dd633041274a1879e0624a62a9eed6202e' => 
    array (
      0 => 'application\\views\\templates\\signUpInfo.tpl',
      1 => 1416314519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26573546cb5f8eda172-18396414',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_546cb5f91dec09_48860687',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cb5f91dec09_48860687')) {function content_546cb5f91dec09_48860687($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="http://localhost:81/mttk-php/assets/css/firstTime.css">
  <link rel="stylesheet" href="http://localhost:81/mttk-php/assets/css/imgcropstyle.css">
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery-2.1.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/cropbox.js"></script>
  <script type="text/javascript" src="http://localhost:81/mttk-php/assets/js/jquery.watermarkinput.js"></script>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  <script type="text/javascript">
    window.userPic="http://localhost:81/mttk-php/uploads/img/";
    window.emotionsFolder="http://localhost:81/mttk-php/assets/img/";
  </script>
  
 <script>
  $(document).ready(function(){
    getSuggest();
    $(".search").keyup(function(){
      if($(".search").val()!=''){
        $.ajax({
        type: "post",
  
        url:"http://localhost:81/mttk-php/friendController",
  
        cache: false,
        data:'search='+$(".search").val(),
        success: function(response){
          $('#display').html(response).show();
        }
      });
    }
  });

    $('#facebook').on('click', '.delete', function() {
      var element = $(this);
      var I = element.attr("id");
      $('#list'+I).fadeOut('slow', function() {$(this).remove();});
      return false;
    });

    $('#facebook').on('click', 'li button', function() {
      var li=$(this).parent();
      $.ajax({
         type: "POST",

         url:"http://localhost:81/mttk-php/friendController/themBan", 

         data: {friendEmail: $(this).val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                  li.fadeOut('slow', function() {});
              }
          });
      });

    $('#display').on('click', 'button', function() {
      var parent=$(this).parent();
      $.ajax({
         type: "POST",

         url:"http://localhost:81/mttk-php/friendController/themBan", 

         data: {friendEmail: $(this).val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                parent.fadeOut('slow');
              }
          });
      });
  });

  $(document).mouseup(function(e) {
    var container = $("#display");

      if (!container.is(e.target)
          && container.has(e.target).length === 0)
      {
          container.hide();
      }
  });

  function getSuggest(){
    $.ajax({
    type: "post",

    url: "http://localhost:81/mttk-php/friendController/getSuggestedFriend",

    async: true,
    cache: false,
    timeout: 50000,
    success: function(response){
         $('#facebook').append(response);
      }
  });
  }

  $(function() {
      $( "#tabs" ).tabs();
      $("#searchbox").Watermark("Search");
    });
</script>
<script>
var placeSearch, autocomplete;

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
}

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]

</script>
<script type="text/javascript">
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
            var address1=$("#autocomplete").val();
            $.ajax({  
            type: "POST",  

                url:"http://localhost:81/mttk-php/profileController/firstTime",

            data: {address:$("#autocomplete").val(),image: img},
            success: function(data) {
              window.location=data;
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

</head>
<body onload="initialize()">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Find Your Friends</a></li>
    <li><a href="#tabs-2">Fill Out Info</a></li>
    <li><a href="#tabs-3">Add Profile Pic</a></li>
  </ul>

  <div id="tabs-1">
   <!--  <ul id="facebook"></ul> -->
      <div id="searchFriend">
          <h3>Search Friends</h3>
          <input type="text" class="search" id="searchbox" /><br />
          <div id="display">
          </div>
      </div>
      <div id="friendFooter">
          <h3>Suggest Friends</h3>
          <ul id="facebook"></ul>
      </div>
</div>

  <div id="tabs-2">
    <p>Fill in these information</p>
    <div id="locationField">
      <input id="autocomplete" placeholder="Enter your address" name="address"
             onFocus="geolocate()" type="text"></input>
    </div>
  </div>
  <div id="tabs-3">
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
    </div>
    <input type="button" id="btnCrop" value="Finish"/>
  </div>
</div>
</body>
</html><?php }} ?>
