<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();        
        $this->language = $this->session->userdata('language');
        $this->language = (isset($this->language) ? $this->language : 'english');
        $this->lang_id = $this->language == "indonesia" ? "id" : "en";
        $this->lang->load('app', $this->language);
        $this->load->model('main_model','main');
        $this->load->library('user_agent');
    }
    

	public function index()
	{
            $data['username'] = $username = $this->session->userdata('esha_username');
            $group = $this->session->userdata('idgroup');             
                
            if (empty($username)) {
                redirect(site_url() . '/main/login', 'refresh');
            } else {
                $this->load->view('main', $data);
            }                                              						
	}
        
       
        function phpass(){
            $password = 'admin';
            $hashed = $this->phpass->hash($password);
            if ($this->phpass->check($password, $hashed))
            echo 'logged in ### '.$hashed;
            else
            echo 'wrong password';
        }
        
        function agent(){
            echo $this->session->userdata('esha_username');
            echo "<br />";
            echo $this->session->userdata('esha_group_id');
            echo "<br />";
            echo $this->session->userdata('esha_language_id');
            echo "<br />";
            echo $this->session->userdata('log_in_date');
            echo "<br />";
            echo $this->session->userdata('log_in_time');
            echo "<br />";
            echo $this->session->userdata('os_desc');
            echo "<br />";
            echo $this->session->userdata('ip_address');
            echo "<br />";
            echo $this->session->userdata('ip_proxy_address');
            echo "<br />";
            echo $this->session->userdata('lat');
            echo "<br />";
            echo $this->session->userdata('lon');
            echo "<br />";
            echo $this->session->userdata('city');
            echo "<br />";
            echo $this->session->userdata('reg');
            echo "<br />";
            echo $this->session->userdata('country');
            echo "<br />";
            echo $this->session->userdata('browser');
            echo "<br />";
            echo $this->session->userdata('rowversion');
            echo "<br />";
            
        }
        
        function login()
        {		                
		// SET VALIDATION RULES
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_error_delimiters('<em>','</em>');
		
		// has the form been submitted and with valid form info (not empty values)
		if($this->input->post('login'))
		{
			if($this->form_validation->run())
			{
				$username = addslashes(trim(htmlspecialchars ($this->input->post('username'))));
				$userpass = addslashes(trim($this->input->post('password')));
				
                                $user=$this->main->check_login($username);                                                                
                                
				if($user==true)
				{
                                        $data_user=$this->main->selectData_user($username); 
                                        $du = $data_user->row();
                                        $hashed = $du->password;
                                        $password = $userpass;
                                        
                                        //get language default
                                        $data_lang=$this->main->language(); 
                                        $dl = $data_lang->row();
                                        
					if($this->phpass->check($password, $hashed))
					{            
                                                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
                                                    $ipproxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                } else {
                                                    $ipproxy = 'NULL';
                                                }
                                                $sessiondata = array(
                                                    'esha_username'     => $du->username,
                                                    'esha_group_id'     => $du->group_id,
                                                    'esha_language_id'  => $dl->lang_id,
                                                    'log_in_date'=> date("Y-m-d",time()),
                                                    'log_in_time'=> date("H:i:s",time()),
                                                    'os_desc'=> $this->agent->platform(),
                                                    'ip_address'=> $_SERVER['REMOTE_ADDR'],
                                                    'ip_proxy_address'=> $ipproxy,
                                                    'lat'=> $this->input->post('lat'),
                                                    'lon'=> $this->input->post('lon'),
                                                    'city'=> $this->input->post('city'),
                                                    'reg'=> $this->input->post('reg'),
                                                    'country'=> $this->input->post('country'),
                                                    'browser'=> $this->agent->browser().' '.$this->agent->version(),
                                                    'rowversion'=> gmdate('Y-m-d')
                                                );

                                                $this->session->set_userdata($sessiondata);
                                                
						redirect('main');
//                                                die('tesss');
					}
					else
					{
						$this->session->set_flashdata('message', 'Incorrect password.');
						redirect('main/login');                                                
					}
				}
				else
				{
					$this->session->set_flashdata('message', 'A user does not exist for the username specified.');					
                                        redirect('main/login'); 
				}
			}
		}
		
		
		$this->load->view('login');
        }
        
        function logoutexit()
        {
            $this->session->sess_destroy();
            redirect(site_url());
        }
        
        function logout(){
                echo '<script language="javascript">var c = confirm("Are you sure to logout ?")
                        if(c==true){
                           window.parent.goLogout();                            
                        } else {
                           window.parent.removeTabLogout();
                        }
                </script>';
        }
        
        
        
