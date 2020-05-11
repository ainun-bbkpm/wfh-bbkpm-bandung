<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$this->load->model('Admin_m','admin');
		$this->load->model('Pegawai_m','pegawai');

		cek_session();


    }
    
    
	public function index()
	{
		
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$data = array(
			'admin_all' => $this->admin->getAll(), 
			
		);
		$this->load->view('admin/index',$data);
	}

	public function tambah()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$data = array(
			
			'pegawai_all' => $this->pegawai->getAllJoinAdmin(), 
		);
		$this->load->view('admin/tambah',$data);
	}


	public function simpan()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip_pegawai', 'NIP Admin', 'required|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('email_admin', 'Email', 'required|valid_email|is_unique[admin.email_admin]');
		$this->form_validation->set_rules('username_admin', 'Username', 'required|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('password_admin', 'Password', 'required');
		$this->form_validation->set_rules('no_hp_admin', 'No HP', 'required|is_unique[admin.no_hp_admin]');
		$this->form_validation->set_rules('level_admin', 'Level', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            redirect('dashboard/admin/tambah');
		}
		else
		{
			$datapegawai = $this->pegawai->find($this->input->post('nip_pegawai'))->row();
			$dataadmin = array(
				'nip_pegawai' => $this->input->post('nip_pegawai'), 
				'nama_admin' => $datapegawai->nama_pegawai, 
				'username_admin' => $this->input->post('username_admin'), 
				'email_admin' => $this->input->post('email_admin'), 
				'password_admin' => md5(sha1(hash('sha256',sha1(md5($this->input->post('password_admin')))))), 
				'no_hp_admin' => $this->input->post('no_hp_admin'), 
				'level_admin' => $this->input->post('level_admin'), 
				'status_admin' => 1, 

			);

			// simpan ke database
			$this->admin->simpan($dataadmin);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			redirect('dashboard/admin');
		}


	}

	public function edit()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$id_admin = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_admin) == $token) {
			$dataadmin = $this->admin->find($id_admin);
			if ($dataadmin->num_rows() > 0) {
				$data = [
					'admin'=>$dataadmin->row(),
					'pegawai_all' => $this->pegawai->getAll(), 
				];

				$this->load->view('admin/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/admin');
				
				
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/admin');
		}

	}

	public function update()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_admin', 'Id', 'required');
		$this->form_validation->set_rules('nip_pegawai', 'NIP Admin', 'required|min_length[1]|max_length[50]');
		
		$this->form_validation->set_rules('email_admin', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('username_admin', 'Username', 'required|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('no_hp_admin', 'No HP', 'required');
		$this->form_validation->set_rules('level_admin', 'Level', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$errors= validation_errors('<li class="text-danger">','</li>');
            $this->session->set_flashdata('error', "$errors");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{

			if (empty($this->input->post('password_admin'))) {
				$password = $this->input->post('password_lama_admin');
			} else {
				$password = md5(sha1(hash('sha256',sha1(md5($this->input->post('password_admin'))))));
			}
			$datapegawai = $this->pegawai->find($this->input->post('nip_pegawai'))->row();
			$dataadmin = array(
				'nip_pegawai' => $this->input->post('nip_pegawai'), 
				'nama_admin' => $datapegawai->nama_pegawai, 
				'username_admin' => $this->input->post('username_admin'), 
				'email_admin' => $this->input->post('email_admin'), 
				'password_admin' => $password , 
				'no_hp_admin' => $this->input->post('no_hp_admin'), 
				'level_admin' => $this->input->post('level_admin'), 
				'status_admin' => 1, 
				'updated_at'=> date("Y-m-d H:i:s")

			);
			$id_admin = $this->input->post('id_admin');
			// update ke database
			$this->admin->update($dataadmin,$id_admin);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			redirect('dashboard/admin');
		}


	}

	public function hapus()
	{
		if ($this->session->level != 1 ) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		
		$id_admin = $this->input->post('id_hapus');
		
		$dataadmin = $this->admin->find($id_admin);
		if ($dataadmin->num_rows() > 0) {
			$this->admin->hapus($id_admin);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			redirect('dashboard/admin');
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			redirect('dashboard/admin');
			
		}
		


	}


}
