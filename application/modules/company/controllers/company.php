<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class company extends MY_Controller {

    public function index() {        
        $this->load->view('company_index');
    }
    
    function loadMainData() {
        $grid = new GridConnector($this->db, "phpCI");        
        $grid->render_sql("select id,menu_id,menu_name from view_sys_menu", "id", "id,menu_id,menu_name");
    }
    
    function tes(){
        $tes = $this->db->query("select id,menu_id,menu_name from view_sys_menu")->result();
        var_dump($tes);
    }

}
 