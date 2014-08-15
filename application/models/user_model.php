<?php

/*
 * user_model.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class user_model extends MY_Model{
    public $_table = 'sys_users';
    public $primary_key = 'user_id';
    public $protected_attributes = array('user_id');                
    
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
        $query = "SELECT a.*,CASE WHEN a.status='1' THEN 'AKTIF' ELSE 'NON AKTIF' END AS statusnya,b.group_name
            FROM sys_users a
            LEFT JOIN sys_groups b ON a.group_id=b.group_id
            ORDER BY a.user_id DESC";
        return $query;
    }
    
}