<?php /* Smarty version Smarty-3.1.18, created on 2014-09-29 04:23:15
         compiled from "application\views\templates\address.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3905428c29351c997-44771291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a2fbd339b06f3b408eb8f3a6585c2b4f07464bb' => 
    array (
      0 => 'application\\views\\templates\\address.tpl',
      1 => 1411956864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3905428c29351c997-44771291',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5428c293623104_78582881',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5428c293623104_78582881')) {function content_5428c293623104_78582881($_smarty_tpl) {?><!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
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
          
    <div id="locationField">
      <?php echo validation_errors();?>

      <?php echo form_open('addressProfile/address');?>

      <input id="autocomplete" placeholder="Enter your address" name="address"
             onFocus="geolocate()" type="text"></input>

      <input type="submit" value="Login" ></input>
      <?php echo form_close();?>

    </div>
  </body>
</html><?php }} ?>
