<?php

/*
 * sistem_model.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class sistem_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    
    function bulan() {
		$bln = "";
		for($i=1;$i<=12;$i++) {
			if(strlen($i)=='1') { 
				$n = '0'.$i;
			} else {
				$n = $i;
			}
			$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			if($n==date('m')) { $select = "selected=\"selected\""; } else { $select = ''; }
			$bln .= '<option value="'.$n.'" '.$select.'>'.$arrBln[$i-1].'</option>';
		}
		return $bln;
	}
        
        function tahun() {
		$thn = "";
		for($i=date("Y")-5;$i<=date("Y");$i++) {
			if($i==date('Y')) { $select = "selected=\"selected\""; } else { $select = ''; }
			$thn .= '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
		}
		return $thn;
	}
        
        function view_tanggal() {
		$tgl = date('d');
		$bln = date('n') - 1;
		$thn = date('Y');
		
		return $tgl." ".$this->view_bln($bln)." ".$thn;
			
	}
        
        function view_bln($id) {
		$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $arrBln[$id];	
	}
        
        function bulannya($id) {
		$arrBln = array ("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember","1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli","8"=>"Agustus","9"=>"September");
		return $arrBln[$id];	
	}
        
        function conversiTgl($tgl) {
		if($tgl=="") {
			return '0000-00-00';	
		} else {
			$arr = preg_split('[/]',$tgl);
			return $arr[2].'-'.$arr[1].'-'.$arr[0];	
		}
	}
	
	function conversiTglDB($tgl) {
		if($tgl=="") {
			return '';
		} else {
			$arr = preg_split('[-]',$tgl);
			return $arr[2].'/'.$arr[1].'/'.$arr[0];	
		}
	}
        
        function log_book($ket,$idmenu,$author) {
		$this->db->query("insert into sys_log_book (keterangan,idmenu,author) values ('$ket','$idmenu','$author')");
	}
        
        function insertDB($data,$table,$dataIns,$fk) {
		if($fk != 0):
			$this->db->delete($table,$fk);
		endif;
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {				
				if($cols != ""):
					$rec[$cols] = $arrData[$i];
				endif;
				$i++;
			}
			if($fk != 0):
				$rec = array_merge($rec,$fk);
			endif;
			$this->db->insert($table,$rec);
		}
	}
        
        function arrayMerge($data,$field,$dataInput) {
		if($dataInput != "" && $dataInput != "null"):
			$data = array_merge($data,array($field => $dataInput));
		endif;
		return $data;
	}
        
        function noTrans($kode,$table,$txtQr,$outlet_id) {
		$r = $this->db->query("select concat(sa_thn,'-',sa_bln) as periode from sys_periode_akuntansi where active = '1'")->row();
		$periode = $r->periode;
		$arr = explode("-",$periode);
		$bln = $arr[1];
		$thn = $arr[0];
		$r = $this->db->query("select ifnull(max(substring_index(kdtrans,'.',1)) + 1,1) as no from $table where substring_index(tgl,'-',2) = '".$periode."' $txtQr")->row();
		$jml = $r->no;
		
		if(strlen($jml)==1) {
			$no_urut = '000'.$jml;	
		} else if(strlen($jml)==2) {
			$no_urut = '00'.$jml;
		} else if(strlen($jml)==3) {
			$no_urut = '0'.$jml;	
		} else if(strlen($jml)==4) {
			$no_urut = $jml;	
		}
		$notrans = $no_urut.'.'.$outlet_id.'-'.$kode.'.'.$bln.substr($thn,-2);
		return $notrans;
	}
        
}
