<?php

/*
 * group.php
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
            <div id="objTb_s5" style="height: 30px;"></div>
            <div id="objGrid_s5" style="width:100%; height:500px; background-color: #CFE4FE;"></div>                                  
        </div>
        
        <div id="cover_s5" style='width:500px; font-size:20pt; text-align:center; font-family:Tahoma; position:absolute; top:150px; left:50px; height:150px; widht:600px; opacity:0.3; -moz-opacity:0.3; filter:alpha(opacity=30);'>
            <br />
            <br />
            <img src="<?php echo base_url(); ?>/images/loading.gif" />
        </div>

<script>
var base_url = "<?php echo base_url(); ?>";
//window.parent.progressOff();

//Top Nav
toolbar_s5 = new dhtmlXToolbarObject("objTb_s5");
toolbar_s5.setIconsPath(base_url+"/images/btn/");
toolbar_s5.addButton("new", 0, "New", "new.gif", "new_dis.gif");
toolbar_s5.addButton("edit", 2, "Edit", "edit.png", "edit_dis.png");
toolbar_s5.addButton("del", 4, "Delete", "delete.png", "dis_delete.png");
//toolbar_s5.addButton("search", 5, "Cari", "filter.png", "filter.png");
toolbar_s5.addButton("refresh", 6, "Refresh", "refresh.png", "refresh_dis.png");
toolbar_s5.addText("info", 10, "<b>GROUP USER</b>")
toolbar_s5.attachEvent("onclick", tbClick_s5);
toolbar_s5.addSpacer("refresh");  

    function tbClick_s5(id){
        if(id=="new"){
            showForm_s5('new');
        }
        else if(id=="del"){
            var rId = grid_s5.getSelectedRowId();            
            if(rId==null){
                dhtmlx.alert("Pilih data yang akan di delete");
            } else {
                delete_s5(rId);
            }
        }
        else if(id=="edit"){
            var rId = grid_s5.getSelectedRowId();            
            if(rId==null){
                dhtmlx.alert("Pilih data yang akan di edit");
            } else {
//                showFormEdit_s5(rId);
                    showForm_s5('edit');
            }           
        }
        else if(id=="refresh"){
            loadGrid_s5();            
        }
        else if(id=="search"){
            alert("search");           
        }
    }
   
            

grid_s5 = new dhtmlXGridObject('objGrid_s5');
grid_s5.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
grid_s5.setHeader("&nbsp;,Group, Keterangan, Tgl Dibuat, Dibuat Oleh",null,["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
grid_s5.attachHeader("&nbsp;,#text_filter,#text_filter,#text_filter,#text_filter",["text-align:center","text-align:center","text-align:center","text-align:center","text-align:center"]);
grid_s5.setInitWidths("30,150,250,150,150");
grid_s5.setColAlign("right,left,left,center,left");
grid_s5.setColTypes("cntr,ro,ro,ro,ro");
grid_s5.setColSorting("na,str,str,str,str");
grid_s5.setColumnColor("#CCE2FE");
grid_s5.attachEvent("onRowDblClicked", actDblClicked);
grid_s5.attachFooter("Total Records : {#stat_count},#cspan,&nbsp;,&nbsp;,&nbsp;",["text-align:left","text-align:right","text-align:right","text-align:right"]);
grid_s5.setSkin("dhx_skyblue");
//grid_s5.enableSmartRendering(50, true);
grid_s5.init();
grid_s5.enableHeaderMenu();
grid_s5.enableDragAndDrop(true);
grid_s5.enableColumnMove(true);
loadGrid_s5();

function loadGrid_s5(){
grid_s5.clearAll();
grid_s5.loadXML(base_url+"index.php/group/loadData");    
}

function refreshGrid_s5() {
	grid_s5.updateFromXML(base_url+"index.php/group/loadData", function(){
//            grid_s5.groupBy(1);
        });
}

grid_s5.attachEvent("onXLS", function() {
    document.getElementById('cover_s5').style.display = 'block';
});
grid_s5.attachEvent("onXLE", function() {
    document.getElementById('cover_s5').style.display = 'none';
});
   
        
    function showForm_s5(type)
    {
        w1_s5 = dhxWins.createWindow("w1_s5", 0, 0, 750, 500);    
        w1_s5.button("park").hide();    
        w1_s5.button("minmax1").hide();
        w1_s5.setText("New Group");           
        w1_s5.center();        
        w1_s5.denyResize(); 
//        w1_s5.show();       
        if(type=='new') {
            w1_s5.attachURL(base_url+"index.php/group/form", true);        
        } else {
            w1_s5.attachURL(base_url+"index.php/group/form_edit/"+grid_s5.getSelectedId(), true);        
        }
        
        w1_s5.setModal(true); 
        
        toolbar_w1_s5 = w1_s5.attachToolbar();
        toolbar_w1_s5.setIconsPath(base_url+"/images/btn/");    
        toolbar_w1_s5.addButton("new", 1, "New", "new.gif", "new_dis.gif");
        toolbar_w1_s5.addButton("save", 1, "Save", "save.gif", "save_dis.gif");
        toolbar_w1_s5.addButton("cancel", 2, "Cancel", "close.png", "close_dis.png");    
        toolbar_w1_s5.attachEvent("onclick", mbClick_s5); 
    }        
    
    function actDblClicked(){        
        showForm_s5('edit');
    }
    
    
    function closeForm(){
//        w1_s5.hide();
//         w1_s5.close();
         dhxWins.window("w1_s5").close();
//        w1_s5.setModal(false);
        dhxWins.window("w1_s5").setModal(false);
    }
    
           
    function mbClick_s5(id){
        if(id=="save"){
            save_s5();
        }
        else if(id=="cancel"){
            clearForm();
        } else if(id=="new"){
            newForm();
            toolbar_w1_s5.enableItem("save");
        }        
    }
    
    function clearForm(){           
        document.getElementById("form_s5").reset();
        document.getElementById("groupname").focus();
    }
           
          
    function delete_s5(){
        var id = grid_s5.getSelectedRowId();
        var group = grid_s5.cells(id,1).getValue();
        dhtmlx.confirm({
            title:"Confirm",
            text:"Apakah anda yakin menghapus data group "+group+"?",
            callback:function(result){
                if(result==true){
                    var postStr =
                        "id=" + id+				                
                        statusLoading();
                    dhtmlxAjax.post(base_url+'/index.php/group/delete', postStr, function(loader) {
                        result = loader.xmlDoc.responseText;                        
                        if(result=='1'){                                    
                            loadGrid_s5();
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