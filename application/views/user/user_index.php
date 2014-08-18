<?php

/*
 * user_index.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>


<!DOCTYPE HTML>
<html>
<head>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
</head>
    <body style="background-color: #CFE4FE;">
        <div id="" style="background-color: #CFE4FE; height: 100%">            
            <div id="objTb_s4" style="height: 30px;"></div>
            <div id="objGrid_s4" style="width:100%; height:500px; background-color: #CFE4FE;"></div>                                  
        </div>
        
        <div id="cover_s4" style='width:500px; font-size:20pt; text-align:center; font-family:Tahoma; position:absolute; top:150px; left:50px; height:150px; widht:600px; opacity:0.3; -moz-opacity:0.3; filter:alpha(opacity=30);'>
            <br />
            <br />
            <img src="<?php echo base_url(); ?>/images/loading.gif" />
        </div>

<script>
var base_url = "<?php echo base_url(); ?>";
//window.parent.progressOff();

//Top Nav
toolbar_s4 = new dhtmlXToolbarObject("objTb_s4");
toolbar_s4.setIconsPath(base_url+"/images/btn/");
toolbar_s4.addButton("new", 0, "New", "new.gif", "new_dis.gif");
toolbar_s4.addButton("edit", 2, "Edit", "edit.png", "edit_dis.png");
toolbar_s4.addButton("del", 4, "Delete", "delete.png", "dis_delete.png");
//toolbar_s4.addButton("search", 5, "Cari", "filter.png", "filter.png");
toolbar_s4.addButton("refresh", 6, "Refresh", "refresh.png", "refresh_dis.png");
toolbar_s4.addText("info", 10, "<b>PENGATURAN USER</b>")
toolbar_s4.attachEvent("onclick", tbClick_s4);
toolbar_s4.addSpacer("refresh");  

    function tbClick_s4(id){
        if(id=="new"){
            showForm_s4('new');
        }
        else if(id=="del"){
            var rId = grid_s4.getSelectedRowId();            
            if(rId==null){
                dhtmlx.alert("Pilih data yang akan di delete");
            } else {
                delete_s4(rId);
            }
        }
        else if(id=="edit"){
            var rId = grid_s4.getSelectedRowId();            
            if(rId==null){
                dhtmlx.alert("Pilih data yang akan di edit");
            } else {
//                showFormEdit_s4(rId);
                    showForm_s4('edit');
            }           
        }
        else if(id=="refresh"){
            loadGrid_s4();            
        }
        else if(id=="search"){
            alert("search");           
        }
    }
   
            

grid_s4 = new dhtmlXGridObject('objGrid_s4');
grid_s4.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
grid_s4.setHeader("&nbsp;,Username, Nama Lengkap, Email, Telp, Grup, Keterangan, Status",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
grid_s4.attachHeader("&nbsp;,#text_filter,#text_filter,#text_filter,#text_filter,#combo_filter,#text_filter,#combo_filter",["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
grid_s4.setInitWidths("30,150,250,150,150,150,*,120");
grid_s4.setColAlign("right,left,left,left,left,left,left,center");
grid_s4.setColTypes("cntr,ro,ro,ro,ro,ro,ro,ro");
grid_s4.setColSorting("na,str,str,str,str,str,str,str");
grid_s4.setColumnColor("#CCE2FE");
grid_s4.attachEvent("onRowDblClicked", actDblClicked);
grid_s4.attachFooter("Total Records : {#stat_count},#cspan,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;,&nbsp;",["text-align:left","text-align:right","text-align:right","text-align:right","text-align:right","text-align:right","text-align:right","text-align:right"]);
grid_s4.setSkin("dhx_skyblue");
grid_s4.enableSmartRendering(50, true);
grid_s4.init();
grid_s4.enableHeaderMenu();
grid_s4.enableDragAndDrop(true);
grid_s4.enableColumnMove(true);
loadGrid_s4();

function loadGrid_s4(){
grid_s4.clearAll();
grid_s4.loadXML(base_url+"index.php/user/loadData");    
}

function refreshGrid_s4() {
	grid_s4.updateFromXML(base_url+"index.php/user/loadData", function(){
//            grid_s4.groupBy(1);
        });
}

grid_s4.attachEvent("onXLS", function() {
    document.getElementById('cover_s4').style.display = 'block';
});
grid_s4.attachEvent("onXLE", function() {
    document.getElementById('cover_s4').style.display = 'none';
});
   
        
    function showForm_s4(type)
    {
        w1_s4 = dhxWins.createWindow("w1_s4", 0, 0, 500, 420);    
        w1_s4.button("park").hide();    
        w1_s4.button("minmax1").hide();
        w1_s4.setText("New User");           
        w1_s4.center();        
        w1_s4.denyResize(); 
//        w1_s4.show();       
        if(type=='new') {
            w1_s4.attachURL(base_url+"index.php/user/form", true);        
        } else {
            w1_s4.attachURL(base_url+"index.php/user/form_edit/"+grid_s4.getSelectedId(), true);        
        }
        
        w1_s4.setModal(true); 
        
        toolbar_w1_s4 = w1_s4.attachToolbar();
        toolbar_w1_s4.setIconsPath(base_url+"/images/btn/");    
        toolbar_w1_s4.addButton("new", 1, "New", "new.gif", "new_dis.gif");
        toolbar_w1_s4.addButton("save", 1, "Save", "save.gif", "save_dis.gif");
        toolbar_w1_s4.addButton("cancel", 2, "Cancel", "close.png", "close_dis.png");    
        toolbar_w1_s4.attachEvent("onclick", mbClick_s4); 
    }        
    
    function actDblClicked(){        
        showForm_s4('edit');
    }
    
    
    function closeForm(){
//        w1_s4.hide();
//         w1_s4.close();
         dhxWins.window("w1_s4").close();
//        w1_s4.setModal(false);
        dhxWins.window("w1_s4").setModal(false);
    }
    
           
    function mbClick_s4(id){
        if(id=="save"){
            save_s4();
        }
        else if(id=="cancel"){
            clearForm();
        } else if(id=="new"){
            clearForm();
            toolbar_w1_s4.enableItem("save");
        }        
    }
    
    function clearForm(){           
        document.getElementById("form_s4").reset();
        document.getElementById("username").focus();
    }
           
    function save_s4(){        
        if(document.form_s4.username.value==""){
            dhtmlx.alert("username tidak boleh kosong");
            return;
        }
        
        if(c1.getSelectedValue()==null){
            dhtmlx.alert("Grup Tidak boleh kosong");
            return;
        }
        
        if(c2.getSelectedValue()==null){
            dhtmlx.alert("Perusahaan Tidak boleh kosong");
            return;
        }
        
        if(document.form_s4.password_hide.value==""){
            if(document.form_s4.password.value==""){
                dhtmlx.alert("password tidak boleh kosong");
                return;
            }
            
            if(document.form_s4.password.value!=document.form_s4.conf_password.value){
                dhtmlx.alert("password tidak cocok dengan konfirmasi password");
                return;
            }
        }
                
        
        var postdata =
            'id='+document.form_s4.id.value+
            '&username='+document.form_s4.username.value+
            '&name='+document.form_s4.nama.value+
            '&group='+c1.getSelectedValue()+
            '&company='+c2.getSelectedValue()+
            '&email='+document.form_s4.email.value+
            '&phone='+document.form_s4.telp.value+
            '&notes='+document.form_s4.ket.value+
            '&password='+document.form_s4.password.value+
            '&password_hide='+document.form_s4.password_hide.value+
            '&status='+c3.getSelectedValue();
        statusLoading();
        dhtmlxAjax.post(base_url+"/index.php/user/save",encodeURI(postdata),function(loader){
            result = loader.xmlDoc.responseText;        
        if(result=="1"){    
            toolbar_w1_s4.disableItem("save");
            refreshGrid_s4();
            statusEnding();            
            dhtmlx.message("data user berhasil disimpan");
        } else if(result=="EXIST") {
            statusEnding();
            dhtmlx.message({
                type: "error",
                text: "data username sudah ada"                
            });
        } else {
            statusEnding();            
            dhtmlx.message({
                type: "error",
                text: "data user gagal disimpan"                
            });
        }
        });
    }
        
    
        function delete_s4(){
        var id = grid_s4.getSelectedRowId();
        var username = grid_s4.cells(id,1).getValue();
        dhtmlx.confirm({
            title:"Confirm",
            text:"Apakah anda yakin menghapus data user "+username+"?",
            callback:function(result){
                if(result==true){
                    var postStr =
                        "id=" + id+				                
                        statusLoading();
                    dhtmlxAjax.post(base_url+'/index.php/user/delete/'+id, postStr, function(loader) {
                        result = loader.xmlDoc.responseText;                        
                        if(result=='1'){                                    
                            loadGrid_s4();
                            statusEnding();
                            dhtmlx.message("data berhasil didelete");                    
                        } else {
                            statusEnding();                            
                            dhtmlx.message({
                                type: "error",
                                text: "Data error on delete"                
                            });
                        }
                    });
                }
            }
        });
        
    }  
    
       

</script>

</body>
</html>