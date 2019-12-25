<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sms extends CI_model{


	public function get_all()
	{
		$query = $this->db->select("*")
				 ->from('tbl_surveyarsip')
				 ->order_by('id', 'DESC')
				 ->get();
		return $query->result();
	}

	public function get_puas()
	{	 
		$query = $this->db->select("count(hasil_survey)")
				 ->from('tbl_surveyarsip') 
				 ->where('hasil_survey','Puas')
				 ->get();
		return $query;
	}

	public function simpan($data)
	{ 
		$query = $this->db->insert("tbl_sms_inbox", $data); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function simpanSmsValid($data)
	{ 
		$query = $this->db->insert("tbl_sms_inbox_formatbenar", $data); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function generateAntrian($data)
	{ 
		$query = $this->db->insert("tbl_jadwal_cilacap", $data); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function generateAntrianKCP($data)
	{ 
		$query = $this->db->insert("tbl_jadwal_kcp", $data); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	
	public function getSmsValidMySQL($id)
	{	 
		$query = $this->db->select("isiPesan")
				 ->from('tbl_sms_inbox_formatbenar') 
				 ->where('messageId',$id)
				 ->get();
		return $query->result();
	}

	public function getantriankosong(){
		$query = $this->db->select_min('idantrian')
								->from('tbl_jadwal_cilacap')
								->where('nama','-');
		return  $query;
	}

	public function updateantrian($nama,$telfon)
	{  
		$query = $this->db->set("nama",$nama)
					->set("telfon",$telfon)
					->where("idantrian",$minimumAntrian->result())
					->update("tbl_jadwal_cilacap"); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function updateantriankbm($nama,$telfon)
	{ 
		$minimumAntrian = $this->db->select_min('idantrian')
								->from('tbl_jadwal_kcp');   

		$query = $this->db->set("nama",$nama)
					->set("telfon",$telfon)
					->where_in($this->$minimumAntrian)
					->update("tbl_jadwal_kcp"); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function edit($id)
	{ 
		$query = $this->db->where("id", $id)
				->get("tbl_surveyarsip"); 
		if($query){
			return $query->row();
		}else{
			return false;
		} 
	}

	public function update($data, $id)
	{ 
		$query = $this->db->update("tbl_surveyarsip", $data, $id); 
		if($query){
			return true;
		}else{
			return false;
		} 
	}

	public function hapus($id)
	{ 
		$query = $this->db->delete("tbl_surveyarsip", $id); 
		if($query){
			return true;
		}else{
			return false;
		} 
	} 
}