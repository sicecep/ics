<?php

/*
 * main_model.php
 * 
 * Copyright (c) 2013 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class main_model extends CI_Model
{
    function check_login($username=""){
        $sql="select * from sys_users where username='".$username."';";	
	$result = $this->db->query($sql);
        
        if($result->num_rows()==1){	                	    
            return true;
        } else {
	    
            return false;
        }                
    }   
    
    function language(){		
	$query="select * from sys_languages where lang_default='1'";
	$result=$this->db->query($query);	
	return $result;
    }
    
    function selectData_user($username=""){
        $sql="select * from sys_users where username='".$username."';";	
	$result = $this->db->query($sql);             	    
        return $result;        
    }
    
     public function getMenu($parent){
        $query = "SELECT a.*,CONCAT(b.menu_id,'|',b.menu_url) as kode_menu,b.menu_name,b.menu_url,b.menu_parent,b.menu_image,b.menu_type
                FROM sys_roles a
                LEFT JOIN sys_menu b ON a.menu_id=b.menu_id                
                WHERE a.group_id='".$this->session->userdata('esha_group_id')."' AND b.menu_parent='".$parent."'
                    ORDER BY b.menu_order ASC";
        $db = $this->db->query($query);
        return $db->result();
    }
    
    public function getToolbar(){
        $query = "SELECT a.*,CONCAT(b.menu_id,'|',b.menu_url) as kode_menu,b.menu_name,b.menu_url,b.menu_parent,b.menu_image,b.toolbar_image
                FROM sys_roles a
                LEFT JOIN sys_menu b ON a.menu_id=b.menu_id                
                WHERE a.group_id='".$this->session->userdata('esha_group_id')."' AND b.is_toolbar='1'
                    ORDER BY b.menu_order ASC";
        $db = $this->db->query($query);
        return $db->result();
    }
}
