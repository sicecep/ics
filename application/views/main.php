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
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/modal/mymodal.js" language="javascript"></script>
            
        <link href="<?php echo base_url(); ?>css/main_style.css" rel="stylesheet" type="text/css" />        
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/myfunction.js" language="javascript"></script>
        
        <script type="text/javascript">
//            function UR_Start() 
//            {
//                eSHa = new Date;
//                UR_Indhold = showFilled(eSHa.getHours()) + ":" + showFilled(eSHa.getMinutes()) + ":" + showFilled(eSHa.getSeconds());
//                UR_date = showFilled(eSHa.getDate()) + "-" + showFilled(eSHa.getMonth()+1) + "-" + showFilled(eSHa.getFullYear());
//                document.getElementById("ur").innerHTML = UR_Indhold;
//                document.getElementById("dt").innerHTML = UR_date;
//                setTimeout("UR_Start()",1000);
//            }
//            
//            function showFilled(Value) 
//            {
//                return (Value > 9) ? "" + Value : "0" + Value;
//            }   
            
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
                            <body onload="">
                                <div id="content" style="background-color: #FFF;">   
                                    <div id="toolbarObj"></div>          
                                </div>
                                <div id="tabbar" style="width:100%;height:150px"></div>                              

                                <script>                                    
                                    var base_url = "<?php echo base_url(); ?>";
                                    
                                    var kurs = "";
                                    var currentTime = new Date()
                                    var month = currentTime.getMonth() + 1;
                                    var day = currentTime.getDate();
                                    var year = currentTime.getFullYear();
                                    
                                    //var dhxWins;		
                                    dhxWins = new dhtmlXWindows(); 
                                    dhxWins.enableAutoViewport(true); 
                                    dhxWins.setSkin("dhx_skyblue");
                                    //dhxWins.attachViewportTo("winVP");
                                    dhxWins.setImagePath(window.parent.base_url+"assets/imgs/");
                                    dhxWins.attachEvent("onContentLoaded", function(win){
//                                        statusEnding();	
                                    });
            
                                    mainLayout = new dhtmlXLayoutObject(document.body, "1C");
                                    mainLayout.setSkin("dhx_skyblue");
                                    mainLayout.cells("a").hideHeader();
                                    
                                    var mainMenu = mainLayout.cells("a").attachMenu(); 
                                    mainMenu.setSkin("dhx_skyblue");
                                    mainMenu.setTopText("ICS V.1.0");
                                    mainMenu.setIconsPath("<?php echo base_url(); ?>/images/menu/");  
                                    mainMenu.loadXML("<?php echo base_url(); ?>/main/menu");
                                    mainMenu.attachEvent("onClick", menuClick);
                                    mainMenu.attachEvent("onCheckboxClick", menuCheckboxClick);                                            

                                    contentLayout = new dhtmlXLayoutObject(mainLayout.cells("a"), "2E");    
                                    contentLayout.setSkin("dhx_skyblue");
                                    contentLayout.cells("a").hideHeader();
                                    contentLayout.cells("a").setHeight(42);        
                                    contentLayout.cells("b").hideHeader();  
                                    contentLayout.cells("a").setText(" ");
                                    contentLayout.setEffect("collapse", true);
                                    contentLayout.attachEvent("onExpand",function(id){
                                        contentLayout.cells("a").hideHeader();
                                        mainMenu.setCheckboxState("toolbar",true);
                                    });
                                    contentLayout.setCollapsedText("a", "Toolbar Menu");
                                    contentLayout.cells("a").fixSize(true, true);    
                                    contentLayout.cells("a").attachObject("content");
                                    
                                    var mainToolbar = new dhtmlXToolbarObject("toolbarObj", "dhx_skyblue");
                                    loadToolbar(32);
                                    mainToolbar.clearAll();
                                    mainToolbar.loadXML("<?php echo base_url(); ?>/main/toolbar/",function() {

                                    });
                                    mainToolbar.attachEvent("onclick", doToolbarClick);
                                    
                                    function doToolbarClick(id){ 
                                        var o = id.split("|");
                                        var text = mainToolbar.getItemText(id);        
                                        bukaTab(o[0],text,o[1]);
                                    }


                                    function loadToolbar(a) {
                                        mainToolbar.clearAll();
                                        mainToolbar.setIconSize(a);        
                                        mainToolbar.setIconsPath("<?php echo base_url(); ?>/images/toolbar/" + a + "/");                 
                                    }
                                    
                                    var mainTab = contentLayout.cells("b").attachTabbar();
                                    mainTab.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
                                    mainTab.setSkin("dhx_skyblue");    
                                    mainTab.setHrefMode("ajax-html");
                                    mainTab.addTab("a1", "DASHBOARD", 120);          
                                    mainTab.setContentHref("a1","<?php echo base_url(); ?>/home/dashboard");     
                                    mainTab.setTabActive("a1");    
                                    mainTab.enableTabCloseButton(true);
                                    
                                    statusBar = mainLayout.attachStatusBar();
                                    statusBar.setText("<div id='statusbar'><div style='float:left;font-weight:bold;'><?php echo 'User :  | Grup : '; ?></div>|<div id='ur'></div><div style='text-align:right;'><b> COPYRIGHT &copy; 2014 PT. MARUI INTEX</b></div></div>");
                                    
                                                function progressOn() {
                                                    dhxLayout.cells("b").progressOn();
                                                }
		
                                                function progressOff() {
                                                    dhxLayout.cells("b").progressOff();
                                                }
                