//        function processlogin()
//        {
//            $this->load->model('msistem');
//            $m = $this->msistem->loginCheck($this->input->post('username'),md5($this->input->post('password')),$this->input->post('company'));
//            if($this->session->userdata('username'))
//            {
//                //insert logging
////                $this->load->library('user_agent');
////                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
////                    $ipproxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
////                } else {
////                    $ipproxy = 'NULL';
////                }
////                 $data = array(
////                    'user_id'=> $this->session->userdata('user_id'),
////                    'idgroup'=> $this->session->userdata('idgroup'),
////                    //'line_no'=>,
////                    'log_in_date'=> date("Y-m-d",time()),
////                    'log_in_time'=> date("H:i:s",time()),
////                    'os_desc'=> $this->agent->platform(),
////                    'ip_address'=> $_SERVER['REMOTE_ADDR'],
////                    'ip_proxy_address'=> $ipproxy,
////                    'lat'=> $this->input->post('lat'),
////                    'lon'=> $this->input->post('lon'),
////                    'city'=> $this->input->post('city'),
////                    'reg'=> $this->input->post('reg'),
////                    'country'=> $this->input->post('country'),
////                    'browser'=> $this->agent->browser().' '.$this->agent->version(),
////                    'rowversion'=> gmdate('Y-m-d')
////                );
////                $this->db->insert('users_log_tab',$data);
//                
//                redirect(site_url().'/main/');
//            } else {
//                $data['judul'] = 'Administrator';
//                $data['msg'] = 'Ada kesalahan pada saat login, coba lagi!';
//                $data['company'] = $this->db->get_where("sys_company",array('status'=>"1"))->result();
//                $this->load->view('login',$data);
//            }
//        }
	
        public function load_accord() {
                $lang = $this->session->userdata('esha_language_id');
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
			header("Content-type: application/xhtml+xml"); } else {
			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo '<accordion skin="dhx_skyblue" mode="single" openEffect="true">';
                $sql_modul = $this->db->query("SELECT a.nav_id,a.nav_image,b.nav_name,a.open_mode FROM sys_navigation a,sys_navigation_description b WHERE a.nav_id=b.nav_id and a.nav_status='1' and b.lang_id='".$lang."'");
                foreach ($sql_modul->result() as $modul){
                    if($modul->open_mode=="1"){
                        $open = 'open="true"';
                    } else {
                        $open = 'open="false"';
                    }
                    echo "<cell id=\"".$modul->nav_id."\" $open icon=\"".$modul->nav_image."\">".$modul->nav_name."</cell>";
                }                
                echo '</accordion>';
	}
        
        function menu()
        {
            if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
                header("Content-type: application/xhtml+xml");
            } else {
                header("Content-type: text/xml");
            }
            echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
            echo "<menu>";
                $this->menudb();
            echo "</menu>";
        }
        
        function menudb(){
            $grup_id = $this->session->userdata('esha_group_id');
            $data = $this->main->getMenu(0); 
            $i=0;
            foreach ($data as $d) {
                echo "<item id=\"".$d->kode_menu."\" text=\"".ucwords($d->menu_name)."\" >"; 
                    $this->menuChild($d->menu_id);
                echo "</item>";
                $i++;
            }            
        }
        
        function menuChild($parent){            
            $data = $this->main->getMenu($parent);
            $i=0;
            foreach ($data as $d) {
                $ck = $d->menu_type;                
                if($ck==10){                    
                     echo "<item id=\"".$d->kode_menu."\" text=\"".ucwords($d->menu_name)."\" type=\"checkbox\" checked=\"true\" />"; 
                } else if($ck==11){ //separator
                     echo "<item id=\"".$d->kode_menu."\" type=\"".ucwords($d->menu_name)."\" />"; 
                }  
                else {                    
                     echo "<item id=\"".$d->kode_menu."\" text=\"".ucwords($d->menu_name)."\" img=\"".ucwords($d->menu_image)."\" type=\"".$d->menu_type."\" >"; 
                     $this->menuChild($d->menu_id);
                     echo "</item>";
                }
                
                $i++;
            }
        }
        
    function toolbar() {
        if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
            header("Content-type: application/xhtml+xml");
        } else {
            header("Content-type: text/xml");
        }
        echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
        echo "<toolbar>";
        $this->toolbardb();
        echo "</toolbar>";
    }

    function toolbardb() {
        $grup_id = $this->session->userdata('esha_group_id');
        $data = $this->main->getToolbar();
        $i = 0;
        foreach ($data as $d) {
            if ($d->toolbar_image == "") {
                $image = "open.gif";
            } else {
                $image = $d->toolbar_image;
            }
            if ($d->toolbar_image == "") {
                $imagedis = "open.gif";
            } else {
                $imagedis = $d->toolbar_image;
            }
            echo "<item id=\"" . $d->kode_menu . "\" text=\"" . $d->menu_name . "\" type=\"button\" img=\"" . $image . "\" imgdis=\"" . $imagedis . "\"  />";
            echo "<item id=\"sep01\" type=\"separator\"/>";
            $i++;
        }
    }
        
