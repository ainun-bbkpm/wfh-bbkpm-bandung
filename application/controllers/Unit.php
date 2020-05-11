<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$this->load->model('Unit_m','unit');
		$this->load->model('Akses_m','akses');
		

		cek_session();


    }
    
    
	public function index()
	{
		$data = array(
			'unit_all' => $this->unit->getAll(), 
			
		);
		$this->load->view('unit/index',$data);
	}

	public function tambah()
	{
        $data = array(
            'akses_all' => $this->akses->getAll(), 
            
            
		);
		$this->load->view('unit/tambah',$data);
	}


	public function simpan()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_unit_kerja', 'Nama unit', 'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('hak_akses_unit_kerja', 'Nama unit', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            redirect('dashboard/unit/tambah');
		}
		else
		{
			$dataunit = array(
				'nama_unit_kerja' => $this->input->post('nama_unit_kerja'), 
				'hak_akses_unit_kerja' => $this->input->post('hak_akses_unit_kerja'), 
				'created_at'=> date("Y-m-d H:i:s")
			);

			// simpan ke database
			$this->unit->simpan($dataunit);
			
			$this->session->set_flashdata('success', "Berhasil disimpan");
			redirect('dashboard/unit');
		}


	}

	public function edit()
	{

		$id_unit = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_unit) == $token) {
			$dataunit = $this->unit->find($id_unit);
			if ($dataunit->num_rows() > 0) {
				$data = [
                    'unit'=>$dataunit->row(),
                    'akses_all' => $this->akses->getAll(), 
				];

				$this->load->view('unit/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/unit');
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/unit');
		}

	}

	public function update()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_unit_kerja', 'Id', 'required');
		$this->form_validation->set_rules('nama_unit_kerja', 'Nama unit', 'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('hak_akses_unit_kerja', 'Nama unit', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			
			$dataunit = array(
				'nama_unit_kerja' => $this->input->post('nama_unit_kerja'), 
				'hak_akses_unit_kerja' => $this->input->post('hak_akses_unit_kerja'), 
				'updated_at'=> date("Y-m-d H:i:s")
			);
			$id_unit = $this->input->post('id_unit_kerja');
			// update ke database
			$this->unit->update($dataunit,$id_unit);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			redirect('dashboard/unit');
		}


	}

	public function hapus()
	{
		$id_unit = $this->input->post('id_hapus');
		
		$dataunit = $this->unit->find($id_unit);
		if ($dataunit->num_rows() > 0) {
			$this->unit->hapus($id_unit);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			redirect('dashboard/unit');
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			redirect('dashboard/unit');
			
		}
		


	}


}
