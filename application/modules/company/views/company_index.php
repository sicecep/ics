<?php

/*
 * company_index.php
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
   
<script>
    function modeAwal(){}
</script>

</head>
    <body style="background-color: #CFE4FE;">
        <div id="" style="background-color: #CFE4FE; height: 100%">            
            <div id="objTb_m2" style="height: 30px;"></div>
            <div id="objGrid_m2" style="width:100%; height:500px; background-color: #CFE4FE;"></div>            
            <div id="objForm" style="display:none;overflow:hidden;width:auto;height:auto;padding:10px;background:#CFE4FE;">            
                
            </div>            
        </div>
</body>
</html>

<script>
var base_url = "<?php echo base_url(); ?>";
//window.parent.progressOff();

dhxWins_m2 = new dhtmlXWindows();
//dhxWins_m2.setImagePath(base_url+"/assets/codebase_windows/imgs/");
    
//Top Nav
toolbar_m2 = new dhtmlXToolbarObject("objTb_m2");
toolbar_m2.setIconsPath(base_url+"/images/btn/");
toolbar_m2.addButton("new", 0, "New", "new.gif", "new_dis.gif");
toolbar_m2.addSeparator("sep1", 1);
toolbar_m2.addButton("edit", 2, "Edit", "edit.png", "edit_dis.png");
toolbar_m2.addSeparator("sep1", 3);
toolbar_m2.addButton("del", 4, "Delete", "delete.png", "dis_delete.png");
toolbar_m2.addSeparator("sep1", 5);
toolbar_m2.addButton("refresh", 6, "Refresh", "refresh.png", "refresh_dis.png");
toolbar_m2.addText("info", 10, "<b>PERUSAHAAN</b>")
toolbar_m2.attachEvent("onclick", tbClick_m2);
toolbar_m2.addSpacer("refresh");     

    function tbClick_m2(id){
        if(id=="new"){
            showForm();
        }
        else if(id=="del"){
            var rId = grid_m2.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be deleted");
            } else {
                delete_m2(rId);
            }
        }
        else if(id=="edit"){
            var rId = grid_m2.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be edited");
            } else {
                edit(rId);
            }           
        }
        else if(id=="refresh"){
            loadGrid_m2();            
        }
    }

    function delete_m2(){
        grid_m2.deleteSelectedRows();
    }

grid_m2 = new dhtmlXGridObject('objGrid_m2');
grid_m2.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
grid_m2.setHeader("&nbsp;,Menu Id,Menu Name",null,["text-align:center","text-align:center","text-align:center"]);
grid_m2.attachHeader("&nbsp;,#text_filter,#text_filter");
grid_m2.setInitWidths("30,100,150");
grid_m2.setColAlign("center,left,center");
grid_m2.setColTypes("cntr,ro,ro");
grid_m2.setColSorting("na,str,str");
grid_m2.setColumnColor("#CCE2FE");
grid_m2.attachEvent("onBeforeRowDeleted", doBeforeRowDeleted);
grid_m2.attachFooter("Total Records,#cspan,#stat_count,&nbsp;,&nbsp;,&nbsp;",["text-align:left","text-align:right","text-align:right"]);
grid_m2.setSkin("dhx_skyblue");
grid_m2.init();
loadGrid_m2();

function loadGrid_m2(){
grid_m2.clearAll();
grid_m2.loadXML(base_url+"index.php/company/loadMainData");    
}


function doBeforeRowDeleted(rowID){
    if(confirm("Apakah anda yakin akan mengdelete_m2 data ini?"))
        {
            window.parent.progressOff();
            alert("Data berhasil didelete_m2");
            modeAwal();
        }
        else
            {
                return false;
            }
}

function addRow()
{
    var id=grid_m2.uid();
    grid_m2.addRow(id,['-','-','-',''],0);
    grid_m2.showRow(id);
}



// form window
    w1_m2 = dhxWins_m2.createWindow("w1_m2", 0, 0, 500, 280);    
    w1_m2.button("park").hide();    
    w1_m2.button("minmax1").hide();
    w1_m2.attachEvent("onClose", closeForm);
    w1_m2.hide();
    
    function showForm()
    {
//        clearForm();
        w1_m2.show();
        w1_m2.setText("Form Bank");
//        w1_m2.setModal(true);
        w1_m2.center();
        //        w1_m2.clearIcon();
        w1_m2.denyResize();        
        w1_m2.attachObject("objForm");        
    }
    
    function closeForm(){
        w1_m2.hide();
//        w1_m2.setModal(false);
    }
    
    toolbar_w1_m2 = w1_m2.attachToolbar();
    toolbar_w1_m2.setIconsPath(base_url+"/images/btn/");
    toolbar_w1_m2.addButton("new", 0, "New", "add.png", "add_dis.png");
    toolbar_w1_m2.addButton("save_m2", 1, "Save", "save_m2.gif", "save_m2_dis.gif");
    toolbar_w1_m2.addButton("cancel", 3, "Cancel", "close.png", "close_dis.png");    
    toolbar_w1_m2.attachEvent("onclick", mbClick_m2);     
    
    function mbClick_m2(id){
        if(id=="save_m2"){
            save_m2();
        }
        else if(id=="cancel"){
            closeForm();
        }
        else if(id=="new"){
            clearForm();
        }
    }
    
    function clearForm(){
        document.form_m2.nama_bank.value = "";
        document.form_m2.no_rek.value = "";
        document.form_m2.cabang.value = "";
        document.form_m2.perusahaan.value = "";
        document.form_m2.no_akun.value = "";
        document.form_m2.status.value = "";
        document.form_m2.id.value = "";
    }
           
    function save_m2(){
        if(document.form_m2.nama_bank.value==""){
            alert("nama bank tidak boleh kosong");
            return;
        }
        if(document.form_m2.no_rek.value==""){
            alert("nomor rekening tidak boleh kosong");
            return;
        }
        if(document.form_m2.no_akun.value==""){
            alert("nomor akun tidak boleh kosong");
            return;
        }
        if(document.form_m2.perusahaan.value==""){
            alert("perusahaan tidak boleh kosong");
            return;
        }
        var postdata =
            'id='+document.form_m2.id.value+
            '&nama_bank='+document.form_m2.nama_bank.value+
            '&no_rek='+document.form_m2.no_rek.value+
            '&cabang='+document.form_m2.cabang.value+
            '&perusahaan='+document.form_m2.perusahaan.value+
            '&no_akun='+document.form_m2.no_akun.value+
            '&status='+document.form_m2.status.value;
        statusLoading();
        dhtmlxAjax.post(base_url+"/index.php/bank/simpan_bank",encodeURI(postdata),function(loader){
            result = loader.xmlDoc.responseText;        
        if(result=="1"){
            statusEnding();
            loadGrid_m2();
            alert("data berhasil disimpan");
        } else {
            statusEnding();
            alert("data gagal disimpan");
        }
        });
    }
        
    
        function delete_m2(){
        var id = grid_m2.getSelectedRowId();
        cnf = confirm("Are you sure ?")
        if(cnf) {
            var postStr =
                "id=" + id+				                
            statusLoading();
            dhtmlxAjax.post(base_url+'/index.php/bank/del_bank', postStr, function(loader) {
                result = loader.xmlDoc.responseText;
                if(result=='1'){                                    
                    grid_m2.clearAll();
                    loadGrid_m2();
                    statusEnding();
                    alert("data berhasil didelete_m2");                    
                } else {
                    statusEnding();
                    alert("Data error on save_m2");
                }
            });
        }
    }  
    
    function edit(id){
        showForm();
        document.form_m2.nama_bank.value = grid_m2.cells(id,0).getValue();
        document.form_m2.no_rek.value = grid_m2.cells(id,1).getValue();
        document.form_m2.cabang.value = grid_m2.cells(id,2).getValue();
        document.form_m2.perusahaan.value = grid_m2.cells(id,8).getValue();
        document.form_m2.no_akun.value = grid_m2.cells(id,5).getValue();
        document.form_m2.status.value = grid_m2.cells(id,9).getValue();
        document.form_m2.id.value = id;
    }

</script>
