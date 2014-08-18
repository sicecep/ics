<?php

/*
 * group.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class group extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('group_model', 'group'); 
    }
    
    function index(){
        $this->load->view('group/group_index');
    }
    
    function loadData(){
        $grid = new GridConnector($this->db->conn_id);        
        $grid->render_sql($this->group->loadData(),"group_id","'',group_name,group_description,created,created_by");
    }
    
    function form(){
        $this->load->view('group/group_input');
    }
    
    function form_edit($id=""){
        $s = $this->group->get_by("group_id",$id);
        $data = array(
            'group_id' => $s->group_id
           ,'group_name' => $s->group_name
           ,'group_description' => $s->group_description                  
        );
        $this->load->view('group/group_input',$data);
    }
    
    function loadData_menu($id=""){        
        $tree = new TreeGridConnector($this->db->conn_id);
        if($id=="") {
                $tree->render_sql("select id,menu_id,menu_name,menu_parent,null as nilai from sys_menu where status = '1'","menu_id","menu_name,nilai,menu_parent,menu_id","","menu_parent");
        } else {
                $tree->render_sql("select a.menu_id,a.menu_parent,a.menu_name,b.status from sys_menu a left join sys_roles b on a.menu_id = b.menu_id and b.group_id = '".$id."'","menu_id","menu_name,status,menu_parent,menu_id","","menu_parent");
        }	
    }
    
     function save(){
        $data = array(
            'group_name' => strtoupper($this->input->post('group_name')),
            'group_description' => strtoupper($this->input->post('group_description'))
        );
        $this->db->trans_begin();
        if ($this->input->post('group_id') == "") {                        
            $this->group->insert($data);
            $group_id = $this->db->insert_id();            
        } else {
            $group_id = $this->input->post("group_id");
            $this->group->update($group_id,$data);
        }
        
        $table = 'sys_roles';
        $fk = array('group_id' => $group_id);
        $this->db->delete($table, $fk);
        // input roles
        $dataMenu = $this->input->post('dataMenu');
        $dataIns = array('status', 'menu_id');
        $this->sistem_model->insertDB($dataMenu, $table, $dataIns, $fk);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
     }
     
     function delete(){
        $del = $this->group->delete($this->input->post('id'));
        echo $del;
    }
}
