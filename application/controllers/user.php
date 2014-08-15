<?php

/*
 * user.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class user extends MY_Controller{
   
    function __construct() {
        parent::__construct();
        $this->load->model('user_model', 'user');        
    }
    
    function index(){
        $this->load->view('user/user_index');
    }
    
    function form(){        
        $this->load->view('user/user_input');
    }
    
    function form_edit($id=""){
        $s = $this->user->get_by("user_id",$id);
        $data = array(
            'user_id' => $s->user_id
           ,'username' => $s->username
           ,'nama' => $s->fullname     
           ,'group_id' => $s->group_id     
           ,'company_id' => $s->company_id   
           ,'email' => $s->email        
           ,'phone' => $s->phone     
           ,'notes' => $s->notes     
           ,'status' => $s->status
           ,"pass" => ($s->password)? '1' : ''     
        );
        $this->load->view('user/user_input',$data);
    }
    
    function load_group(){
        $sql = "SELECT * FROM sys_groups ORDER BY id ASC";
        $qr = $this->db->query($sql)->result();
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $row) {
            $s .= "<option value=\"$row->group_id\"><![CDATA[" . $row->group_name . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
    
    function load_company(){
        $sql = "SELECT * FROM sys_company ORDER BY id ASC";
        $qr = $this->db->query($sql)->result();
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $row) {
            $s .= "<option value=\"$row->company_id\"><![CDATA[" . $row->company_name . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
    
    function load_status(){        
        $qr = config_item('status');
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        $s = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
        $s .= '<complete>';

        foreach ($qr as $k => $v) {
            $s .= "<option value=\"$k\"><![CDATA[" . $v . "]]></option>";
        }
        $s .= '</complete>';
        echo $s;
    }
    
    function save(){    
        if ($this->input->post("id") == "") {
            $count = $this->user->count_by('username', $this->input->post("username"));
            if($count != 0):
                    echo "EXIST";
                    return;
            endif;
        }
        $data = array(
            'username' => $this->input->post("username")
            ,'fullname' => $this->input->post("name")
            ,'email' => $this->input->post("email")
            ,'phone' => $this->input->post("phone")
            ,'group_id' => $this->input->post("group")
            ,'company_id' => $this->input->post("company")
            ,'notes' => $this->input->post("notes")
            ,'status' => $this->input->post("status")            
        );
        $dataPass = array();
        if($this->input->post("password_hide")==""){
            $dataPass = array('password' => $this->phpass->hash($this->input->post("password")));
        }
        $this->db->trans_begin();
        if ($this->input->post("id") == "") {
            $dataIns = array_merge($data,$dataPass);
            $this->user->insert($dataIns);
        } else {
            $dataUpd = array_merge($data,$dataPass);
            $this->user->update($this->input->post("id"),$dataUpd);
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
        
    }
    
    function loadData(){
        $grid = new GridConnector($this->db->conn_id);
        $sql = $this->user->get_all();
        $grid->render_sql($this->user->loadData(),"user_id","'',username,fullname,email,phone,group_name,notes,statusnya");
    }        
    
    function tes(){
        echo var_dump(config_item('status'));
        $i = 0;
        foreach(config_item('status') as $a=>$b){
            echo $a."-".$b;
            echo "<br />";
            $i++;
        }
    }
    
//    function sepry_admin(){
//        $this->user->update('2',array('password'=>$this->phpass->hash('admin')));
//    }
    
    function delete($id=""){
        $del = $this->user->delete($id);
        echo $del;
    }
    

    
    function nama_field(){
        $field =  $this->db->list_fields($this->user->_table);
        foreach($field as $f)
        {
            echo $f.'<br />';
        }
    }
    
function backup_rec(){

$query = $this->user->get_by('1');
if(count($query)>0)
{
	//prep output
	$tab = "\t";
	$br = "\n";
	$xml = '<?xml version="1.0" encoding="UTF-8"?>'.$br;
	$xml.= '<database name="'.$this->user->_table.'">'.$br;
	
	
		//prep table out
		$xml.= $tab.'<table name="'.$this->user->_table.'">'.$br;
		
		//get the rows
//		$query3 = 'SELECT * FROM '.$table[0];
//		$records = mysql_query($query3,$link) or die('cannot select from table: '.$table[0]);
		$field =  $this->db->list_fields($this->user->_table);
		//table attributes
		$attributes = array('name');
		$xml.= $tab.$tab.'<columns>'.$br;
		$x = 0;
		foreach($field as $f)
		{
			
			$xml.= $tab.$tab.$tab.'<column ';
			foreach($attributes as $attribute)
			{
				$xml.= $attribute.'="'.$f.'" ';
			}
			$xml.= '/>'.$br;
			$x++;
		}
		$xml.= $tab.$tab.'</columns>'.$br;
		
//		//stick the records
//		$xml.= $tab.$tab.'<records>'.$br;
//		while($record = mysql_fetch_assoc($records))
//		{
//			$xml.= $tab.$tab.$tab.'<record>'.$br;
//			foreach($record as $key=>$value)
//			{
//				$xml.= $tab.$tab.$tab.$tab.'<'.$key.'>'.htmlspecialchars(stripslashes($value)).'</'.$key.'>'.$br;
//			}
//			$xml.= $tab.$tab.$tab.'</record>'.$br;
//		}
//		$xml.= $tab.$tab.'</records>'.$br;
                
		$xml.= $tab.'</table>'.$br;
	
	$xml.= '</database>';
	
	//save file
	$handle = fopen($name.'-backup-'.time().'.xml','w+');
	fwrite($handle,$xml);
	fclose($handle);

    }
}

}