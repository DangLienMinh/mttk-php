<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="{asset_url()}css/wall.css">
  <link rel="stylesheet" href="{asset_url()}css/imgcropstyle.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
  <script type="text/javascript" src="{asset_url()}js/cropbox.js"></script>
  <script type="text/javascript" src="{asset_url()}js/jquery.watermarkinput.js"></script>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  <script type="text/javascript">
    window.userPic="{uploads_url()}img/";
  </script>
  {literal}
  <style type="text/css">
    #tabs{
      width:40%;
      margin: 0px auto;
    }
    #target{
      width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box; 
    }
        .action
        {
            width: 400px;
            height: 30px;
            margin: 10px 0;
        }
        .cropped>img
        {
            margin-right: 10px;
        }
  </style>
 <script>
  $(document).ready(function(){
    $(".search").keyup(function(){
      if($(".search").val()!=''){
    $.ajax({
      type: "post",
{/literal}
      url:"{base_url('friendController/')}",
{literal}
      cache: false,
      data:'search='+$(".search").val(),
      success: function(response){
        var obj = JSON.parse(response);
        if(obj.length>0){
          try{
            var items=[];
            $.each(obj, function(i,val){
                //items.push('<li><a href="seeWall/' + val.email + '">' + val.first_name+" "+val.last_name + '</a>'+'<button type="button" class="addFriend" value="' + val.email + '">'+'Add friend</button></li>');
                items.push('<div class="display_box" align="left"><img src="'+window.userPic+val.picture+'" style="max-width:80%; max-height:80%; float:left; margin-right:6px" /><a href="seeWall/' + val.email + '">' + val.first_name+" "+val.last_name + '</a><button type="button" class="addFriend" value="' + val.email + '">'+'Add friend</button></div>');
            });
            $('#display').html(items).show();
          }catch(e) {
            alert('Exception while request..');
          }
        }else{
          $('#display').html("No Data Found");
          $('#display').show();
        }
      },
      error: function(){
        alert('Error while request..');
      }

    });
}
    });

    $('#finalResult').on('click', 'li button', function() {
      $.ajax({
         type: "POST",
{/literal}
         url:"{base_url('friendController/themBan')}", 
{literal}
         data: {friendEmail: $(this).val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
              }
          });// you have missed this bracket
      });
  });
  $(function() {
      $( "#tabs" ).tabs();
      $("#searchbox").Watermark("Search");
    });
</script>
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

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
            imgSrc: 'avatar.png'
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
{/literal}
                url:"{base_url('profileController/firstTime')}",
{literal}
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
{/literal}
</head>
<body onload="initialize()">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Find Your Friends</a></li>
    <li><a href="#tabs-2">Fill Out Info</a></li>
    <li><a href="#tabs-3">Add Profile Pic</a></li>
  </ul>

  <div id="tabs-1">
      <div style=" width:300px; margin-right:30px;" align="right">
          <input type="text" class="search" id="searchbox" /><br />
          <div id="display">
          </div>
        </div>
</div>

  <div id="tabs-2">
    <p>Fill in these information</p>
    <div id="locationField">
      <input id="autocomplete" placeholder="Enter your address" name="address"
             onFocus="geolocate()" type="text"></input>
      <button>Next</button>
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
        <input type="button" id="btnZoomIn" value="+" style="float: right"/>
        <input type="button" id="btnZoomOut" value="-" style="float: right"/>
    </div>
    <div class="cropped">
    </div>
    </div>
    <input type="button" id="btnCrop" value="OK"/>
  </div>
</div>
</body>
</html>