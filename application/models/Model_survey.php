<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_survey extends CI_model{


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
		$query = $this->db->insert("tbl_surveyarsip", $data); 
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