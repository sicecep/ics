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
    function check_login($param=""){
        $sql="call sp_select_users(?)";	
	$result = $this->db->query($sql,$param);
        
        if($result->num_rows()==1){	                	    
            return true;
        } else {
	    
            return false;
        }                
    }
    
    function menu($app_id,$group_id,$modul_id,$language_id,$parent){
	$param	=array(	"app_id"=>$app_id
			,"group_id"=>$group_id
			,"modul_id"=>$modul_id
			,"language_id"=>$language_id
                        ,"parent"=>$parent
		    );
	
	$query="call sp_menu(?,?,?,?,?)";
	$result=$this->db->query($query,$param);
	
	return $result;
    }
    
    function language(){	
	
	$query="call sp_select_language()";
	$result=$this->db->query($query);
	
	return $result;
    }
    
    function selectData_user($param=""){
        $sql="call sp_select_users(?)";	
	$result = $this->db->query($sql,$param);             	    
        return $result;        
    }
}
