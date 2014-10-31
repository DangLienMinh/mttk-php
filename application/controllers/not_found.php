<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class not_found extends CI_Controller
{
 function index()
 {
  $this->smarty->view('test404');
 }
} 