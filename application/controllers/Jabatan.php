<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$this->load->model('Jabatan_m','jabatan');
		$this->load->model('unit_m','unit');
		$this->load->model('Akses_m','akses');

		cek_session();
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

    }
    
    
	public function index()
	{
		$id_unit_kerja = $this->input->get('id_unit_kerja');
		$token = $this->input->get('token');
		if (sha1($id_unit_kerja) == $token) {
			$dataunit = $this->unit->find($id_unit_kerja);
			if ($dataunit->num_rows() > 0) {
				$data = array(
					'jabatan_all' =>['data'=> $this->jabatan->getByIdUnitKerja($id_unit_kerja)], 
					'id_unit_kerja'=>$id_unit_kerja,
					'token'=>$token,
					'unit'=>$dataunit->row()
				);
				$this->load->view('jabatan/index',$data);
			}else {
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/unit');
		}
	}

	public function tambah()
	{
		$id_unit_kerja = $this->input->get('id_unit_kerja');
		$token = $this->input->get('token');
		if (sha1($id_unit_kerja) == $token) {	
			$data = array(
				'akses_all' => $this->akses->getAll(), 
				'jabatan_all' => $this->jabatan->getAll(), 
				'id_unit_kerja'=>$id_unit_kerja,
				'token'=>$token
				
			);
			$this->load->view('jabatan/tambah',$data);
		}else{
			$this->session->set_flashdata('warning', "Token Bermasalah");
			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}
	}


	public function simpan()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_jabatan', 'Nama jabatan', 'required|min_length[5]|max_length[100]');
		$this->form_validation->set_rules('id_unit_kerja', 'Id Unit kerja', 'required');
		$this->form_validation->set_rules('hak_akses_jabatan', 'Hak Akses', 'required');

		$id_unit_kerja = $this->input->post('id_unit_kerja');
		$token = $this->input->post('token');

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		}
		else
		{
			$datajabatan = array(
				'id_unit_kerja' => $this->input->post('id_unit_kerja'), 
				'nama_jabatan' => $this->input->post('nama_jabatan'), 
				'hak_akses_jabatan' => $this->input->post('hak_akses_jabatan'), 
				'created_at'=> date("Y-m-d H:i:s")
			);

			// simpan ke database
			$this->jabatan->simpan($datajabatan);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");

		}


	}

	public function edit()
	{

		$id_jabatan = $this->input->get('id');
		$token = $this->input->get('token');
		// die();
		if (sha1($id_jabatan) == $token) {
			$datajabatan = $this->jabatan->find($id_jabatan);
			if ($datajabatan->num_rows() > 0) {
				$data = [
                    'jabatan'=>$datajabatan->row(),
                    'akses_all' => $this->akses->getAll(), 
				];

				$this->load->view('jabatan/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/jabatan');
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/jabatan');
		}

	}

	public function update()
	{
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_jabatan', 'Id', 'required');
		$this->form_validation->set_rules('nama_jabatan', 'Nama jabatan', 'required|min_length[5]|max_length[100]');
		$this->form_validation->set_rules('hak_akses_jabatan', 'Nama jabatan', 'required');
		// $id_unit_kerja = $this->input->post('id_unit_kerja');
		// $token = $this->input->post('token');
		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			
			$datajabatan = array(
				'nama_jabatan' => $this->input->post('nama_jabatan'), 
				'hak_akses_jabatan' => $this->input->post('hak_akses_jabatan'), 
				'updated_at'=> date("Y-m-d H:i:s")
			);
			$id_jabatan = $this->input->post('id_jabatan');
			// update ke database
			$this->jabatan->update($datajabatan,$id_jabatan);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";

		}


	}

	public function hapus()
	{
		$id_jabatan = $this->input->post('id_hapus');
		
		$datajabatan = $this->jabatan->find($id_jabatan);
		if ($datajabatan->num_rows() > 0) {
			$this->jabatan->hapus($id_jabatan);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			
		}
		


	}


}
