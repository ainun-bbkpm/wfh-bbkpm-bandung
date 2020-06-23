<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Pegawai_m', 'pegawai');
		$this->load->model('Unit_m', 'unit');
		$this->load->model('Jabatan_m', 'jabatan');
		$this->load->model('Atasan_m', 'atasan');
		$this->load->model('Akses_m', 'akses');


		// cek_session();


	}

	public function dashboard()
	{
		cek_session();
		if ($this->session->level != 4) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$this->load->model('Remun_m', 'remun');
		$nip = $this->session->nip;
		$pegawai =  $this->pegawai->find($nip)->row();
		$tahun = $this->input->get('tahun');
		if ($tahun) {
			$thn = $tahun;
		} else {

			$thn = substr(date('Y-m-d'), 0, 4);
			# code...
		}







		$data = array(
			'pegawai' => $pegawai,
			'tahun' => $thn,
			'remun_all' => $this->remun->getByNIPAndThn($nip, $thn),
			// 'bulan'=>['januari','februari','maret']
		);
		if ($this->remun->getByNIPAndThn($nip, $thn)->num_rows()) {
			$this->session->set_flashdata('success', "Remun tahun $thn");
		} else {
			$this->session->set_flashdata('error', "Remun tahun $thn tidak ada");
		}

		// $this->load->view('pegawai/dashboard',$data);
		$this->load->view('pegawai/dashboard2', $data);
	}


	public function biodata()
	{
		cek_session();
		$data = [
			'nip' => $this->session->nip,
			'level' => $this->session->level,
			'sidebar' => 'pegawai'
		];
		$this->load->view('pegawai/biodata', $data);
	}

	public function biodata_edit()
	{
		$nip = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1(sha1(md5($nip . md5($nip)))) == $token) {
			$datapegawai = $this->pegawai->find($nip);
			if ($datapegawai->num_rows() > 0) {
				$this->load->model('Login_m', 'login');
				$datalogin =  $this->login->getByNipPegawai($nip);

				$data = array(
					'id_login' => $datalogin->row()->id_login,
					'datalogin' => $this->login->find($datalogin->row()->id_login)->row(),
					'pegawai_all' => $this->pegawai->getAll()->result()

				);
				// print_r($data['datalogin']);
				$this->load->view('pegawai/biodata_edit', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('pegawai/biodata');
		}
	}






	public function index()
	{
		cek_session();


		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$data = array(
			'pegawai_all' => $this->pegawai->getAllJoin(),
		);
		$this->load->view('pegawai/index', $data);
	}

	public function tambah()
	{
		cek_session();
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}
		$data = array(
			'unit_all' => $this->unit->getAll(),


		);
		$this->load->view('pegawai/tambah', $data);
	}


	public function simpan()
	{
		cek_session();
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_pegawai', 'Nama', 'required|min_length[5]|max_length[50]');
		// $this->form_validation->set_rules('nik', 'nik', 'required|is_unique[pegawai.nik]'); //Dimatiin dulu yang asli
		// $this->form_validation->set_rules('nip', 'nip', 'required|is_unique[pegawai.nik]'); //Dimatiin dulu yang asli

		$this->form_validation->set_rules('id_unit_kerja', 'Unit Kerja', 'required');
		$this->form_validation->set_rules('id_jabatan', 'Password', 'required');
		$this->form_validation->set_rules('grading', 'Grading', 'required');
		$this->form_validation->set_rules('jab_value', 'Jab Value', 'required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			redirect('dashboard/pegawai/tambah');
		} else {
			$datapegawai = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'nip2' => $this->input->post('nip2'),
				'nik' => $this->input->post('nik'),
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'grading' => $this->input->post('grading'),
				'jab_value' => $this->input->post('jab_value'),


			);

			// simpan ke database
			$this->pegawai->simpan($datapegawai);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			redirect('dashboard/pegawai');
		}
	}

	public function edit()
	{
		cek_session();
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}


		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');

		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_jabatan));
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'unit_all' => $this->unit->getAll(),
					'jabatan_all' => $this->jabatan->find($datapegawai->row()->id_jabatan),
				];

				$this->load->view('pegawai/edit', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}

	public function update()
	{
		cek_session();
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip', 'Id', 'required');
		$this->form_validation->set_rules('nama_pegawai', 'Nama', 'required|min_length[5]|max_length[50]');
		// $this->form_validation->set_rules('nik', 'nik', 'required');
		$this->form_validation->set_rules('id_unit_kerja', 'Unit Kerja', 'required');
		$this->form_validation->set_rules('id_jabatan', 'Password', 'required');
		$this->form_validation->set_rules('grading', 'Grading', 'required');
		$this->form_validation->set_rules('jab_value', 'Jab Value', 'required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {

			if (empty($this->input->post('password_pegawai'))) {
				$password = $this->input->post('password_lama_pegawai');
			} else {
				$password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password_pegawai'))))));
			}

			$datapegawai = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'nik' => $this->input->post('nik'),
				'nip2' => $this->input->post('nip2'),
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'grading' => $this->input->post('grading'),
				'jab_value' => $this->input->post('jab_value'),

			);
			$nip = $this->input->post('nip');
			// update ke database
			$this->pegawai->update($datapegawai, $nip);
			$this->session->set_flashdata('success', "Berhasil diupdate");
			redirect('dashboard/pegawai');
		}
	}

	public function hapus()
	{
		if ($this->session->level != 1) {
			$this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
			redirect('dashboard');
		}

		$id_pegawai = $this->input->post('id_hapus');

		$datapegawai = $this->pegawai->find($id_pegawai);
		if ($datapegawai->num_rows() > 0) {
			$this->pegawai->hapus($id_pegawai);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			redirect('dashboard/pegawai');
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			redirect('dashboard/pegawai');
		}
	}


	/// Remunasi
	public function atasan()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan_all' => $this->atasan->getByNipPegawai($id_pegawai),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),
					'id' => $id_pegawai,
					'token' => $token,


				];

				$this->load->view('atasan/index', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}
	public function atasan_add()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan_all' => $this->atasan->getByNipPegawai($id_pegawai),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),


				];

				$this->load->view('atasan/tambah', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}
	public function atasan_edit()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		$id_atasan = $this->input->get('id_atasan');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan' => $this->atasan->find($id_atasan)->row(),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),


				];

				$this->load->view('atasan/edit', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}



	public function atasan_simpan()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_pegawai', 'Id Pegawai', 'required');
		$this->form_validation->set_rules('id_hak_akses', 'Id hak akses', 'required');
		$this->form_validation->set_rules('atasan_ke', 'Id hak akses', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		} else {


			// print_r($_POST);
			if (isset($_POST['exampleRadios'])) {
				# code...
				$exampleRadios = $this->input->post('exampleRadios');
				if ($exampleRadios == 1) {
					// echo "Dia sebagai Pejabat penilai";
					$pejabat_penilai = 1;
					$atasan_langsung = 0;
				} else {
					// echo "Pejabat langsung atasan penilai";
					$pejabat_penilai = 0;
					$atasan_langsung = 1;
				}
			} else {
				$pejabat_penilai = 0;
				$atasan_langsung = 0;
			}

			// die();
			$datasimpanatasan = [
				'nip_atasan' => $this->input->post('nip_atasan'),
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'id_hak_akses' => $this->input->post('id_hak_akses'),
				'atasan_ke' => $this->input->post('atasan_ke'),
				'pejabat_penilai' => $pejabat_penilai,
				'atasan_langsung' => $atasan_langsung,
				'created_at' => date("Y-m-d H:i:s")

			];
			// print_r($datasimpanatasan);
			// die();
			$this->atasan->simpan($datasimpanatasan);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		}
	}


	public function atasan_update()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_pegawai', 'Id Pegawai', 'required');
		$this->form_validation->set_rules('id_hak_akses', 'Id hak akses', 'required');
		$this->form_validation->set_rules('atasan_ke', 'Id hak akses', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		} else {
			$id_atasan = $this->input->post('id_atasan');
			$datasimpanatasan = [
				'nip_atasan' => $this->input->post('nip_atasan'),
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'id_hak_akses' => $this->input->post('id_hak_akses'),
				'atasan_ke' => $this->input->post('atasan_ke'),
				'updated_at' => date("Y-m-d H:i:s")
			];
			// print_r($datasimpanatasan);
			$this->atasan->update($datasimpanatasan, $id_atasan);
			$this->session->set_flashdata('success', "Berhasil Diperbarui");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		}
	}

	public function atasan_hapus()
	{
		$id_atasan = $this->input->post('id_hapus');

		$dataatasan = $this->atasan->find($id_atasan);
		if ($dataatasan->num_rows() > 0) {
			$this->atasan->hapus($id_atasan);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}


	/// WFH
	public function atasan_wfh()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan_all' => $this->atasan->getByNipPegawaiWFH($id_pegawai),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),
					'id' => $id_pegawai,
					'token' => $token,


				];

				$this->load->view('atasan_wfh/index', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}
	public function atasan_add_wfh()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan_all' => $this->atasan->getByNipPegawaiWFH($id_pegawai),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),


				];

				$this->load->view('atasan_wfh/tambah', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}
	public function atasan_edit_wfh()
	{
		$id_pegawai = $this->input->get('id');
		$token = $this->input->get('token');
		$id_atasan = $this->input->get('id_atasan');
		if (sha1($id_pegawai) == $token) {
			$datapegawai = $this->pegawai->find($id_pegawai);
			if ($datapegawai->num_rows() > 0) {
				// print_r($this->jabatan->getByIdUnitKerja($datapegawai->row()->id_pegawai));
				// print_r($this->atasan->getByNipPegawai($id_pegawai)->result());
				// die();
				$data = [
					'pegawai' => $datapegawai->row(),
					'atasan' => $this->atasan->find_wfh($id_atasan)->row(),
					'pegawai_all' => $this->pegawai->getAllJoin(),
					'akses_all' => $this->akses->getAll(),


				];

				$this->load->view('atasan_wfh/edit', $data);
			} else {
				$this->session->set_flashdata('error', "Id Tidak ditemukan");
				redirect('dashboard/pegawai');
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			redirect('dashboard/pegawai');
		}
	}



	public function atasan_simpan_wfh()
	{



		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_pegawai', 'Id Pegawai', 'required');
		$this->form_validation->set_rules('id_hak_akses', 'Id hak akses', 'required');
		$this->form_validation->set_rules('atasan_ke', 'Id hak akses', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		} else {


			// print_r($_POST);
			if (isset($_POST['exampleRadios'])) {
				# code...
				$exampleRadios = $this->input->post('exampleRadios');
				if ($exampleRadios == 1) {
					// echo "Dia sebagai Pejabat penilai";
					$pejabat_penilai = 1;
					$atasan_langsung = 0;
				} else {
					// echo "Pejabat langsung atasan penilai";
					$pejabat_penilai = 0;
					$atasan_langsung = 1;
				}
			} else {
				$pejabat_penilai = 0;
				$atasan_langsung = 0;
			}

			// die();
			$datasimpanatasan = [
				'nip_atasan' => $this->input->post('nip_atasan'),
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'id_hak_akses' => $this->input->post('id_hak_akses'),
				'atasan_ke' => $this->input->post('atasan_ke'),
				'pejabat_penilai' => $pejabat_penilai,
				'atasan_langsung' => $atasan_langsung,
				'created_at' => date("Y-m-d H:i:s")

			];
			// print_r($datasimpanatasan);
			// die();
			// print_r($_POST);
			// die();
			$this->atasan->simpan_wfh($datasimpanatasan);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		}
	}


	public function atasan_update_wfh()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_atasan', 'Id Atasn', 'required');
		$this->form_validation->set_rules('nip_pegawai', 'Id Pegawai', 'required');
		$this->form_validation->set_rules('id_hak_akses', 'Id hak akses', 'required');
		$this->form_validation->set_rules('atasan_ke', 'Id hak akses', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		} else {
			$id_atasan = $this->input->post('id_atasan');
			$datasimpanatasan = [
				'nip_atasan' => $this->input->post('nip_atasan'),
				'nip_pegawai' => $this->input->post('nip_pegawai'),
				'id_hak_akses' => $this->input->post('id_hak_akses'),
				'atasan_ke' => $this->input->post('atasan_ke'),
				'updated_at' => date("Y-m-d H:i:s")
			];
			// print_r($datasimpanatasan);
			$this->atasan->update_wfh($datasimpanatasan, $id_atasan);
			$this->session->set_flashdata('success', "Berhasil Diperbarui");
			// header('Location: ' . $_SERVER['HTTP_REFERER']);
			echo "<script>window.history.go(-2);</script>";
		}
	}

	public function atasan_hapus_wfh()
	{
		$id_atasan = $this->input->post('id_hapus');

		$dataatasan = $this->atasan->find_wfh($id_atasan);
		if ($dataatasan->num_rows() > 0) {
			$this->atasan->hapus_wfh($id_atasan);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('error', "Id Tidak ditemukan");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}









	public function pegawai_lists()
	{
		header('Content-Type: application/json');

		if ($this->input->get('cmd') == 'get-records') {


			$total = $this->db->count_all_results('pegawai');
			$this->db->select('*');

			$this->db->limit($this->input->get('limit', true), $this->input->get('offset', true));

			// for sort
			if ($this->input->get('sort') != null) {
				$sort = $this->input->get('sort');
				$field = $sort[0]['field'] == 'recid' ? 'nip' : $sort[0]['field'];
				$this->db->order_by($field, ucwords($sort[0]['direction']));
			}

			// for search
			if ($this->input->get('search') != null) {
				// lagi males ngoding :D
				// untuk requestnya bisa lihat di firebug
			}

			$result = $this->db->get('pegawai')->result_array();

			$return = array(
				"total" => $total,
				"records" => $result
			);

			// cara singkat buat yg males bikin loop, jangan ditiru :P
			echo str_replace('"nip":', '"recid":', json_encode($return));
		} else if ($this->input->get('cmd') == 'delete-records') {
			// support multiple delete
			foreach ($this->input->get('selected') as $key => $val) {
				$this->db->delete('pegawai', array('nip' => $val));
			}

			echo json_encode(array(
				'status' => 'success'
			));
		}
	}

	public function uploadspreadsheet()
	{
		$this->load->view('spreadsheetreader/test');
	}

	public function uploadspreadsheet2()
	{
		$this->load->view('spreadsheetreader/upload');
	}

	public function uploadspreadsheet3()
	{
		$this->load->view('spreadsheetreader/index');
	}

	public function api_list_pegawai()
	{

		header('Content-Type: application/json');

		if ($this->input->get('cmd') == 'get-records') {


			$total = $this->db->count_all_results('ref_pegawai');
			$this->db->select('*');

			// $this->db->limit( $this->input->get('limit', true) , $this->input->get('offset', true) );

			// for sort
			if ($this->input->get('sort') != null) {
				$sort = $this->input->get('sort');
				$field = $sort[0]['field'] == 'recid' ? 'nip' : $sort[0]['field'];
				$this->db->order_by($field, ucwords($sort[0]['direction']));
			}

			// for search
			if ($this->input->get('search') != null) {
				// lagi males ngoding :D
				// untuk requestnya bisa lihat di firebug
				$search = $this->input->get('search');
				$field = $search[0]['field'] == 'recid' ? 'id_pegawai' : $search[0]['field'];
				$value = $search[0]['value'];
				// $field = 'nama_pegawai';
				// $value = 'noval habibi';

				$this->db->like($field, $value);
			}

			$result = $this->db->get('ref_pegawai')->result_array();

			$return = array(
				"total" => $total,
				"records" => $result
			);

			// cara singkat buat yg males bikin loop, jangan ditiru :P
			echo str_replace('"id_pegawai":', '"recid":', json_encode($return));
			// echo json_encode($return);

		} else if ($this->input->get('cmd') == 'delete-records') {
			// support multiple delete
			foreach ($this->input->get('selected') as $key => $val) {
				$this->db->delete('ref_pegawai', array('id_pegawai' => $val));
			}

			echo json_encode(array(
				'status' => 'success'
			));
		}
	}

	public function api_list_pegawai2()
	{

		header('Content-Type: application/json');

		switch ($this->input->get('cmd')) {
			case 'get-records':
				$total = $this->db->count_all_results('ref_pegawai');
				$this->db->select('*');
				if ($this->input->get('search') != null) {
					// lagi males ngoding :D
					// untuk requestnya bisa lihat di firebug
					$search = $this->input->get('search');
					$field = $search[0]['field'] == 'recid' ? 'id_pegawai' : $search[0]['field'];
					$value = $search[0]['value'];
					// $field = 'nama_pegawai';
					// $value = 'noval habibi';

					$this->db->like($field, $value);
					$result = $this->db->get('ref_pegawai')->result();
				} else {

					$result = $this->db->get('ref_pegawai')->result_array();
				}


				$return = array(
					"total" => $total,
					"records" => $result
				);


				echo str_replace('"id_pegawai":', '"recid":', json_encode($return));
				break;

			default:
				echo json_encode(array(
					'status' => false,
					'pesan' => 'Permintaan tidak diketahui'
				));
				break;
		}
	}



	public function pegawai2()
	{
		$this->load->view('pegawai2/index');
	}
}
