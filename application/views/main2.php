<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url() . 'imgs/favicon.ico' ?>"/>
        <!-- Ajax -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dhtmlx.css" />
        <script src="<?php echo base_url(); ?>assets/dhtmlx.js"></script>        
            
        <!--jquery-->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.price_format.js"></script>         
            
        <!-- Custom Scroll -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/custom_scroll/customscroll.css" />
        <script  src="<?php echo base_url(); ?>assets/custom_scroll/customscroll.js"></script>
            
        <!-- Modal -->
        <link href="<?php echo base_url(); ?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/modal/shCore.js" language="javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/modal/shBrushJScript.js" language="javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/modal/ModalPopups.js" language="javascript"></script>
            
        <link href="<?php echo base_url(); ?>css/style_doc.css" rel="stylesheet" type="text/css" />        
        
        <script type="text/javascript">
            function UR_Start() 
            {
                UR_Nu = new Date;
                UR_Indhold = showFilled(UR_Nu.getHours()) + ":" + showFilled(UR_Nu.getMinutes()) + ":" + showFilled(UR_Nu.getSeconds());
                document.getElementById("ur").innerHTML = UR_Indhold;
                setTimeout("UR_Start()",1000);
            }
            function showFilled(Value) 
            {
                return (Value > 9) ? "" + Value : "0" + Value;
            }                                    
        </script>
        
        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
                overflow: hidden;
