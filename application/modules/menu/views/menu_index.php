<?php

/*
 * menu_index.php
 * 
 * Copyright (c) 2013 
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
            <div id="objTb_s1a" style="height: 30px;"></div>
            <div id="objGrid_s1a" style="width:100%; height:500px; background-color: #CFE4FE;"></div>
            
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

dhxWins_s1a = new dhtmlXWindows();
//dhxWins_s1a.setImagePath(base_url+"/assets/codebase_windows/imgs/");
    
//Top Nav
tb_s1a = new dhtmlXToolbarObject("objTb_s1a");
tb_s1a.setIconsPath(base_url+"/images/btn/");
tb_s1a.addButton("new", 0, "New", "new.gif", "new_dis.gif");
tb_s1a.addSeparator("sep1", 1);
tb_s1a.addButton("edit", 2, "Edit", "edit.png", "edit_dis.png");
tb_s1a.addSeparator("sep1", 3);
tb_s1a.addButton("del", 4, "Delete", "delete.png", "dis_delete.png");
tb_s1a.addSeparator("sep1", 5);
tb_s1a.addButton("refresh", 6, "Refresh", "refresh.png", "refresh_dis.png");
tb_s1a.addText("info", 10, "<b>LANGUAGES</b>")
tb_s1a.attachEvent("onclick", tbClick_s1a);
tb_s1a.addSpacer("refresh");     

    function tbClick_s1a(id){
        if(id=="new"){
            showForm();
        }
        else if(id=="del"){
            var rId = grid_s1a.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be deleted");
            } else {
                hapus(rId);
            }
        }
        else if(id=="edit"){
            var rId = grid_s1a.getSelectedRowId();            
            if(rId==null){
                alert("select the data to be edited");
            } else {
                edit(rId);
            }           
        }
        else if(id=="refresh"){
            loadGrid_s1a();            
        }
    }

    function hapus(){
        grid_s1a.deleteSelectedRows();
    }

grid_s1a = new dhtmlXGridObject('objGrid_s1a');
grid_s1a.setImagePath("<?php echo base_url(); ?>/assets/codebase_grid/imgs/");
grid_s1a.setHeader("&nbsp;,Menu Id,Menu Name",null,["text-align:center","text-align:center","text-align:center"]);
grid_s1a.attachHeader("&nbsp;,#text_filter,#text_filter");
grid_s1a.setInitWidths("30,100,150");
grid_s1a.setColAlign("center,left,center");
grid_s1a.setColTypes("cntr,ro,ro");
grid_s1a.setColSorting("na,str,str");
grid_s1a.setColumnColor("#CCE2FE");
grid_s1a.attachEvent("onBeforeRowDeleted", doBeforeRowDeleted);
grid_s1a.attachFooter("Total Records,#cspan,#stat_count,&nbsp;,&nbsp;,&nbsp;",["text-align:left","text-align:right","text-align:right"]);
grid_s1a.setSkin("dhx_skyblue");
grid_s1a.init();
loadGrid_s1a();

function loadGrid_s1a(){
grid_s1a.clearAll();
grid_s1a.loadXML(base_url+"index.php/menu/loadMainData");    
}

var mdp_s1a = new dataProcessor("<?php echo base_url()."/index.php/bank/crudBank" ?>");
mdp_s1a.init(grid_s1a);

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
    var id=grid_s1a.uid();
    grid_s1a.addRow(id,['-','-','-',''],0);
    grid_s1a.showRow(id);
}



// form window
    w1_s1a = dhxWins_s1a.createWindow("w1_s1a", 0, 0, 500, 280);    
    w1_s1a.button("park").hide();    
    w1_s1a.button("minmax1").hide();
    w1_s1a.attachEvent("onClose", closeForm);
    w1_s1a.hide();
    
    function showForm()
    {
//        clearForm();
        w1_s1a.show();
        w1_s1a.setText("Form Bank");
//        w1_s1a.setModal(true);
        w1_s1a.center();
        //        w1_s1a.clearIcon();
        w1_s1a.denyResize();        
        w1_s1a.attachObject("objForm");        
    }
    
    function closeForm(){
        w1_s1a.hide();
//        w1_s1a.setModal(false);
    }
    
    tb_w1_s1a = w1_s1a.attachToolbar();
    tb_w1_s1a.setIconsPath(base_url+"/images/btn/");
    tb_w1_s1a.addButton("new", 0, "New", "add.png", "add_dis.png");
    tb_w1_s1a.addButton("save_s1a", 1, "Save", "save_s1a.gif", "save_s1a_dis.gif");
    tb_w1_s1a.addButton("cancel", 3, "Cancel", "close.png", "close_dis.png");    
    tb_w1_s1a.attachEvent("onclick", mbClick_s1a);     
    
    function mbClick_s1a(id){
        if(id=="save_s1a"){
            save_s1a();
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
           
    function save_s1a(){
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
        dhtmlxAjax.post(base_url+"/index.php/bank/simpan_bank",encodeURI(postdata),function(loader){
            result = loader.xmlDoc.responseText;        
        if(result=="1"){
            statusEnding();
            loadGrid_s1a();
            alert("data berhasil disimpan");
        } else {
            statusEnding();
            alert("data gagal disimpan");
        }
        });
    }
        
    
        function hapus(){
        var id = grid_s1a.getSelectedRowId();
        cnf = confirm("Are you sure ?")
        if(cnf) {
            var postStr =
                "id=" + id+				                
            statusLoading();
            dhtmlxAjax.post(base_url+'/index.php/bank/del_bank', postStr, function(loader) {
                result = loader.xmlDoc.responseText;
                if(result=='1'){                                    
                    grid_s1a.clearAll();
                    loadGrid_s1a();
                    statusEnding();
                    alert("data berhasil dihapus");                    
                } else {
                    statusEnding();
                    alert("Data error on save_s1a");
                }
            });
        }
    }  
    
    function edit(id){
        showForm();
        document.formData.nama_bank.value = grid_s1a.cells(id,0).getValue();
        document.formData.no_rek.value = grid_s1a.cells(id,1).getValue();
        document.formData.cabang.value = grid_s1a.cells(id,2).getValue();
        document.formData.perusahaan.value = grid_s1a.cells(id,8).getValue();
        document.formData.no_akun.value = grid_s1a.cells(id,5).getValue();
        document.formData.status.value = grid_s1a.cells(id,9).getValue();
        document.formData.id.value = id;
    }

</script>