//                                                var dhxTab = dhxLayout.cells("b").attachTabbar();
//                                                dhxTab.setImagePath("<?php // echo base_url(); ?>/assets/imgs/");
//                                                dhxTab.setSkin("dhx_skyblue");    
//                                                dhxTab.setHrefMode("ajax-html");
//                                                dhxTab.addTab("a1", "DASHBOARD", 120);          
//      
//                                                dhxTab.setTabActive("a1");    
//                                                dhxTab.enableTabCloseButton(true);
//<?php
//$grup = $this->session->userdata("idgroup");
//if ($grup == "1") {
    ?>//                
//                                                dhxTab.setContentHref("a1","<?php // echo base_url(); ?>/index.php/home/dashboard");   
//<?php // } else { ?>                    
////                                            tab.setContentHref("a1","http://www.inprasegroup.co.id/index.php");   
//<?php // } ?>
    
//                                        function openTab(id,text,url){         
//                                            var urlnya = url;
////                                            var randomnumber=Math.floor((Math.random()*1000)+1);
//                                            var judul = text;
//                                            var textLength = judul.length;
//                                            if(parseInt(textLength) >= 12) {  
//                                                var panjang = parseInt(textLength) * 10;
//                                            } else {
//                                                var panjang = 100;
//                                            }
//                                            
//                                            dhxTab.setTabActive(id);
//                                            
//                                            if(dhxTab.getActiveTab()!=id){
//                                                dhxTab.addTab(id,judul,panjang+"px");
//                                                dhxTab.setTabActive(id);
//                                            }  
//                                                                                        
//                                            dhxTab.setContentHref(id,"<?php echo base_url(); ?>/"+urlnya);  
//                                            progressOff();
//                                        }
                                        
    function bukaTab(id,text,url){         
        var urlnya = url;
        var randomnumber=Math.floor((Math.random()*1000)+1);
        var judul = text;
        var textLength = judul.length;        
        if(parseInt(textLength) >= 12) {  
            var panjang = parseInt(textLength) * 10;
        } else {
            var panjang = 100;
        }           

        mainTab.setTabActive(id);        
        if(mainTab.getActiveTab()!=id){
            mainTab.addTab(id,judul,panjang+"px");
            mainTab.setTabActive(id);
        }  
        
        mainTab.setContentHref(id,"<?php echo base_url(); ?>/"+urlnya+"/"+id);  
        progressOff();
    }
                                        
    function menuClick(id){        
        var i = id.split("|");        
        if(i[0]=="5A"){
            return true;
        } else {            
            var randomnumber=Math.floor((Math.random()*1000)+1);
            var text = mainMenu.getItemText(id);
            var textLength = text.length;
            if(parseInt(textLength) >= 12) {  
                var panjang = parseInt(textLength) * 9;
            } else {
                var panjang = 100;
            }
                        
            if(mainTab.getActiveTab()!=id){
                mainTab.addTab(id,text,panjang+"px");
                mainTab.setTabActive(id);
            }  
            
            mainTab.enableTabCloseButton(true);
            if(i[1]){
                mainTab.setContentHref(id,"<?php echo site_url(); ?>/"+i[1]);
            }
        }
    }
    
    function menuCheckboxClick(id, state){
        var i = id.split("|");
        if(i[0]=='5A' && state==true){
            contentLayout.cells('a').showHeader();	
            contentLayout.cells("a").collapse();
        } else {            
            contentLayout.cells("a").expand();
            //contentLayout.cells("a").setHeight(60);
        }
        return true;
    }
    
    function goLogout() {
        window.location = "<?php echo base_url(); ?>/main/logoutexit"; 
    }
    
    function removeTabLogout(){
        var a = mainTab.getActiveTab();
        var r = a.split("|");
        mainTab.removeTab(r[0]); 
        mainTab.setTabActive("a1");
    }
    
                                </script>
                            </body>
                            </html>