/*                background-color: #ebebeb;
                font-size: 11px;*/
            }            
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eSHa Framework</title>
    </head>
                            <!--#BAE4E5-->
                            <body onload="UR_Start()">
                                <div id="my_logo" style="height: 74px;">
                                    <div style="background-color:#CFE3FC; width:100%; height:auto;">
                                        <table border="0" width="100%">
                                            <tr valign="bottom">
                                                <td width="228" height="70">
                                                    <img src="<?php echo base_url(); ?>/images/logo.png" width="228" height="70" />
                                                </td>

                                                <td>    
                                                    <div align="left" style="width: 100%;">
                                                        <b>Sistem Informasi Suka-Suka Sepry Versi 1.0 <br />&nbsp;</b>
                                                    </div>
                                                    <div align="left" style="width: 100%;">                                                        
                                                        <div id="menuutama"></div>                                                        
                                                    </div>
                                                </td>                                
                                            </tr>   
                                        </table>
                                    </div>                                    
                                </div>                               

                                <script>
                                    var base_url = "<?php echo base_url(); ?>";
                                    
                                    var kurs = "";
                                    var currentTime = new Date()
                                    var month = currentTime.getMonth() + 1;
                                    var day = currentTime.getDate();
                                    var year = currentTime.getFullYear();
            
                                    // TOP NAV
                                    menuutama = new dhtmlXToolbarObject("menuutama");
                                    menuutama.setIconsPath("<?php echo base_url(); ?>/images/btn/");
                                    menuutama.addText("info", 0, "<b>SELAMAT DATANG <?= $username ?></b>")
                                    menuutama.addSeparator("sep1", 1);
                                    menuutama.addButton("dashboard", 2, "Dashboard", "house_star.png", "print_dis.gif");
                                    menuutama.addSeparator("sep1", 3);
                                    menuutama.addButton("password", 4, "Change Password", "settings.gif", "print_dis.gif");
                                    menuutama.addSeparator("sep1", 5);
                                    menuutama.addButton("logout", 6, "Logout", "reject.png", "dis_reject.png");                                                                    
                                    menuutama.addText("tanggal", 10, "<font id='' size='3' face='Trebuchet MS, Verdana, Arial, sans-serif' color='#000'>"+(day + "-" + month + "-" + year)+"</font>")
                                    menuutama.addSeparator("sep1", 11);
                                    menuutama.addText("info", 15, "<font id='ur' size='3' face='Trebuchet MS, Verdana, Arial, sans-serif' color='#000'></font>")
                                    menuutama.attachEvent("onclick", menuutamaClick);
                                    menuutama.addSpacer("logout");

                                function menuutamaClick(id){
                                    if(id=="logout"){
                                        dhtmlx.confirm({
                                                title:"Logout",
                                                ok:"Yes", cancel:"No",
                                                text:"Apakah anda yakin melakukan logout ?",
                                                callback:function(result){
                                                    if(result==true){
                                                       location.href = "<?php echo site_url() . "/main/logout" ?>";                                                       
                                                    } else {
                                                        return true;
                                                    }
                                                }
                                            });                                        
                                    }
                                    else if(id=="password"){
                                        alert("change Password");
                                    }
                                    else if(id=="dashboard"){
                                        dhxTab.setTabActive("a1"); 
                                    }
                                }
                                                
            
                                                var dhxLayoutData = {
                                                    parent: document.body,
                                                    pattern: "2U",
                                                    cells: [{
                                                            id: "a",
                                                            text: "MAIN MENU",
                                                            width: 230,
                                                            header: true,
                                                            fix_size: [false, null]
                                                        }, {
                                                            id: "b",
                                                            text: "",
                                                            header: false
                                                        }]
                                                };
                                                var dhxLayout = new dhtmlXLayoutObject(dhxLayoutData);
                                                dhxLayout.attachHeader("my_logo");
                                                statusBar = dhxLayout.attachStatusBar();
                                                statusBar.setText("<div id='statusbar'><div style='float:left;font-weight:bold;'><?php echo 'User : '.$this->session->userdata('username').' | Grup : '.$this->session->userdata('nmgroup').' | Company : '.$this->session->userdata('company_name').' ('.$this->session->userdata('company_id').') | Periode : '.$this->session->userdata('kode_fiskal').' - '.$this->session->userdata('keterangan'); ?></div><div style='text-align:right;'><b> COPYRIGHT &copy; 2013 SEPRY HARYANDI</b></div></div>");
		
		
                                                dhxAccord = dhxLayout.cells("a").attachAccordion();
                                                dhxAccord.setIconsPath(base_url+"images/menu/");
                                                dhxAccord.loadXML(base_url+"index.php/main/load_accord", function() {
                                                    dhxAccord.forEachItem(function(item){
                                                        var id = item.getId();
                                                        var dhxtr = "dhxTree_"+id;
                                                        load_dhxTree(id,dhxtr);                                                                
                                                    });                                                    
                                                });
                                                
                                                function load_dhxTree(id,dhxtr){
                                                    var objTree = dhxtr;
                                                    dhxtr = dhxAccord.cells(id).attachTree();
                                                    dhxtr.setSkin("dhx_skyblue");
                                                    dhxtr.setImagePath(base_url+"/assets/imgs/csh_scbrblue/");
                                                    dhxtr.loadXML(base_url+"/index.php/main/menu/"+id);
                                                    dhxtr.attachEvent("onClick",function(id){                                                                                                                
                                                        treeClick(id,dhxtr);                                                         
                                                    });
                                                }	
		
                                                function treeClick(id,objTree) {                                                                                                         
                                                    var i = id.split("|");                                                          
                                                    if(i[2]!="0"){
                                                        progressOn();
//                                                        cek_session("<?php echo base_url();?>index.php/home/ceksession");                                                                                                            
                                                        openTab(i[0],objTree.getSelectedItemText(),"/index.php/"+i[1]);    
                                                    }   
                                                    
                                                }
		 
                                                function outputResponse(loader) {
                                                    progressOff();
                                                    document.getElementById('objId').innerHTML = loader.xmlDoc.responseText;
                                                }
		
                                                function progressOn() {
                                                    dhxLayout.cells("b").progressOn();
                                                }
		
                                                function progressOff() {
                                                    dhxLayout.cells("b").progressOff();
                                                }
                
                                                var dhxTab = dhxLayout.cells("b").attachTabbar();
                                                dhxTab.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
                                                dhxTab.setSkin("dhx_skyblue");    
                                                dhxTab.setHrefMode("ajax-html");
                                                dhxTab.addTab("a1", "DASHBOARD", 120);          
      
                                                dhxTab.setTabActive("a1");    
                                                dhxTab.enableTabCloseButton(true);
<?php
$grup = $this->session->userdata("idgroup");
if ($grup == "1") {
    ?>                
                                                dhxTab.setContentHref("a1","<?php echo base_url(); ?>/index.php/home/dashboard");   
<?php } else { ?>                    
//                                            tab.setContentHref("a1","http://www.inprasegroup.co.id/index.php");   
<?php } ?>
    
                                        function openTab(id,text,url){         
                                            var urlnya = url;
//                                            var randomnumber=Math.floor((Math.random()*1000)+1);
                                            var judul = text;
                                            var textLength = judul.length;
                                            if(parseInt(textLength) >= 12) {  
                                                var panjang = parseInt(textLength) * 10;
                                            } else {
                                                var panjang = 100;
                                            }
                                            
                                            dhxTab.setTabActive(id);
                                            
                                            if(dhxTab.getActiveTab()!=id){
                                                dhxTab.addTab(id,judul,panjang+"px");
                                                dhxTab.setTabActive(id);
                                            }  
                                                                                        
                                            dhxTab.setContentHref(id,"<?php echo base_url(); ?>/"+urlnya);  
                                            progressOff();
                                        }
    
                                </script>
                            </body>
                            </html>