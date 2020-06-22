<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();

		$this->load->model('Atasan_m', 'atasan');
		$this->load->model('Pegawai_m', 'pegawai');
		$this->load->model('Wfh_m', 'wfh');
		cek_session();
	}




	public function index()
	{
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda  tidak berhak ke halaman tersebut');
			switch ($this->session->level) {
				case '1':
					redirect('dashboard');
				case '2':
					redirect('approval');
					break;
				case '3':
					redirect('penilai');
					break;
				case '4':
					redirect('pegawai');
					break;
				default:
					//         $this->session->set_flashdata('success', "Selamat datang");
					//         // redirect('dashboard');
					break;
			}
		}
		$nip_atasan = $this->session->nip;
		$data = [

			'atasan_all' => $this->atasan->getByNIPAtasan($nip_atasan)
		];

		$this->load->view('dashboard1', $data);
	}

	public function dashboard1()
	{


		$this->load->view('dashboard1');
	}


	public function biodata()
	{
		$nip = $this->input->get('id');
		$token = $this->input->get('token');
		if ($token == md5(sha1(md5($nip)))) {
			$datapegawai = $this->pegawai->find($nip);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_jabatan));
				// die();
				$data = [
					'nip' => $datapegawai->row()->nip,
					'level' => 4,
					'sidebar' => 'dashboard'
				];
				$this->load->view('pegawai/biodata', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}

	public function tambah()
	{
		print_r($_POST);
	}

	public function dashboard_wfh()
	{

		$data['data_wfh'] = $this->wfh->getAllJoin();
		$this->load->view('wfh\dashboard', $data);
	}
}
