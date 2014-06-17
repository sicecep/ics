<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {       
    public function __construct() {
        parent::__construct();
        require_once("./assets/connector/grid_connector.php");
       require_once("./assets/connector/db_phpci.php");
//        require_once (APPPATH . "/libraries/connector/combo_connector.php");        
//        require_once (APPPATH . "/libraries/connector/grid_connector.php");                             
//        require_once (APPPATH . "/libraries/connector/treegrid_connector.php");
//        require APPPATH."libraries/connector/grid_connector.php";
//        require_once(APPPATH . "/3rdparty/tcpdf/tcpdf.php");
        
//        if($this->session->userdata('user_id')==''){
//            redirect('home/login');
//        }
//        
//        $this->db_sh= $this->load->database('sh',TRUE);
//        
//        $this->language = $this->session->userdata('esha_language_id');
//        $this->language = (isset($this->language) ? $this->language : 'english');
//        $this->language_id = $this->language == "indonesia" ? "id" : "en";
//        $this->lang->load('app', $this->language);
//        
//        
//        $_username = $this->session->userdata('esha_username');
//        $_group_id = $this->session->userdata('esha_group_id');
        
    }
    
}
