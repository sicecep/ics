<?php

/*
 * v_language.php
 * 
 * Copyright (c) 2013 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
<script>
    function modeAwal(){}
</script>

</head>
    <body style="background-color: #CFE4FE;">
        <div id="" style="background-color: #CFE4FE; height: 100%">            
            <div id="topnav" style="height: 30px;"></div>
            <div id="gridbox" style="width:100%; height:500px; background-color: #CFE4FE;"></div>
            
            <div id="objForm" style="display:none;overflow:hidden;width:auto;height:auto;padding:10px;background:#CFE4FE;">            
                <form action="javascript:void(0);" id="formData" name="formData" method="post">
                    <table width="500" border="0">                                     
                        <tr>
                            <td>Nama Bank</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="nama_bank" id="nama_bank" size="30" />
                            </td>                        
                        </tr>
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_rek" id="no_rek" size="30" />
                            </td> 
                        </tr>
                        <tr>                        
                            <td>Cabang</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="cabang" id="cabang" size="30" />
                            </td>
                        </tr>
                        <tr>
                            <td>Perusahaan</td>
                            <td>:</td>
                            <td>
                                <select id="perusahaan" name="perusahaan" style="width: 220px;">
                                    <option value="">&nbsp;</option>
                                    <?php
                                    foreach ($company as $c) {
                                        echo "<option value='" . $c->company_id . "'>" . $c->nama_perusahaan . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Nomor Akun</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_akun" id="no_akun" size="30" readonly />
                                <input type="button" value="..." id="cari_akun" name="cari_akun" size="5" onclick="showWinCoa()" />                            
                            </td>                        
                        </tr>    
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <select id="status" name="status" style="width: 100px;">
                                    <option value="1">AKTIF</option>
                                    <option value="0">NON-AKTIF</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="id" id="id" />                            
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            
        </div>
</body>
</html>

<script>
var base_url = "<?php echo base_url(); ?>";
window.parent.progressOff();

dhxWins = new dhtmlXWindows();
//dhxWins.setImagePath(base_url+"/assets/codebase_windows/imgs/");
    
//Top Nav
topnav = new dhtmlXToolbarObject("topnav");
topnav.setIconsPath(base_url+"/images/btn/");
topnav.addButton("new", 0, "New", "new.gif", "new_dis.gif");
topnav.addSeparator("sep1", 1);
topnav.addButton("edit", 2, "Edit", "edit.png", "edit_dis.png");
topnav.addSeparator("sep1", 3);
topnav.addButton("del", 4, "Delete", "delete.png", "dis_delete.png");
topnav.addSeparator("sep1", 5);
topnav.addButton("refresh", 6, "Refresh", "refresh.png", "refresh_dis.png");
topnav.addText("info", 10, "<b>LANGUAGES</b>")
topnav.attachEvent("onclick", doTopClick);
topnav.addSpacer("refresh");     

    function doTopClick(id){
        if(id=="new"){
            showForm();
        }
        else if(id=="del"){
            var rId = mygrid.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be deleted");
            } else {
                hapus(rId);
            }
        }
        else if(id=="edit"){
            var rId = mygrid.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be edited");
            } else {
                edit(rId);
            }           
        }
        else if(id=="refresh"){
            loadData();            
        }
    }

    function hapus(){
        mygrid.deleteSelectedRows();
    }

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
mygrid.setHeader("Nama Bank,No Rekening,Cabang,Status,Perusahaan,No Akun,Kode Form,Default,perusahaanID,StatusID",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
mygrid.attachHeader("#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter");
mygrid.setInitWidths("100,150,150,100,200,250,100,100,100,100");
mygrid.setColAlign("left,center,left,center,left,center,center,center,center,center");
mygrid.setColTypes("ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
mygrid.setColSorting("str,str,str,str,str,str,int,str,str,str");
mygrid.attachEvent("onBeforeRowDeleted", doBeforeRowDeleted);
mygrid.attachFooter("Total Records,#cspan,#stat_count,&nbsp;,&nbsp;,&nbsp;",["text-align:left","text-align:right","text-align:right"]);
mygrid.setSkin("dhx_skyblue");
mygrid.setColumnHidden(6, true);
mygrid.setColumnHidden(7, true);
mygrid.setColumnHidden(8, true);
mygrid.setColumnHidden(9, true);
mygrid.init();
//loadData();
//combo = mygrid.getColumnCombo(5);
//combo.loadXML("<?php // echo base_url(). "/index.php/bank/load_coa" ?>");
//combo2 = mygrid.getColumnCombo(4);
//combo2.loadXML("<?php // echo base_url(). "/index.php/bank/load_company" ?>");

function loadData(){
mygrid.clearAll();
mygrid.loadXML("<?php echo base_url(). "/index.php/bank/crudBank" ?>");    
}

var myDataProcessor = new dataProcessor("<?php echo base_url()."/index.php/bank/crudBank" ?>");
myDataProcessor.init(mygrid);

function doBeforeRowDeleted(rowID){
    if(confirm("Apakah anda yakin akan menghapus data ini?"))
        {
            window.parent.progressOff();
            alert("Data berhasil dihapus");
            modeAwal();
        }
        else
            {
                return false;
            }
}

function addRow()
{
    var id=mygrid.uid();
    mygrid.addRow(id,['-','-','-',''],0);
    mygrid.showRow(id);
}



// form window
    winForm = dhxWins.createWindow("winForm", 0, 0, 500, 280);    
    winForm.button("park").hide();    
    winForm.button("minmax1").hide();
    winForm.attachEvent("onClose", closeForm);
    winForm.hide();
    
    function showForm()
    {
//        clearForm();
        winForm.show();
        winForm.setText("Form Bank");
//        winForm.setModal(true);
        winForm.center();
        //        winForm.clearIcon();
        winForm.denyResize();        
        winForm.attachObject("objForm");        
    }
    
    function closeForm(){
        winForm.hide();
//        winForm.setModal(false);
    }
    
    menubar = winForm.attachToolbar();
    menubar.setIconsPath(base_url+"/images/btn/");
    menubar.addButton("new", 0, "New", "add.png", "add_dis.png");
    menubar.addButton("save", 1, "Save", "save.gif", "save_dis.gif");
    menubar.addButton("cancel", 3, "Cancel", "close.png", "close_dis.png");    
    menubar.attachEvent("onclick", menubarClick);     
    
    function menubarClick(id){
        if(id=="save"){
            save();
        }
        else if(id=="cancel"){
            closeForm();
        }
        else if(id=="new"){
            clearForm();
        }
    }
    
    function clearForm(){
        document.formData.nama_bank.value = "";
        document.formData.no_rek.value = "";
        document.formData.cabang.value = "";
        document.formData.perusahaan.value = "";
        document.formData.no_akun.value = "";
        document.formData.status.value = "";
        document.formData.id.value = "";
    }
    
    
        // window coa
    winCoa = dhxWins.createWindow("winCoa", 0, 0, 420, 500);    
    winCoa.setText("Data COA");
    winCoa.button("park").hide();    
    winCoa.button("minmax1").hide();
    winCoa.denyResize();  
    winCoa.center(); 
    winCoa.attachEvent("onClose", closeWinCoa);

    function closeWinCoa(){
        winCoa.hide();
        winCoa.setModal(false);
    }

    function showWinCoa()
    {        
        winCoa.show();        
        winCoa.setModal(true);                    
    }

    gridCoa = dhxWins.window("winCoa").attachGrid();
    gridCoa.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
    gridCoa.setHeader("No Akun,Nama Akun",null,["text-align:center","text-align:center","text-align:center"]);
    gridCoa.attachHeader("#text_filter,#text_filter");
    gridCoa.setInitWidths("120,250");
    gridCoa.setColAlign("center,left");
    gridCoa.setColTypes("ro,ro");
    gridCoa.setColSorting("str,str");
    gridCoa.setSkin("dhx_skyblue");
    gridCoa.attachEvent("onRowDblClicked", clickGridCoa);
    gridCoa.init();
    winCoa.hide();
//    loadDataCoa();
    
    function loadDataCoa(){
        gridCoa.clearAll();
        gridCoa.loadXML("<?php echo base_url() . "/index.php/bank/load_coa_bank" ?>");    
    }
    
    function clickGridCoa(id){
        document.formData.no_akun.value = id;
        closeWinCoa();
    }
    
    function save(){
        if(document.formData.nama_bank.value==""){
            alert("nama bank tidak boleh kosong");
            return;
        }
        if(document.formData.no_rek.value==""){
            alert("nomor rekening tidak boleh kosong");
            return;
        }
        if(document.formData.no_akun.value==""){
            alert("nomor akun tidak boleh kosong");
            return;
        }
        if(document.formData.perusahaan.value==""){
            alert("perusahaan tidak boleh kosong");
            return;
        }
        var postdata =
            'id='+document.formData.id.value+
            '&nama_bank='+document.formData.nama_bank.value+
            '&no_rek='+document.formData.no_rek.value+
            '&cabang='+document.formData.cabang.value+
            '&perusahaan='+document.formData.perusahaan.value+
            '&no_akun='+document.formData.no_akun.value+
            '&status='+document.formData.status.value;
        statusLoading();
        dhtmlxAjax.post(base_url+"/index.php/bank/simpan_bank",encodeURI(postdata),responseData);
    }
    
    function responseData(loader){
        result = loader.xmlDoc.responseText;        
        if(result=="1"){
            statusEnding();
            loadData();
            alert("data berhasil disimpan");
        } else {
            statusEnding();
            alert("data gagal disimpan");
        }
    }
    
        function hapus(){
        var id = mygrid.getSelectedRowId();
        cnf = confirm("Are you sure ?")
        if(cnf) {
            var postStr =
                "id=" + id+				                
            statusLoading();
            dhtmlxAjax.post(base_url+'/index.php/bank/del_bank', postStr, function(loader) {
                result = loader.xmlDoc.responseText;
                if(result=='1'){                                    
                    mygrid.clearAll();
                    loadData();
                    statusEnding();
                    alert("data berhasil dihapus");                    
                } else {
                    statusEnding();
                    alert("Data error on save");
                }
            });
        }
    }  
    
    function edit(id){
        showForm();
        document.formData.nama_bank.value = mygrid.cells(id,0).getValue();
        document.formData.no_rek.value = mygrid.cells(id,1).getValue();
        document.formData.cabang.value = mygrid.cells(id,2).getValue();
        document.formData.perusahaan.value = mygrid.cells(id,8).getValue();
        document.formData.no_akun.value = mygrid.cells(id,5).getValue();
        document.formData.status.value = mygrid.cells(id,9).getValue();
        document.formData.id.value = id;
    }

</script>
