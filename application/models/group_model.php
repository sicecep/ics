<?php

/*
 * group_model.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class group_model extends MY_Model{
    public $_table = 'sys_groups';
    public $primary_key = 'group_id';
    public $protected_attributes = array('group_id');                
    
    public $before_create = array('created','created_by');
    public $before_update = array('modified','modified_by');

    function created($s) {
        $s['created'] = date('Y-m-d H:i:s');
        return $s;
    }
    
    function created_by($s) {
        $s['created_by'] = $this->session->userdata('esha_username');
        return $s;
    }
    
    function modified($s) {
        $s['modified'] = date('Y-m-d H:i:s');
        return $s;
    }
    
    function modified_by($s) {
        $s['modified_by'] = $this->session->userdata('esha_username');
        return $s;
    }
    
     function loadData(){
        $query = "SELECT a.*
            FROM sys_groups a            
            ORDER BY a.group_id DESC";
        return $query;
    }
    
}