//	public function menu($id) {
//		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
//			header("Content-type: application/xhtml+xml"); } else {
//			header("Content-type: text/xml");
//		}
		/*echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<tree id='0'>";
			$this->treemenu(0,$id);
		echo "</tree>";*/
//	}
	
       
//                public function menuUtama($parent,$modul) {
//                $idgroup = $this->session->userdata("idgroup");
//		$sql=$this->db->query("select r.*,m.*
//                    from master_roles r
//                    left join master_menu m ON r.idmenu=m.id
//                    where m.parent='".$parent."' and m.display='1' and m.modul='".$modul."' and r.idgroup='".$idgroup."' and r.display='1'
//                    order by r.idmenu,m.posisi asc ");
//		foreach($sql->result() as $rs) {
//			
//			$qr=$this->db->query("select r.*,m.*
//                            from master_roles r
//                            left join master_menu m ON r.idmenu=m.id
//                            where m.parent='".$rs->idmenu."' and m.display='1' and r.idgroup='".$idgroup."' and r.display='1' order by r.idmenu,m.posisi asc");
//			$num=count($qr->result());
//			
//			//$query=mysql_query("select username from hak_akses where username='".$user."' and idmenu='".$rs->id."'");
//			//$jml = 1; //mysql_num_rows($query);
//			
//			if($num==0) {
//				//if($jml!=0):
//					echo "<item id=\"".$rs->id."|".$rs->url."\" text=\"".$rs->menu."\" />"; // old
////                                        echo "<item id=\"\" text=\"\" />";
//				//endif;
//			} else {
//				echo "<item id=\"".$rs->id."|".$rs->url."\" text=\"".$rs->menu."\" open=\"".$rs->open."\" >";
//				$this->menuUtama($rs->id,$modul);
//				echo "</item>";
//				
//			}	
//		}
//	}
	
        public function dashboard(){                        
            $this->load->view("dashboard");
        }  
        
        public function welcome(){ 
            $this->data['app'] = $this->db->query('SELECT * FROM sys_app WHERE app_status="1"')->result();
            $this->load->view("welcome",$this->data);
        }
        
        function change($lang=""){
            $this->session->set_userdata(array('language'=>$lang));
            redirect(base_url('index.php/main'));
        }
        
//    function treemenu($parent="",$nav="") {        
//        $tree_modul = $this->db->query("SELECT a.*,c.menu_name,b.menu_url,b.menu_parent FROM sys_roles a
//                                        LEFT JOIN sys_menu b ON a.menu_id=b.menu_id
//                                        LEFT JOIN sys_menu_description c ON b.menu_id=c.menu_id
//                                        WHERE a.group_id='".$this->session->userdata('esha_group_id')."' AND b.nav_id='".$nav."' AND b.menu_parent='".$parent."' AND c.lang_id='".$this->session->userdata('esha_language_id')."'");
//
//        if ($tree_modul->num_rows() > 0) {
//            foreach ($tree_modul->result() as $rs) {
//
//                echo "<item id=\"menu_" . $rs->menu_id . "|" . $rs->menu_url . "|" . $rs->menu_parent . "\" text=\"" . ucwords($rs->menu_name) . "\">";
//
//                $this->treemenu($rs->menu_id,$nav);
//
//                echo "</item>";
//            }
//        }
//        
//    }
    
    public function mainmenu() {
                $username = $this->session->userdata('esha_username');
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
			header("Content-type: application/xhtml+xml"); } else {
			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<toolbar>";
                echo "<item type='text'	id='info'  text='&lt;b&gt;SELAMAT DATANG ".$username."&lt;/b&gt;' />";
                echo "<item type='separator' id='sep1' />";
                echo "<item type='button' id='dashboard'  text='Dashboard' img='dashboard.png' />";
                echo "<item type='button' id='password'  text='Change Password' img='settings.gif' imgdis='settings_dis.gif' />";
                echo "<item id='language' type='buttonSelect' img='globe.png' imgdis='globe.png' text='Language'>"; 
                    $lang = $this->db->query("SELECT * FROM sys_languages WHERE lang_status='1'")->result();
                    foreach($lang as $l){
                        echo "<item type='button' id='language_".$l->lang_code."'  text='".$l->lang_name."' img='".$l->lang_image."' />";
                    }                    
                echo "</item>";
                echo "<item type='button' id='logout'  text='Logout' img='cancel.png' imgdis='cancel_dis.png' />";                
                echo "<item type='text'	id='info2' text='&lt;font id=\"dt\" size=\"2\" style=\"font-weight:bold;\"&gt;&lt;/font&gt;' />";
                echo "<item type='separator' id='sep2' />";
                echo "<item type='text'	id='info3' text='&lt;font id=\"ur\" size=\"2\" style=\"font-weight:bold;\"&gt;&lt;/font&gt;' />";                
		echo "</toolbar>";
	}
//        <font id='ur' size='3' face='Trebuchet MS, Verdana, Arial, sans-serif' color='#000'></font>
        
}
?>
