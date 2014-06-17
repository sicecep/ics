<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class menu1 extends MY_Controller {

//    public function __construct(){
//        require_once (APPPATH . "/libraries/connector/grid_connector.php"); 
//    }
    
    public function index() {
        $this->load->view('menu_index');
    }
    
    function loadMainData() {
        $grid = new GridConnector($this->db->conn_id);
//        var_dump($grid);
        $grid->render_sql("select id,group_id,group_description from sys_groups", "id", "id,group_id,group_description");
    }
    
    function tes(){
        $tes = $this->db->query("select id,menu_id,menu_name from view_sys_menu")->result();
        var_dump($tes);
    }
    
    function tes2(){
        $grid = new GridConnector($this->db, "phpCI");                
        $grid->render_sql("SELECT id,group_id,group_description FROM sys_groups", "id", "id,group_id,group_description");
    }

}
 
/* End of file hmvc.php */
/* Location: ./application/modules/menu/controllers/menu.php */