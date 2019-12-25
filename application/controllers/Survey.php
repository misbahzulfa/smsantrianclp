<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct(){ 
		parent ::__construct(); 
		//load model
		$this->load->model('model_survey');  
	}

	public function index()
	{
		$data = array( 
			'title' 	=> 'Data Survey',
			'data_survey'	=> $this->model_survey->get_all() 
		); 
		$puas = $this->model_survey->get_puas();

		$this->load->view('data_survey', $data, $puas);
	}


	public function tambah()
	{
		$data = array( 
			'title' 	=> 'Tambah Data Buku' 
		);

		$this->load->view('input_survey', $data);
	}

	public function simpan()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'directinput'  
		);

		$this->model_survey->simpan($data); 
		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');
		//redirect
		redirect('survey/tambah');
	}

	public function sangat_puas()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'Sangat Puas'  
		);

		$this->model_survey->simpan($data); 
		//$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Terima Kasih Sudah Survey  </div>');
		//redirect
		redirect('survey/tambah');
	}

	public function puas()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'Puas'  
		);

		$this->model_survey->simpan($data); 
		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');
		//redirect
		redirect('survey/tambah');
	}

	public function cukup_puas()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'Cukup Puas'  
		);

		$this->model_survey->simpan($data); 
		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');
		//redirect
		redirect('survey/tambah');
	}

	public function kurang_puas()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'Kurang Puas'  
		);

		$this->model_survey->simpan($data); 
		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');
		//redirect
		redirect('survey/tambah');
	}

	public function tidak_puas()
	{
		$data = array( 
			'kantor' 	=> 'L02',
			'hasil_survey' => 'Tidak Puas'  
		);

		$this->model_survey->simpan($data); 
		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase. </div>');
		//redirect
		redirect('survey/tambah');
	}



	/*
	public function edit($id)
	{
		$id = $this->uri->segment(3);

		$data = array(

			'title' 	=> 'Edit Data Buku',
			'data_buku' => $this->model_survey->edit($id)

		);

		$this->load->view('edit_survey', $data);
	}

	
	public function update()
	{
		$id['id_buku'] = $this->input->post("id_buku");
		$data = array(

			'no_isbn' 			=> $this->input->post("no_isbn"),
			'nama_buku' 		=> $this->input->post("nama_buku"),
			'tanggal_terbit' 	=> $this->input->post("tanggal_terbit"),
			'pengarang' 		=> $this->input->post("pengarang"),
			
		);

		$this->model_survey->update($data, $id);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil diupdate didatabase.
			                                    </div>');

		//redirect
		redirect('survey/');

	}
	*/

	public function hapus($id)
	{
		$id['id'] = $this->uri->segment(3);
		
		$this->model_survey->hapus($id);

		//redirect
		redirect('survey/');

	}

}
