<?php
/*
 * main.php
 * 
 * Copyright (c) 2013 
 * 
 * Created By  : Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 * Modified By : -
 * 
 * Created     :  20.08.2013
 *
 * Description :  As a layout application
 * 
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url().'imgs/favicon.ico' ?>"/>
        <!-- Ajax -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dhtmlx.css" />
        <script src="<?php echo base_url(); ?>assets/dhtmlx.js"></script>        
        
        <!--jquery-->
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.price_format.js"></script>         

        <!-- Custom Scroll -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/custom_scroll/customscroll.css" />
        <script  src="<?php echo base_url(); ?>assets/custom_scroll/customscroll.js"></script>
        
        <!-- Modal -->
        <link href="<?php echo base_url();?>assets/modal/SyntaxHighlighter.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shCore.js" language="javascript"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/modal/shBrushJScript.js" language="javascript"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/modal/ModalPopups.js" language="javascript"></script>
       
        <link href="<?php echo base_url(); ?>css/style_doc.css" rel="stylesheet" type="text/css" />        

        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
                overflow: hidden;
                background-color: #ebebeb;
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
                var currentTime = new Date()
                var month = currentTime.getMonth() + 1;
                var day = currentTime.getDate();
                var year = currentTime.getFullYear();
                
                layout = new dhtmlXLayoutObject(document.body, "1C");
                layout.setSkin("dhx_skyblue");
                layout.cells("a").hideHeader();
    
    var menu = layout.cells("a").attachMenu(); 
    menu.setSkin("dhx_skyblue");
    menu.setTopText("eSHa Framework V.1.0");   
    menu.setIconsPath(base_url+"/images/menu/");  
    menu.loadXML(base_url+"/main/main_menu");
    menu.attachEvent("onClick", menuClick);
    menu.attachEvent("onCheckboxClick", menuCheckboxClick);
    
        function menuClick(id){
            var i = id.split("|");
            if(i[0]=="5A"){
                return true;
            } else {            
                var randomnumber=Math.floor((Math.random()*1000)+1);
                var text = menu.getItemText(id);
                var textLength = text.length;
                if(parseInt(textLength) >= 12) {  
                    var panjang = parseInt(textLength) * 9;
                } else {
                    var panjang = 100;
                }
                tab.addTab(randomnumber,text, panjang+"px");
                tab.setTabActive(randomnumber);
                tab.enableTabCloseButton(true);
                if(i[1]){
                    tab.setContentHref(randomnumber,base_url+"/"+i[1]);
                }
            }
        }
        
        function menuCheckboxClick(id, state){
        var i = id.split("|");
        if(i[0]=='5A' && state==true){
            layoutdb.cells('a').showHeader();	
            layoutdb.cells("a").collapse();
        } else {            
            layoutdb.cells("a").expand();
            //layoutdb.cells("a").setHeight(60);
        }
            return true;
        }
        
    layoutdb = new dhtmlXLayoutObject(layout.cells("a"), "2E");    
    layoutdb.setSkin("dhx_skyblue");
    layoutdb.cells("a").hideHeader();
    layoutdb.cells("a").setHeight(42);        
    layoutdb.cells("b").hideHeader();  
    layoutdb.cells("a").setText(" ");
    layoutdb.setEffect("collapse", true);
    layoutdb.attachEvent("onExpand",function(id){
        layoutdb.cells("a").hideHeader();
        menu.setCheckboxState("toolbar",true);
    });
    layoutdb.setCollapsedText("a", "Toolbar Menu");
    layoutdb.cells("a").fixSize(true, true);    
    layoutdb.cells("a").attachObject("content");
    
    var toolbar = new dhtmlXToolbarObject("toolbarObj", "dhx_skyblue");
    loadToolbar(32);
    toolbar.addButton("dashboard", 0, "Dashboard", "open.gif");    
    toolbar.addSeparator("sep1", 1);
    toolbar.addButton("open", 2, "Open", "open.gif");
    toolbar.addSeparator("sep1", 3);
    toolbar.addButton("save", 4, "Save", "open.gif");
    toolbar.addSeparator("sep1", 5);
    toolbar.addButton("save", 6, "Redo", "open.gif");
    toolbar.addSeparator("sep1", 7);
    toolbar.addButton("save", 8, "Undo", "open.gif");
    toolbar.addSeparator("sep1", 9);
    toolbar.addButton("save", 10, "Cut", "open.gif");
    toolbar.addSeparator("sep1", 11);
    toolbar.addButton("save", 12, "Copy", "open.gif");
    toolbar.addSeparator("sep1", 13);
    toolbar.addButton("save", 14, "Paste", "open.gif");
    toolbar.addSeparator("sep1", 15);
    toolbar.addButton("save", 16, "Menu1", "open.gif");
    toolbar.addSeparator("sep1", 17);
    toolbar.addButton("save", 18, "Menu2", "open.gif");
    toolbar.addSeparator("sep1", 19);
    toolbar.addButton("save", 20, "Menu3", "open.gif");
    toolbar.addSeparator("sep1", 21);
    toolbar.addButton("save", 22, "Menu4", "open.gif");
    toolbar.addSeparator("sep1", 23);
    
    
//    toolbar.clearAll();
//    toolbar.loadXML(base_url+"/main/toolbar/",function() {
//        
//    });
//    toolbar.attachEvent("onclick", doToolbarClick);
    
    function doToolbarClick(id){ 
        var o = id.split("|");
        var text = toolbar.getItemText(id);        
        bukaTab(o[0],text,o[1]);
    }
    
    
    function loadToolbar(a) {
        toolbar.clearAll();
        toolbar.setIconSize(a);        
        toolbar.setIconsPath(base_url+"/images/toolbar/" + a + "/");                 
    }

    var tab = layoutdb.cells("b").attachTabbar();
    tab.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
    tab.setSkin("dhx_skyblue");    
    tab.setHrefMode("ajax-html");
    tab.addTab("s1", "DASHBOARD", 120);          

    tab.setTabActive("s1");    
    tab.enableTabCloseButton(true);
    
    function openTab(id,text,url){                
        var textLength = text.length;
        
        if(parseInt(textLength) >= 12) {  
            var panjang = parseInt(textLength) * 10;
        } else {
            var panjang = 100;
        }
        tab.setTabActive(id);
       
        if(tab.getActiveTab()!=id){
            tab.addTab(id,text,panjang+"px");
            tab.setTabActive(id);
        }        
        
        tab.setContentHref(id,"<?php echo base_url(); ?>/"+url);
    }
    
    statusBar = layout.attachStatusBar();
    statusBar.setText("<div id='statusbar'><div style='float:left;font-weight:bold;'><?php echo 'User : '.$this->session->userdata('esha_username').' | Grup : '.$this->session->userdata('esha_group_id'); ?></div><div style='text-align:right;'><b> COPYRIGHT &copy; 2013 Sepry Haryandi</b></div></div>");
    
</script>    
</body>
</html>

