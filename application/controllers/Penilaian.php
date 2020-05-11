<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$this->load->model('Penilaian_m','penilaian');

		cek_session();


    }
    
    
	public function index()
	{	
		
		$data = array(
			'penilaian_all' => $this->penilaian->getAll(), 
		);
		$this->load->view('penilaian/index',$data);
	}

	public function tambah()
	{
		
		$this->load->view('penilaian/tambah');
	}


	public function simpan()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_penilaian', 'Nama Penilaian', 'required|min_length[5]|max_length[30]');
		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            redirect('dashboard/penilaian/tambah');
		}
		else
		{
			$datapenilaian = array(
				'nama_penilaian' => $this->input->post('nama_penilaian'), 
				'max_bobot' => $this->input->post('max_bobot'), 
				'created_at'=> date("Y-m-d H:i:s")
			);

			// simpan ke database
			$this->penilaian->simpan($datapenilaian);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			redirect('dashboard/penilaian');
		}


	}

	public function edit()
	{

		$id_penilaian = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_penilaian) == $token) {
			$datapenilaian = $this->penilaian->find($id_penilaian);
			if ($datapenilaian->num_rows() > 0) {
				$data = [
					'penilaian'=>$datapenilaian->row()
				];

				$this->load->view('penilaian/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/penilaian');
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/penilaian');
		}

	}

	public function update()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_penilaian', 'Id', 'required');
		$this->form_validation->set_rules('nama_penilaian', 'Nama Penilaian', 'required|min_length[5]|max_length[30]');
		

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			
			$datapenilaian = array(
				'nama_penilaian' => $this->input->post('nama_penilaian'), 
				'max_bobot' => $this->input->post('max_bobot'), 
				'updated_at'=> date("Y-m-d H:i:s")
			);
			$id_penilaian = $this->input->post('id_penilaian');
			// update ke database
			$this->penilaian->update($datapenilaian,$id_penilaian);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			redirect('dashboard/penilaian');
		}


	}

	public function hapus()
	{
		$id_penilaian = $this->input->post('id_hapus');
		
		$datapenilaian = $this->penilaian->find($id_penilaian);
		if ($datapenilaian->num_rows() > 0) {
			$this->penilaian->hapus($id_penilaian);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			redirect('dashboard/penilaian');
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			redirect('dashboard/penilaian');
			
		}
		


	}


}
