<?php

/*
 * language.php
 * 
 * Copyright (c) 2013 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Language extends MY_Controller {
  function __construct() {
    parent::__construct();
  }
  function change($lang="")
  {
//    $lang = $this->uri->segment(2);
    $this->session->set_userdata(array('language'=>$lang));
//    redirect(base_url('index.php/language'));
  }
  
  public function index(){
      $this->load->view('view_home');
  }
  
  function destroy(){
      session_destroy();      
  }
 
}