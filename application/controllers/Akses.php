<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$this->load->model('Akses_m','akses');

		cek_session();


    }
    
    
	public function index()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$data = array(
			'akses_all' => $this->akses->getAll(), 
		);
		$this->load->view('akses/index',$data);
	}

	public function tambah()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$this->load->view('akses/tambah');
	}


	public function simpan()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_hak_akses', 'Nama akses', 'required|min_length[1]|max_length[30]');
		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            redirect('dashboard/akses/tambah');
		}
		else
		{
			$dataakses = array(
				'nama_hak_akses' => $this->input->post('nama_hak_akses'), 
				'created_at'=> date("Y-m-d H:i:s")
			);

			// simpan ke database
			$this->akses->simpan($dataakses);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			redirect('dashboard/akses');
		}


	}

	public function edit()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}


		$id_hak_akses = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_hak_akses) == $token) {
			$dataakses = $this->akses->find($id_hak_akses);
			if ($dataakses->num_rows() > 0) {
				$data = [
					'akses'=>$dataakses->row()
				];

				$this->load->view('akses/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/akses');
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/akses');
		}

	}

	public function update()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_hak_akses', 'Id', 'required');
		$this->form_validation->set_rules('nama_hak_akses', 'Nama akses', 'required|min_length[1]|max_length[30]');
		

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			
			$dataakses = array(
				'nama_hak_akses' => $this->input->post('nama_hak_akses'), 
				'updated_at'=> date("Y-m-d H:i:s")
			);
			$id_hak_akses = $this->input->post('id_hak_akses');
			// update ke database
			$this->akses->update($dataakses,$id_hak_akses);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			redirect('dashboard/akses');
		}


	}

	public function hapus()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		
		$id_hak_akses = $this->input->post('id_hapus');
		
		$dataakses = $this->akses->find($id_hak_akses);
		if ($dataakses->num_rows() > 0) {
			$this->akses->hapus($id_hak_akses);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			redirect('dashboard/akses');
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			redirect('dashboard/akses');
			
		}
		


	}


}
