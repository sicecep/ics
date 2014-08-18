<?php

/*
 * group_input.php
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
<script language="javascript">    
   
    
</script>
</head>
<body>
    
<div id="objForm_s5" style="overflow:hidden;width:100%;height:auto;padding:10px;background:#CFE4FE;">            
<fieldset style="width: 93%;">
    <form action="javascript:void(0);" id="form_s5" name="form_s5" method="post">
        <table width="430" border="0">                             
            <tr>
                <td width="100px" class="">Nama Grup</td>
                <td>:</td>
                <td>
                    <input type="text" name="group_name" id="group_name" value="<?php if(isset($group_name)): echo $group_name; endif;?>" />
                </td>                        
            </tr>
            <tr>
                <td width="100px" class="">Keterangan</td>
                <td>:</td>
                <td>
                    <input type="text" name="group_description" id="group_description" size="50" value="<?php if(isset($group_description)): echo $group_description; endif;?>" />
                </td>                        
            </tr>           
            <tr>
                <td><input type="hidden" name="group_id" id="group_id" value="<?php if(isset($group_id)): echo $group_id; endif;?>" /></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div id="objGridForm_s5" style="width:670px; height:325px; background-color: #CFE4FE;"></div> 
                </td>
            </tr>
            
        </table>
    </form>
</fieldset>
</div>
    
<script>
    fgrid_s5 = new dhtmlXGridObject('objGridForm_s5');
    fgrid_s5.setSkin("dhx_skyblue");
    fgrid_s5.setImagePath("<?php echo base_url(); ?>/assets/imgs/");
    fgrid_s5.setHeader("Menu, Status,idparent,idmenu",null,["text-align:center","text-align:center","text-align:center","text-align:center"]);    
    fgrid_s5.setInitWidths("200,80,0,0");
    fgrid_s5.setColAlign("left,center,left,left");
    fgrid_s5.setColTypes("tree,ch,ro,ro");
    fgrid_s5.setColSorting("str,str,str,str");
//    fgrid_s5.setColumnColor("#CCE2FE");    
    fgrid_s5.setSkin("dhx_skyblue");    
    fgrid_s5.attachEvent("onCheck", function(rId,cInd,state){

	if(fgrid_s5.getAllSubItems(rId) != '') {
		subRpt_pg11 = fgrid_s5.getAllSubItems(rId).split(",");
		for(i=0;i < subRpt_pg11.length; i++) {
			id = subRpt_pg11[i];
			fgrid_s5.cells(id,cInd).setValue(state);
		}
		
		// Cek header
		level = fgrid_s5.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = fgrid_s5.getParentId(rId);
				fgrid_s5.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = fgrid_s5.getParentId(rId);
			fgrid_s5.forEachRow(function(id){
				if(fgrid_s5.cells(id,2).getValue() == idParent && fgrid_s5.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = fgrid_s5.getParentId(rId);
					fgrid_s5.cells(rId,cInd).setValue(state);
				}
			}
		}
		//
	} else {
		// Cek header
		level = fgrid_s5.getLevel(rId);
		if(state == true) {
			for(i=1;i<=level;i++) {
				rId = fgrid_s5.getParentId(rId);
				fgrid_s5.cells(rId,cInd).setValue(state);
			}
		} else {
			cek = 0;
			idParent = fgrid_s5.getParentId(rId);
			fgrid_s5.forEachRow(function(id){
				if(fgrid_s5.cells(id,2).getValue() == idParent && fgrid_s5.cells(id,cInd).getValue() == true) {
					cek = 1;
				}
			});
			if(cek==0) {
				for(i=1;i<=level;i++) {
					rId = fgrid_s5.getParentId(rId);
					fgrid_s5.cells(rId,cInd).setValue(state);
				}
			}
		}
		
	}
    });
    fgrid_s5.init();
    loadfGrid_s5();
    
    function loadfGrid_s5() {
        fgrid_s5.clearAll();
        fgrid_s5.loadXML("<?php echo base_url(); ?>index.php/group/loadData_menu/"+document.form_s5.group_id.value,function() {
            fgrid_s5.expandAll();
        });
    }

    function save_s5(){
        if(document.form_s5.group_name.value==""){
            dhtmlx.alert("nama group tidak boleh kosong");
            return;
        } 
        var poststr =
            'dataMenu=' + getData(fgrid_s5,[0,2]) +            
            '&group_name=' + document.form_s5.group_name.value +
            '&group_description=' + document.form_s5.group_description.value +
            '&group_id=' + document.form_s5.group_id.value;
        statusLoading();   
        dhtmlxAjax.post("<?php echo base_url(); ?>index.php/group/save", encodeURI(poststr), function(loader) {
            result = loader.xmlDoc.responseText;
            if(result=="1"){
                toolbar_w1_s5.disableItem("save"); 
                refreshGrid_s5(); 
                statusEnding();                               
                dhtmlx.message("data grup user berhasil disimpan");
            } else {
                statusEnding();            
                dhtmlx.message({
                    type: "error",
                    text: "data grup user gagal disimpan"                
                });
            }
        });
    }
    
    function newForm(){
        document.form_s5.group_name.value = "";
        document.form_s5.group_description.value = "";
        document.form_s5.group_id.value = "";
        fgrid_s5.forEachRow(function(id){
            fgrid_s5.cells(id,1).setValue(0);
        });
    }
    
</script>


</body>
</html>
