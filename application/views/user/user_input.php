<?php

/*
 * user_input.php
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
    document.form_s4.username.focus();
    var dhx_globalImgPath="<?php echo base_url(); ?>/assets/imgs/";
    var c1 = new dhtmlXCombo("grup", "grup", 200);
    
    function loadGroup(grupid){
        c1.loadXML("<?php echo base_url() . "index.php/user/load_group" ?>",function(){
            IDGrup = c1.getIndexByValue(grupid);
            c1.selectOption(IDGrup,true,true);
        });          
    }
    
    
    var c2 = new dhtmlXCombo("perusahaan", "perusahaan", 200);
    
    function loadCompany(companyid){
        c2.loadXML("<?php echo base_url() . "index.php/user/load_company" ?>",function(){
            IDCom = c2.getIndexByValue(companyid);
            c2.selectOption(IDCom,true,true);
        });          
    }
    
    var c3 = new dhtmlXCombo("status", "status", 100);
  
    function loadStatus(status){
        c3.loadXML("<?php echo base_url() . "index.php/user/load_status" ?>",function(){
            IDStat = c3.getIndexByValue(status);
            c3.selectOption(IDStat,true,true);
        });          
    }
    
    
    var x = "<?php if(isset($user_id)): echo $user_id; endif; ?>";
    if(x!=""){        
        loadGroup("<?php if(isset($group_id)): echo $group_id; endif;?>");
        loadCompany("<?php if(isset($company_id)): echo $company_id; endif;?>");
        loadStatus("<?php if(isset($status)): echo $status; endif;?>");
    } else {        
        loadGroup();
        loadCompany();
        loadStatus();
        
    }
    
</script>
</head>
<body>
    
<div id="objForm_s4" style="overflow:hidden;width:100%;height:auto;padding:10px;background:#CFE4FE;">            
<fieldset style="width: 50%;">
    <form action="javascript:void(0);" id="form_s4" name="form_s4" method="post">
        <table width="430" border="0">                             
            <tr>
                <td width="120px" class="label-form">Username</td>
                <td>:</td>
                <td>
                    <input type="text" name="username" id="username" value="<?php if(isset($username)): echo $username; endif;?>" />
                </td>                        
            </tr>
            <tr>
                <td width="120px" class="label-form">Nama</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama" id="nama" size="28" value="<?php if(isset($nama)): echo $nama; endif;?>" />
                </td>                        
            </tr>
            <tr>
                <td width="120px" class="label-form">Grup</td>
                <td>:</td>
                <td>
                    <div id="grup"></div>
                </td>                        
            </tr>
            <tr>
                <td width="120px" class="label-form">Perusahaan</td>
                <td>:</td>
                <td>
                    <div id="perusahaan"></div>
                </td>                        
            </tr>                            
            <tr>
                <td width="120px" class="label-form">Email</td>
                <td>:</td>
                <td>
                    <input type="text" name="email" id="email" size="28" value="<?php if(isset($email)): echo $email; endif;?>" />
                </td>                        
            </tr>
            <tr>
                <td width="120px" class="label-form">Telepon</td>
                <td>:</td>
                <td>
                    <input type="text" name="telp" id="telp" value="<?php if(isset($phone)): echo $phone; endif;?>" />
                </td>                        
            </tr>
            <tr>
                <td width="120px" class="label-form">Keterangan</td>
                <td>:</td>
                <td>
                    <input type="text" name="ket" id="ket" size="28" value="<?php if(isset($notes)): echo $notes; endif;?>" />
                </td>                        
            </tr>                            
            <tr>
                <td width="120px" class="label-form">Status</td>
                <td>:</td>
                <td>
                    <div id="status"></div>
                </td>                        
            </tr>

            <tr>
                <td>&nbsp;</td>
            </tr>

            <tr>
                <td class="label-form">Password</td>
                <td>:</td>
                <td>                            
                    <input type="password" name="password" id="password" />
                    <input type="hidden" name="password_hide" id="password_hide" value="<?php if(isset($pass)): echo $pass; endif;?>" />
                </td>                                                
            </tr> 
            <tr>
                <td class="label-form">Konfirmasi</td>
                <td>:</td>
                <td>                            
                    <input type="password" name="conf_password" id="conf_password" />
                </td>                                                
            </tr> 

            <tr>
                <td><input type="hidden" name="id" id="id" value="<?php if(isset($user_id)): echo $user_id; endif;?>" /></td>
            </tr>                            
        </table>
    </form>
</fieldset>
</div>
    



</body>
</html>