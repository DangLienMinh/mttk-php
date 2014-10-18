<?php /* Smarty version Smarty-3.1.18, created on 2014-10-18 16:17:46
         compiled from "application\views\templates\signUpInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101745442768a833bd4-57391816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd50936dd633041274a1879e0624a62a9eed6202e' => 
    array (
      0 => 'application\\views\\templates\\signUpInfo.tpl',
      1 => 1413127270,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101745442768a833bd4-57391816',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5442768a99f737_00505325',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5442768a99f737_00505325')) {function content_5442768a99f737_00505325($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  
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
  </style>
 <script>
  $(document).ready(function(){
    $("#search").keyup(function(){
      if($("#search").val().length > 1) 
    {
    $.ajax({
      type: "post",

      url:"<?php echo base_url('addFriend/');?>
", 

      cache: false,
      data:'search='+$("#search").val(),
      success: function(response){
        $('#finalResult').html("");
        var obj = JSON.parse(response);
        if(obj.length>0){
          try{
            var items=[];
            $.each(obj, function(i,val){
                items.push('<li><a href="seeWall/' + val.email + '">' + val.first_name+" "+val.last_name + '</a>'+'<button type="button" class="addFriend" value="' + val.email + '">'+'Add friend</button></li>');
            });
            $('#finalResult').append.apply($('#finalResult'), items);
          }catch(e) {
            alert('Exception while request..');
          }
        }else{
          $('#finalResult').html($('<li/>').text("No Data Found"));
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

         url:"<?php echo base_url('addFriend/themBan');?>
", 

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

</head>
<body onload="initialize()">
<?php echo validation_errors();?>

<?php echo form_open_multipart('profileController/firstTime');?>

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Find Your Friends</a></li>
    <li><a href="#tabs-2">Fill Out Info</a></li>
    <li><a href="#tabs-3">Add Profile Pic</a></li>
  </ul>

  <div id="tabs-1">
    <div id="container">
      <p>Friend to search</p>
        <input type="text" name="search" id="search" />
        <ul id="finalResult"></ul>
        <button>Next</button>
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
    <p>set your profile picture</p>
    <input  name="pic" type="file"></input>
    <input type="submit" value="Upload" ></input>
  </div>
</div>
<?php echo form_close();?>

</body>
</html><?php }} ?>
