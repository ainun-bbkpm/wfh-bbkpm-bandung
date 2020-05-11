<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remun extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Jabatan_m', 'jabatan');
		$this->load->model('unit_m', 'unit');
		$this->load->model('Akses_m', 'akses');
		$this->load->model('Pegawai_m', 'pegawai');
		$this->load->model('Remun_m', 'remun');
		$this->load->model('Penilaian_m', 'penilaian');
		$this->load->model('Indikator_m', 'indikator');
		$this->load->model('Capaian_m', 'capaian');
		$this->load->model('Atasan_m', 'atasan');

		cek_session();
	}


	public function index()
	{
		$id = $this->input->get('id');
		$token = $this->input->get('token');
		$tahun = $this->input->get('tahun');
		if ($tahun) {
			$thn = $tahun;
		} else {

			$thn = substr(date('Y-m-d'), 0, 4);
			# code...
		}


		if (sha1($id) == $token) {
			$datapegawai = $this->pegawai->find($id);

			if ($datapegawai->num_rows() > 0) {

				// echo ($this->penilaian->getAll()->result()->id_penilaian);
				// die();
				$data = array(
					'pegawai' => $datapegawai->row(),
					'remun_all' => $this->remun->getByNIPAndThn($id, $thn),
					'penilaian_all' => $this->penilaian->getAll(),
					'atasan_all' => $this->atasan->getAllByNipPegawai($id)
				);



				// echo $d1 = strtotime("2019-11-01");
				// echo "<br>";
				// echo $d2 = strtotime("2020-01-01");
				// echo "<br>";
				// echo $min_date = min($d1, $d2);
				// echo "<br>";
				// echo $max_date = max($d1, $d2);
				// echo "<br>";
				// echo "<br>";
				// $i = 1;

				// while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
				// 	// echo $min_date1=  Date('Y-m-d',strtotime("-1 MONTH", $min_date))."<br>";
				// 	echo $min_date1=  Date('Y-m-d',$min_date)."<br>";

				// 	echo "<br>";
				// 	$i++;

				// }
				// echo $i; // 8


				// die();


				$this->load->view('remun/index', $data);
			} else {
				$this->session->set_flashdata('warning', "Data tidak ada");
				echo "<script>window.history.go(-2);</script>";
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-2);</script>";
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
				'id_unit_kerja' => $id_unit_kerja,
				'token' => $token

			);
			$this->load->view('jabatan/tambah', $data);
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}


	public function simpan_remun()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip', 'nip pegawai', 'required');
		$this->form_validation->set_rules('id_penilaian', 'Id Penilaian', 'required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {
			$nip = $this->input->post('nip');
			$pegawai = $this->pegawai->find($nip)->row();
			$id_penilaian = $this->input->post('id_penilaian');
			$idUniq = substr(md5(uniqid(rand(), true)), 2, 7);
			$datapenilaian = array(
				'id_remun' => $idUniq,
				'nip' => $nip,
				'no_abs' => $pegawai->no_abs,
				'tgl_remun' => date('Y-m-d'),
				'id_penilaian' => $id_penilaian
			);

			// cek ke databse

			$thn = substr(date('Y-m-d'), 0, 4);

			$penilaian = $this->remun->findByPenilaianAndIdAndThn($id_penilaian, $nip, $thn);
			if ($penilaian->num_rows() > 0) {
				// print_r($datapenilaian);
				// print_r($penilaian->row());
				$this->session->set_flashdata('error', "Penilaian sudah ada");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {

				// simpan ke database
				$this->remun->simpan_penilaian($datapenilaian);
				$this->session->set_flashdata('success', "Berhasil disimpan");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function hapus_penilaian()
	{
		$id = $this->input->get('id');

		$sec = $this->input->get('sec');

		if (md5(md5(sha1($id))) == $sec) {

			$dataindikator = $this->indikator->getAllByIdRemun($id)->row();

			if ($dataindikator) {


				$this->indikator->hapus($dataindikator->id_indikator);
			}
			// die();
			$this->remun->hapus($id);

			$this->session->set_flashdata('success', "Berhasil dihapus");
			echo "<script>window.history.go(-1);</script>";
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-1);</script>";
		}
	}

	public function simpan_indikator()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_remun', 'Id remun', 'required');
		$this->form_validation->set_rules('indikator', 'indikator Penilaian', 'required');
		$this->form_validation->set_rules('definisi', 'definisi Penilaian', 'required');
		$this->form_validation->set_rules('target', 'indikator Penilaian', 'required');

		$this->form_validation->set_rules('bobot', 'bobot Penilaian', 'required');
		$this->form_validation->set_rules('range', 'range Penilaian', 'required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {

			$time1 = strtotime(substr($this->input->post('range'), 0, 11));
			$time2 = strtotime(substr($this->input->post('range'), 12, 11));

			$tgl_pertama1 = Date('Y-m-d', $time1);

			$tgl_pertama2 = Date('Y-m-d', $time2);
			$id_remun = $this->input->post('id_remun');
			$id_indikator = rand(32, 98) . $id_remun . rand(32, 98);
			echo $cek_range_target = $this->input->post('cek_range_target');
			//cek apakah chektarget di ceklis apa tidak
			echo "<br>";
			if ($cek_range_target) {

				$range_target1 = $this->input->post('range_target1');
				$range_target2 = $this->input->post('range_target2');
			} else {
				$range_target1 = "";
				$range_target2 = "";
			}

			$datapenilaian = array(
				'id_indikator' => $id_indikator,
				'id_remun' => $id_remun,
				'indikator' => $this->input->post('indikator'),

				'definisi' => $this->input->post('definisi'),
				'target' => $this->input->post('target'),
				'bobot' => $this->input->post('bobot'),
				'range1' => $tgl_pertama1,
				'range2' => $tgl_pertama2,
				'range_target1' => $range_target1,
				'range_target2' => $range_target2,

			);

			$dataremun = $this->remun->find($this->input->post('id_remun'))->row();
			$cekdatapenilaian = $this->penilaian->find($dataremun->id_penilaian)->row();
			$datatotal_bobot_indikator = $this->indikator->total_bobot_indikator($this->input->post('id_remun'))->row();
			$sudah_ditambah = $datatotal_bobot_indikator->total_bobot + $this->input->post('bobot');


			// print_r($datapenilaian);

			// die();
			if ($cekdatapenilaian->max_bobot == 0) {
				// simpan ke database
				$this->remun->simpan_indikator($datapenilaian);


				// Simpan Ke tabel capaina otmatis
				$d1 = strtotime($tgl_pertama1);
				$d2 = strtotime($tgl_pertama2);
				$min_date = min($d1, $d2);
				$max_date = max($d1, $d2);

				$target = $this->input->post('target');
				$capaian = $this->input->post('capaian');
				$bobot = $this->input->post('bobot');
				$hasil_kinerja = floor((($capaian / $target) * $bobot) * 1000) / 1000;

				$datacapaian = array(
					'id_indikator' => $id_indikator,
					'bulan' => $tgl_pertama1,
					// 'target' => $this->input->post('target'), 
					// 'capaian' => $this->input->post('capaian') ,
					'bobot' => $this->input->post('bobot'),
					// 'hasil_kinerja' => $hasil_kinerja,
				);

				// simpan ke database
				$this->capaian->simpan($datacapaian);

				$i = 1;

				while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
					// echo $min_date1=  Date('Y-m-d',strtotime("-1 MONTH", $min_date))."<br>";
					$min_date1 =  Date('Y-m-d', $min_date) . "<br>";


					$i++;

					$datacapaian = array(
						'id_indikator' => $id_indikator,
						'bulan' => $min_date1,
						// 'target' => $this->input->post('target'), 
						// 'capaian' => $this->input->post('capaian') ,
						'bobot' => $this->input->post('bobot'),
						// 'hasil_kinerja' => $hasil_kinerja,
					);

					// simpan ke database
					$this->capaian->simpan($datacapaian);
				}

				// Simpan Ke tabel capaina otmatis ENd




				$this->session->set_flashdata('success', "Berhasil disimpan");
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			} else {

				if (round($sudah_ditambah, 2) > $cekdatapenilaian->max_bobot) {
					$this->session->set_flashdata('error', "Bobot sudah mencapai batas maksimal");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				} else {

					// simpan ke database
					$this->remun->simpan_indikator($datapenilaian);


					// Simpan Ke tabel capaina otmatis
					$d1 = strtotime($tgl_pertama1);
					$d2 = strtotime($tgl_pertama2);
					$min_date = min($d1, $d2);
					$max_date = max($d1, $d2);

					$target = $this->input->post('target');
					$capaian = $this->input->post('capaian');
					$bobot = $this->input->post('bobot');
					$hasil_kinerja = floor((($capaian / $target) * $bobot) * 1000) / 1000;

					$datacapaian = array(
						'id_indikator' => $id_indikator,
						'bulan' => $tgl_pertama1,
						// 'target' => $this->input->post('target'), 
						// 'capaian' => $this->input->post('capaian') ,
						'bobot' => $this->input->post('bobot'),
						// 'hasil_kinerja' => $hasil_kinerja,
					);

					// simpan ke database
					$this->capaian->simpan($datacapaian);

					$i = 1;

					while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
						// echo $min_date1=  Date('Y-m-d',strtotime("-1 MONTH", $min_date))."<br>";
						$min_date1 =  Date('Y-m-d', $min_date) . "<br>";


						$i++;

						$datacapaian = array(
							'id_indikator' => $id_indikator,
							'bulan' => $min_date1,
							// 'target' => $this->input->post('target'), 
							// 'capaian' => $this->input->post('capaian') ,
							'bobot' => $this->input->post('bobot'),
							// 'hasil_kinerja' => $hasil_kinerja,
						);

						// simpan ke database
						$this->capaian->simpan($datacapaian);
					}

					// Simpan Ke tabel capaina otmatis ENd




					$this->session->set_flashdata('success', "Berhasil disimpan");
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
		}
	}


	public function update_indikator()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_indikator', 'Id remun', 'required');
		$this->form_validation->set_rules('indikator', 'indikator Penilaian', 'required');
		$this->form_validation->set_rules('definisi', 'definisi Penilaian', 'required');
		$this->form_validation->set_rules('target', 'indikator Penilaian', 'required');

		$this->form_validation->set_rules('bobot', 'bobot Penilaian', 'required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {
			$id_indikator = $this->input->post('id_indikator');
			// $cekdataindikator=$this->indikator->getById($id_indikator)->row();
			// $cekdataremun=$this->remun->find($cekdataindikator->id_remun)->row();
			// $cekdatapenilaian = $this->penilaian->find($cekdataremun->id_penilaian)->row();
			// $datatotal_bobot_indikator = $this->indikator->total_bobot_indikator($cekdataindikator->id_remun)->row();

			// echo "Bobot yg di input ".$sudah_ditambah =$this->input->post('bobot');
			// echo "<br>";
			// // echo "Bobot yg di input ".$sudah_ditambah = $datatotal_bobot_indikator->total_bobot+$this->input->post('bobot');

			// die();
			$datapenilaian = array(
				'indikator' => $this->input->post('indikator'),
				'definisi' => $this->input->post('definisi'),
				'target' => $this->input->post('target'),
				'bobot' => $this->input->post('bobot'),
			);
			$datacapaian = $this->capaian->getAllByIdIndikator($id_indikator);
			if ($datacapaian->num_rows() != 0) {
				$datacapaian = $datacapaian->row();

				$target = $this->input->post('target');
				$bobot = $this->input->post('bobot');
				$capaian = $datacapaian->capaian;

				$hasil_kinerja = floor((($capaian / $target) * $bobot) * 1000) / 1000;

				$dataupdate = [
					// 'target'=>$target,
					'bobot' => $bobot,
					'hasil_kinerja' => $hasil_kinerja
				];
				$this->capaian->updatebyindikator($dataupdate, $id_indikator);
			}


			// simpan ke database

			$this->remun->update_indikator($datapenilaian, $id_indikator);
			$this->session->set_flashdata('success', "Berhasil diperbarui ");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}


	public function hapus_indikator()
	{
		$id = $this->input->get('id');

		$sec = $this->input->get('sec');

		if (md5(md5(sha1($id))) == $sec) {


			$this->indikator->hapus($id);

			$this->session->set_flashdata('success', "Berhasil dihapus");
			echo "<script>window.history.go(-1);</script>";
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-1);</script>";
		}
	}


	public function simpan_capaian()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_indikator2', 'Id indikator', 'required');
		$this->form_validation->set_rules('target_capaian', 'Target Penilaian', 'required');
		$this->form_validation->set_rules('capaian', 'Capaian Penilaian', 'required');
		$this->form_validation->set_rules('bobot_capaian', 'bobot Penilaian', 'required');
		$this->form_validation->set_rules('bulan', 'bobot Penilaian', 'required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {

			$target = $this->input->post('target_capaian');
			$capaian = $this->input->post('capaian');
			$bobot = $this->input->post('bobot_capaian');
			$hasil_kinerja = floor((($capaian / $target) * $bobot) * 1000) / 1000;

			$datacapaian = array(
				'id_indikator' => $this->input->post('id_indikator2'),
				'bulan' => $this->input->post('bulan'),
				'target' => $this->input->post('target_capaian'),
				'capaian' => $this->input->post('capaian'),
				'bobot' => $this->input->post('bobot_capaian'),
				'hasil_kinerja' => $hasil_kinerja,
			);

			// print_r($datacapaian);
			// simpan ke database
			$this->capaian->simpan($datacapaian);
			$this->session->set_flashdata('success', "Berhasil disimpan");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}


	public function update_capaian()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('id_capaian', 'Id Capian', 'required');
		$this->form_validation->set_rules('target_capaian', 'target Capian', 'required');
		// $this->form_validation->set_rules('capaian', 'capaian Capian', 'required');
		$this->form_validation->set_rules('bobot_capaian', 'bobot Capian', 'required');
		$this->form_validation->set_rules('bulan', 'bulan Capian', 'required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {



			// echo "Target ".$this->input->post('target_capaian');
			// die();
			$id_capaian = $this->input->post('id_capaian');
			$target = $this->input->post('target_capaian');
			$capaian = $this->input->post('capaian');
			$bobot = $this->input->post('bobot_capaian');
			$hasil_kinerja = floor((($capaian / $target) * $bobot) * 1000) / 1000;
			// $hasil_kinerja = $capaian/$target;

			$datacapaian = array(
				'bulan' => $this->input->post('bulan'),
				'target' => $this->input->post('target_capaian'),
				'capaian' => $this->input->post('capaian'),
				'bobot' => $this->input->post('bobot_capaian'),
				'hasil_kinerja' => $hasil_kinerja,
			);
			// print_r($datacapaian);
			// simpan ke database
			$this->capaian->update($datacapaian, $id_capaian);
			$this->session->set_flashdata('success', "Berhasil Diperbarui");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}

	public function hapus_capaian()
	{
		$id = $this->input->get('id');

		$sec = $this->input->get('sec');

		if (md5(md5(sha1($id))) == $sec) {

			$this->capaian->hapus($id);
			$this->session->set_flashdata('success', "Berhasil dihapus");
			echo "<script>window.history.go(-1);</script>";
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-1);</script>";
		}
	}




	public function cetak()
	{

		$id = $this->input->get('id');
		$token = $this->input->get('token');
		// die();
		if (sha1($id) == $token) {
			$bulan = $this->input->get('bulan');

			$bulan  = substr($bulan, 0, 7);

			$data = [
				'remun_all' => $this->capaian->cetak($bulan, $id),
				'pegawai' => $this->pegawai->find($id)->row()
			];
			// print_r($this->capaian->cetak($bulan)->result());
			// die();
			$this->load->view('remun/cetak', $data);
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-2);</script>";
		}
	}

	public function ajukan()
	{
		$id_capaian = $this->input->get('id_capaian');
		$token = $this->input->get('token');
		$atasan_ke = $this->input->get('atasan_ke');
		$status = $this->input->get('status');


		if (sha1($id_capaian) == $token) {
			$datacapaian = $this->capaian->getById($id_capaian);
			if ($datacapaian->num_rows() > 0) {
				$capaian = $datacapaian->row();

				// if ($status == 0) {
				// 	$datastatus = 1;
				// }else{
				// 	$datastatus = $status.(int)$atasan_ke;
				// }

				$updatecapaian = [
					'status' => (int) $status + 1,
				];

				// print_r($updatecapaian);
				// die();
				$this->capaian->update($updatecapaian, $id_capaian);
				$this->session->set_flashdata('success', "Status Remun disetujui");
				echo "<script>window.history.go(-1);</script>";
			} else {
				$this->session->set_flashdata('warning', "data tidak ditmeukan");
				echo "<script>window.history.go(-1);</script>";
			}
		} else {
			$this->session->set_flashdata('warning', "Token Bermasalah");
			echo "<script>window.history.go(-1);</script>";
		}
	}


	public function simpan()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_jabatan', 'Nama jabatan', 'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('id_unit_kerja', 'Id Unit kerja', 'required');
		$this->form_validation->set_rules('hak_akses_jabatan', 'Hak Akses', 'required');

		$id_unit_kerja = $this->input->post('id_unit_kerja');
		$token = $this->input->post('token');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			// redirect("dashboard/jabatan?id_unit_kerja=$id_unit_kerja&token=$token");
		} else {
			$datajabatan = array(
				'id_unit_kerja' => $this->input->post('id_unit_kerja'),
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'hak_akses_jabatan' => $this->input->post('hak_akses_jabatan'),
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
					'jabatan' => $datajabatan->row(),
					'akses_all' => $this->akses->getAll(),
				];

				$this->load->view('jabatan/edit', $data);
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
		$this->form_validation->set_rules('nama_jabatan', 'Nama jabatan', 'required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('hak_akses_jabatan', 'Nama jabatan', 'required');
		// $id_unit_kerja = $this->input->post('id_unit_kerja');
		// $token = $this->input->post('token');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors('<li class="text-danger">', '</li>');
			$this->session->set_flashdata('error', "$errors");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {

			$datajabatan = array(
				'nama_jabatan' => $this->input->post('nama_jabatan'),
				'hak_akses_jabatan' => $this->input->post('hak_akses_jabatan'),
			);
			$id_jabatan = $this->input->post('id_jabatan');
			// update ke database
			$this->jabatan->update($datajabatan, $id_jabatan);
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




	public function remun2()
	{

		$this->load->view('remun/remun2');
	}




	public function upload_remun2()
	{

		if ($_FILES["upload_excel"]["error"] == 4) {

			$status = 0;
			$pesan = "Tidak ada file yang dipilih";
		} else {

			// cek_session();
			$config['upload_path']          = './uploads/remun';
			$config['allowed_types']        = 'xls';
			$config['max_size']             = 2000;
			// $config['overwrite']             = TRUE;
			

			$dataupload = $_FILES['upload_excel'];
			// print_r($dataupload);
			$Filepath = base_url("./uploads/remun/$dataupload[name]") . PHP_EOL;
			if (file_exists(FCPATH . "./uploads/remun/$dataupload[name]")) {

				$status = 0;
				$pesan = "File Excel Remun sudah ada";
			} else {


				$filefound = 'Belum Adad' . PHP_EOL;


				$this->load->library('upload', $config);

				// Load Library
				if (!$this->upload->do_upload('upload_excel')) {
					$error = array('error' => $this->upload->display_errors());

					$pesan = "Error saat upload";
					$status = 2;
				} else {

					// $status = 1;
					$data = array('upload_data' => $this->upload->data());
					// Load Library
					$data = array('upload_data' => $this->upload->data());

					$Filepath = $data['upload_data']['full_path'];


					$array_nama_file = $data['upload_data']['raw_name'];

					$array_nama_file  = explode("_", $array_nama_file);


					$no_abs = $array_nama_file[2];


					$DPegawai = $this->pegawai->findno_abs($no_abs)->row();

					$tgl_remun = $array_nama_file[3];

					include APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php';
					include APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php';

					try {

						$Spreadsheet = new SpreadsheetReader($Filepath);
						$BaseMem = memory_get_usage();

						$Sheets = $Spreadsheet->Sheets();


						$simpandatapenilaian = array();
						$simpandataindikator = array();


						//Perulangan mulai disini
						//tabel transaksi disini
						$this->db->trans_begin();
						$indikator_error = 1;
						$err = 0;
						foreach ($Sheets as $Index => $Name) {


							//cek nama usulan penilaian di database
							$datapenilaian = $this->penilaian->getByName($Name)->row();





							$idUniq = substr(md5(uniqid(rand(), true)), 2, 7); //Id Remun



							if ($datapenilaian) {

								// echo "Nama Penilaian $Name, max bobotnya $datapenilaian->max_bobot" . "<br>";




								$id_penilaian = $datapenilaian->id_penilaian;
								$max_bobot = $datapenilaian->max_bobot;


								// $datapenilaian = array(
								//     'id_remun' => $idUniq,
								//     'id_penilaian' => $id_penilaian,
								//     'nip' => $DPegawai->nip,
								//     'no_abs' => $no_abs,
								//     'tgl_remun' => $tgl_remun,
								// );

								array_push($simpandatapenilaian, array(
									'id_remun' => $idUniq,
									'id_penilaian' => $id_penilaian,
									'nip' => $DPegawai->nip,
									'no_abs' => $no_abs,
									'tgl_remun' => $tgl_remun,
								));

								// $this->remun->simpan_penilaian($datapenilaian);
								$Spreadsheet->ChangeSheet($Index);

								$simpandatacapaian1 = array();
								$simpandatacapaian2 = array();


								$max_bobot_indikator = 0;
								foreach ($Spreadsheet as $Key => $Row) {






									if ($Key > 2 and $Row[2] != '') {
										# code...
										$Key . ': ';
										if ($Row) {
											// print_r($Row);
											// echo "range nilai 1 ".$Row[6];
											// echo "range nilai 2 ".$Row[7];

											$tgl = $tgl_remun;
											$d1 = strtotime($tgl);
											$d2 = strtotime($this->rangeremun($tgl));
											$min_date = min($d1, $d2);
											$max_date = max($d1, $d2);
											$tgl_pertama1 = Date('Y-m-d', $d1);

											$tgl_pertama2 = Date('Y-m-d', $d2);

											$id_indikator = rand(32, 98) . substr(md5(uniqid(rand(), true)), 2, 7) . $idUniq . rand(32, 98);
											$id_indikator = substr($id_indikator, 0, 11);
											$range_target1 = $Row[6]; //ini buat perawat
											if ($range_target1) {
												$range_target1 = $Row[6];
											} else {
												$range_target1 = "";
											}

											$range_target2 = $Row[7]; //ini buat perawat
											if ($range_target2) {
												$range_target2 = $Row[7];
											} else {
												$range_target2 = "";
											}

											// die();
											// $simpandataindikator = array(
											//     'id_indikator' => $id_indikator,
											//     'id_remun' => $idUniq,
											//     'indikator' =>  $Row[2],
											//     'definisi' => $Row[3],
											//     'target' =>  $Row[4],
											//     'bobot' =>  $Row[5],
											//     'range1' => $tgl_pertama1,
											//     'range2' => $tgl_pertama2,
											//     'range_target1' => $range_target1,
											//     'range_target2' => $range_target2,

											// );

											array_push($simpandataindikator, array(
												'id_indikator' => $id_indikator,
												'id_remun' => $idUniq,
												'indikator' =>  $Row[2],
												'definisi' => $Row[3],
												'target' =>  $Row[4],
												'bobot' =>  $Row[5],
												'range1' => $tgl_pertama1,
												'range2' => $tgl_pertama2,
												'range_target1' => $range_target1,
												'range_target2' => $range_target2,
											));
											// simpan ke database

											//jika penilaian 4 atau perilaku maka tidak di bagi 12 kosongkan saja



											// if ($id_penilaian == '4' && $Row[2] == "Kehadiran" || $Row[2] == "kehadiran") {
											// 	$target_perbulan = '';
											// } else {
											$target_perbulan = $Row[4] / 12;
											// }




											// $this->remun->simpan_indikator($simpandataindikator);

											//ini simpan 1 bulan 

											$simpandatacapaian1 = array(
												'id_indikator' => $id_indikator,
												'bulan' => $tgl_remun,
												'target' => $target_perbulan,
												'bobot' => $Row[5],
												'created_at' => date("Y-m-d H:i:s"),
												'updated_at' => date("Y-m-d H:i:s"),
											);

											// array_push($simpandatacapaian1, array(
											// 	'id_indikator' => $id_indikator,
											//     'bulan' => $tgl_remun,
											//     'target' => $target_perbulan,
											//     'bobot' => $Row[5],
											// ));

											// // simpan ke database
											// $this->capaian->simpan($datacapaian);
											$this->db->insert('tr_capaian', $simpandatacapaian1);



											$i = 1;

											//ini simpan ke 11 bulan otomastis

											while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
												$min_date1 =  Date('Y-m-d', $min_date);
												// array_push($simpandatacapaian2, array(
												$datacapaian = array(
													'id_indikator' => $id_indikator,
													'bulan' => $min_date1,
													'target' => $target_perbulan,
													'bobot' => $Row[5],
													'created_at' => date("Y-m-d H:i:s"),
													'updated_at' => date("Y-m-d H:i:s"),
												);

												// $this->capaian->simpan($datacapaian);
												// $this->db->insert_batch('tr_capaian', $simpandatacapaian1);
												$this->db->insert('tr_capaian', $datacapaian);

												$i++;
											}


											$bobot_indikator = $Row[5];
											$max_bobot_indikator += $bobot_indikator;
											// $max_bobot = $datapenilaian->max_bobot;
											// $id = $datapenilaian->id_penilaian;

											// $max_bobot_indikator = round($max_bobot_indikator, 2);
											// $max_bobot = round($max_bobot, 2);
											// if ($max_bobot_indikator >  $max_bobot) {
											//     $err = $indikator_error++;

											// } else {
											//     $err ="";
											// }

											// echo "Nilai didalammnya " . $bobot_indikator . "<br>";
										} else {
											// var_dump($Row);
										}
									}
								}





								// echo "Total Nilai didalammnya " . $max_bobot_indikator . "<br>";
								if (round($max_bobot_indikator, 2) > round($max_bobot, 2)) {
									// echo "Ada kelebihan <br>";
									$err = $indikator_error++;
								} else {
								}
							} else {
							}
						}


						// $this->pegawai->insert_multiple($data);
						// hapus kembali file .xls yang di upload tadi
						// unlink($_FILES['test']['name']);


						//simpan array multi

						// echo "<br>";
						// echo "<br>";
						// echo "<br>";
						// echo "<br>";
						// print_r($simpandatacapaian2);
						// echo "<br>";
						// echo "<br>";
						$this->db->insert_batch('remun', $simpandatapenilaian);
						$this->db->insert_batch('tr_indikator', $simpandataindikator);
						// $this->db->insert_batch('tr_capaian', $simpandatacapaian1);
						// $this->db->insert_batch('tr_capaian', $simpandatacapaian2);

						if ($this->db->trans_status() === FALSE) {
							$pesan = "Gagal disimpan";
						} else {
							if ($err > 0) {
								$this->db->trans_rollback();
								$status = 0;
								// $pesan = "Bobot Penilaian kelebihan $err ADA kelebihan, Roll back";
								$pesan = "Bobot Penilaian Melebihi batas maksimal";
							} else {
								$this->db->trans_commit();
								$status = 1;
								$pesan = "Berhasil diupload";
							}
						}
					} catch (Exception $E) {
						echo $E->getMessage();
					}
					// echo "<br>";
					$namaFile = $dataupload['name'];
					array_map('unlink', glob(FCPATH . "uploads/remun/$namaFile"));
				}



				// array_map('unlink', glob(FCPATH."uploads/test/$Filepath.*"));
			}



			// $hasil = array(
			// 	'status' => $status,
			// 	'pesan' => $pesan,

			// );
			// echo json_encode($hasil);

		}
		$hasil = array(
			'status' => $status,
			'pesan' => $pesan,
			// 'data'=>$simpandataindikator

		);
		echo json_encode($hasil);
	}


	function rangeremun($datenow)
	{


		$bulan = substr($datenow, 5, 2);
		switch ($bulan) {
			case '01':
				$add = 11;
				break;
			case '02':
				$add = 10;
				break;
			case '03':
				$add = 9;
				break;
			case '04':
				$add = 8;
				break;
			case '05':
				$add = 7;
				break;
			case '06':
				$add = 6;
				break;
			case '07':
				$add = 5;
				break;
			case '08':
				$add = 4;
				break;
			case '09':
				$add = 3;
				break;
			case '10':
				$add = 2;
				break;
			case '11':
				$add = 1;
				break;
			case '12':
				$add = 0;
				break;
			default:
				$add = 1;
				break;
		}




		$date = strtotime(date("Y-m-d", strtotime($datenow)) . " +$add month");
		return $date = date("Y-m-d", $date);
	}


	public function cetak_remun()
	{

		$id = $this->input->get('id');
		$pegawai = $this->pegawai->find($id)->row();

		$bulan = $this->input->get('bulan');

		$bulan  = substr($bulan, 0, 7);

		$data = [
			'remun_all' => $this->capaian->cetak($bulan, $id),
			// 'jumlah'=>$this->capaian->cetak($bulan,$id),
			'pegawai' => $this->pegawai->find($id)->row(),

		];


		$this->load->library('excel');
		//SET PROPERTIES EXCEL
		$this->excel->getProperties()->setCreator("Balai Besar Kesehatan Paru Masyarakat")
			->setLastModifiedBy("Balai Besar Kesehatan Paru Masyarakat")
			->setSubject("Laporan IKI ")
			->setDescription("Hasil Laporan Indikator Kinerja Individu")
			->setKeywords("Laporan IKI")
			->setCategory("Laporan IKI");

		//SET ACTIVE SHEET
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Hasil Laporan IKI');



		//SET BOLD,ITALIC,UNDERLINE,FONT,ALIGN,FORMAT
		$this->excel->getDefaultStyle()->getFont()->setName('Arial');
		$this->excel->getDefaultStyle()->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A9:G9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A8:G8")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->getFont()->setItalic(true);
		// $this->excel->getActiveSheet()->getStyle("A2:A12")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//SET WIDTH & HEIGHT CELL
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);

		//SET CELL HEADER DATA
		$this->excel->getActiveSheet()->setCellValue('A1', "INDIKATOR KINERJA INDIVIDU")->mergeCells('A1:G1');

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);
		$this->excel->getActiveSheet()->getStyle("A1:G1")->applyFromArray($style);





		$this->excel->getActiveSheet()->setCellValue('A3', "NAMA 			: {$pegawai->nama_pegawai} ");
		$this->excel->getActiveSheet()->setCellValue('A4', "NIP 			: {$pegawai->nip2} ");
		$this->excel->getActiveSheet()->setCellValue('A5', "JABATAN 		:{$pegawai->nama_jabatan}");
		$this->excel->getActiveSheet()->setCellValue('A6', "UNIT KERJA 	: {$pegawai->nama_unit_kerja}");

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$this->excel->getActiveSheet()->getStyle("A8:G8")->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->applyFromArray($styleArray);

		$this->excel->getActiveSheet()->setCellValue('A8', "NO.");
		$this->excel->getActiveSheet()->setCellValue('B8', "Indikator Kinerja");
		$this->excel->getActiveSheet()->setCellValue('C8', "Definisi");
		$this->excel->getActiveSheet()->setCellValue('D8', "Target");
		$this->excel->getActiveSheet()->setCellValue('E8', "Capaian");
		$this->excel->getActiveSheet()->setCellValue('F8', "Bobot");
		$this->excel->getActiveSheet()->setCellValue('G8', "Nilai Hasil Kinerja");



		//Datanya disini
		$this->excel->getActiveSheet()->setCellValue('A9', "1.");
		$this->excel->getActiveSheet()->setCellValue('B9', "2");
		$this->excel->getActiveSheet()->setCellValue('C9', "3");
		$this->excel->getActiveSheet()->setCellValue('D9', "4");
		$this->excel->getActiveSheet()->setCellValue('E9', "5");
		$this->excel->getActiveSheet()->setCellValue('F9', "6");
		$this->excel->getActiveSheet()->setCellValue('G9', "(5/4)x6");


		//Datanya disini untuk Penilaian

		//Header Looping Penilaian
		$no = 1;
		$i = 10;
		$i_jumlah = $i + 1;
		$n = 1;
		$subtotalhasil_kinerja = 0;

		foreach ($data['remun_all']->result() as $key => $value) {

			$penilaian = $this->penilaian->find($value->id_penilaian)->row();
			switch ($no) {
				case '1':
					$alf = "A";
					break;
				case '2':
					$alf = "B";
					break;
				case '3':
					$alf = "C";
					break;
				case '4':
					$alf = "D";
					break;
				case '5':
					$alf = "E";
					break;
				case '6':
					$alf = "F";
					break;
				case '7':
					$alf = "G";
					break;
				default:
					# code...
					break;
			}

			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);


			$this->excel->getActiveSheet()->setCellValue("A{$i}", "{$alf}");
			$this->excel->getActiveSheet()->setCellValue("B{$i}", "{$penilaian->nama_penilaian}")->mergeCells("B{$i}:G{$i}");


			$no++;

			$n++;


			$i++;
			$i_jumlah++;






			//Star looping remun
			$result1 = $this->capaian->getByIdRemunJoin($bulan, $value->id_remun);
			$no_remun = 1;
			$totalbobot = 0;
			$totalhasil_kinerja = 0;

			$rowNumber = $i;

			foreach ($result1->result() as $detail1) {
				$capaian = $this->capaian->getCapaianByIndikator($detail1->id_indikator, $detail1->bulan)->row();
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
				$this->excel->getActiveSheet()->getStyle("A{$rowNumber}:G{$rowNumber}")->applyFromArray($styleArray);
				$this->excel->getActiveSheet()->getStyle("A{$rowNumber}:G{$rowNumber}")->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->setCellValue("A{$rowNumber}", "{$no_remun}");
				$this->excel->getActiveSheet()->setCellValue("B{$rowNumber}", "{$detail1->indikator}");
				$this->excel->getActiveSheet()->setCellValue("C{$rowNumber}", "{$detail1->definisi}");
				$this->excel->getActiveSheet()->setCellValue("D{$rowNumber}", "{$capaian->target}");
				$this->excel->getActiveSheet()->setCellValue("E{$rowNumber}", "{$capaian->capaian}");
				$this->excel->getActiveSheet()->setCellValue("F{$rowNumber}", "{$capaian->bobot}");
				// $this->excel->getActiveSheet()->setCellValue("G{$rowNumber}", "{$capaian->hasil_kinerja}");
				$this->excel->getActiveSheet()->setCellValue("G{$rowNumber}", "=(E{$rowNumber}/D{$rowNumber}*F{$rowNumber})");



				$no_remun++;
				$rowNumber++;
				$i++;
				$i_jumlah++;

				$totalbobot += $capaian->bobot;
				$totalhasil_kinerja += $capaian->hasil_kinerja;
			}

			//Ini Perhitungan Kebawah

			$sumTotBobot = $i - 1;
			$sumTotBobot2 = $no_remun - 2;
			$yeuh = $sumTotBobot - $sumTotBobot2;


			//End Ini Perhitungan Kebawah


			$a = [];
			array_push($a, "G{$i}");


			//Jumlah Per Penilaian
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue("B{$i}", "Jumlah $penilaian->nama_penilaian")->mergeCells("B{$i}:C{$i}");

			$this->excel->getActiveSheet()->setCellValue("F{$i}", "=SUM(F{$yeuh}:F{$sumTotBobot})");


			$this->excel->getActiveSheet()->setCellValue("G{$i}", "=SUM(G{$yeuh}:G{$sumTotBobot})");


			$this->excel->getActiveSheet()->setCellValue("H{$i}", "=G{$i}");


			//End Jumlah Per Penilaian


			$no_remun++;
			$rowNumber++;
			$i++;
			$i_jumlah++;


			$subtotalhasil_kinerja += $totalhasil_kinerja;
		}
		//End Looping Header Penilaian




		//Data atasan 
		$where1 = [
			'nip_pegawai' => $id,
			'pejabat_penilai' => 1
		];
		$pejabat_penilai = $this->atasan->getByNipPegawaiAndNipAtasanWhere($where1)->row();
		$where2 = [
			'nip_pegawai' => $id,
			'atasan_langsung' => 1
		];
		$atasan_langsung = $this->atasan->getByNipPegawaiAndNipAtasanWhere($where2)->row();


		//Total Nilai Keseluruhan
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue("B{$i}", "Total Nilai Kerja Individu")->mergeCells("B{$i}:C{$i}");
		$subTotalAll = $i - 1;
		// $this->excel->getActiveSheet()->setCellValue("G{$i}", "{$subtotalhasil_kinerja}");
		$this->excel->getActiveSheet()->setCellValue("G{$i}", "=sum(H11:H{$subTotalAll})");

		//End Total Nilai Keseluruhan



		$colttd1 = $i + 2;
		$nama1 = $colttd1 + 5;
		$nip1 = $nama1 + 1;
		$colttd2 = $i + 2;
		$nama2 = $colttd2 + 5;
		$colttd3 = $i + 7;
		$nama3 = $colttd3 + 5;
		$nip3 = $nama3 + 1;
		//Ini Buat ttd

		//Pegawai
		$this->excel->getActiveSheet()->setCellValue("B$colttd1", "Pegawai yang dinilai");
		$this->excel->getActiveSheet()->setCellValue("B$nama1", "$pegawai->nama_pegawai");
		$this->excel->getActiveSheet()->getStyle("B$nip1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->setCellValue("B$nip1", "NIP. $pegawai->nip2");
		//End Pegawai


		$this->excel->getActiveSheet()->setCellValue("D$colttd2", "Pejabat Penilai")->mergeCells("D{$colttd2}:G{$colttd2}");
		$this->excel->getActiveSheet()->setCellValue("D{$nama2}", "$pejabat_penilai->nama_pegawai")->mergeCells("D{$nama2}:G{$nama2}");

		$this->excel->getActiveSheet()->setCellValue("D$nip1", "NIP. $pejabat_penilai->nip2")->mergeCells("D{$nip1}:G{$nip1}");

		if ($atasan_langsung) {
			# code...
			$this->excel->getActiveSheet()->setCellValue("C$colttd3", "Atasan Langsung Pejabat Penilai");
			$this->excel->getActiveSheet()->setCellValue("C$nama3", "$atasan_langsung->nama_pegawai");
			$this->excel->getActiveSheet()->getStyle("C$nip3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$this->excel->getActiveSheet()->setCellValue("C$nip3", "NIP. $atasan_langsung->nip2");
		}



		//End TTD





		//CLEAN THE OUTPUT BUFFER
		ob_end_clean();
		//OUTPUT EXCEL
		$filename = "Laporan IKI {$pegawai->nama_pegawai} bulan {$bulan}.xls";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function cetak_remun_tmp()
	{

		$id = $this->input->get('id');
		$pegawai = $this->pegawai->find($id)->row();

		$bulan = $this->input->get('bulan');

		$bulan  = substr($bulan, 0, 7);

		$data = [
			'remun_all' => $this->capaian->cetak($bulan, $id),
			// 'jumlah'=>$this->capaian->cetak($bulan,$id),
			'pegawai' => $this->pegawai->find($id)->row(),

		];


		$this->load->library('excel');
		//SET PROPERTIES EXCEL
		$this->excel->getProperties()->setCreator("Balai Besar Kesehatan Paru Masyarakat")
			->setLastModifiedBy("Balai Besar Kesehatan Paru Masyarakat")
			->setSubject("Laporan IKI ")
			->setDescription("Hasil Laporan Indikator Kinerja Individu")
			->setKeywords("Laporan IKI")
			->setCategory("Laporan IKI");

		//SET ACTIVE SHEET
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('Hasil Laporan IKI');



		//SET BOLD,ITALIC,UNDERLINE,FONT,ALIGN,FORMAT
		$this->excel->getDefaultStyle()->getFont()->setName('Arial');
		$this->excel->getDefaultStyle()->getFont()->setSize(10);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A9:G9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A8:G8")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->getFont()->setItalic(true);
		// $this->excel->getActiveSheet()->getStyle("A2:A12")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//SET WIDTH & HEIGHT CELL
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);

		//SET CELL HEADER DATA
		$this->excel->getActiveSheet()->setCellValue('A1', "INDIKATOR KINERJA INDIVIDU")->mergeCells('A1:G1');

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);
		$this->excel->getActiveSheet()->getStyle("A1:G1")->applyFromArray($style);





		$this->excel->getActiveSheet()->setCellValue('A3', "NAMA 			: {$pegawai->nama_pegawai} ");
		$this->excel->getActiveSheet()->setCellValue('A4', "NIP 			: {$pegawai->nip2} ");
		$this->excel->getActiveSheet()->setCellValue('A5', "JABATAN 		:{$pegawai->nama_jabatan}");
		$this->excel->getActiveSheet()->setCellValue('A6', "UNIT KERJA 	: {$pegawai->nama_unit_kerja}");

		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$this->excel->getActiveSheet()->getStyle("A8:G8")->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle('A8:G8')->getAlignment()->setWrapText(true);
		$this->excel->getActiveSheet()->getStyle("A9:G9")->applyFromArray($styleArray);

		$this->excel->getActiveSheet()->setCellValue('A8', "NO.");
		$this->excel->getActiveSheet()->setCellValue('B8', "Indikator Kinerja");
		$this->excel->getActiveSheet()->setCellValue('C8', "Definisi");
		$this->excel->getActiveSheet()->setCellValue('D8', "Target");
		$this->excel->getActiveSheet()->setCellValue('E8', "Capaian");
		$this->excel->getActiveSheet()->setCellValue('F8', "Bobot");
		$this->excel->getActiveSheet()->setCellValue('G8', "Nilai Hasil Kinerja");



		//Datanya disini
		$this->excel->getActiveSheet()->setCellValue('A9', "1.");
		$this->excel->getActiveSheet()->setCellValue('B9', "2");
		$this->excel->getActiveSheet()->setCellValue('C9', "3");
		$this->excel->getActiveSheet()->setCellValue('D9', "4");
		$this->excel->getActiveSheet()->setCellValue('E9', "5");
		$this->excel->getActiveSheet()->setCellValue('F9', "6");
		$this->excel->getActiveSheet()->setCellValue('G9', "(5/4)x6");


		//Datanya disini untuk Penilaian

		//Header Looping Penilaian
		$no = 1;
		$i = 10;
		$i_jumlah = $i + 1;
		$n = 1;
		$subtotalhasil_kinerja = 0;

		foreach ($data['remun_all']->result() as $key => $value) {

			$penilaian = $this->penilaian->find($value->id_penilaian)->row();
			switch ($no) {
				case '1':
					$alf = "A";
					break;
				case '2':
					$alf = "B";
					break;
				case '3':
					$alf = "C";
					break;
				case '4':
					$alf = "D";
					break;
				case '5':
					$alf = "E";
					break;
				case '6':
					$alf = "F";
					break;
				case '7':
					$alf = "G";
					break;
				default:
					# code...
					break;
			}

			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);


			$this->excel->getActiveSheet()->setCellValue("A{$i}", "{$alf}");
			$this->excel->getActiveSheet()->setCellValue("B{$i}", "{$penilaian->nama_penilaian}")->mergeCells("B{$i}:G{$i}");



			$no++;

			$n++;


			$i++;
			$i_jumlah++;





			//Star looping remun
			$result1 = $this->capaian->getByIdRemunJoin($bulan, $value->id_remun);
			$no_remun = 1;
			$totalbobot = 0;
			$totalhasil_kinerja = 0;

			$rowNumber = $i;

			foreach ($result1->result() as $detail1) {
				$capaian = $this->capaian->getCapaianByIndikator($detail1->id_indikator, $detail1->bulan)->row();
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
				$this->excel->getActiveSheet()->getStyle("A{$rowNumber}:G{$rowNumber}")->applyFromArray($styleArray);
				$this->excel->getActiveSheet()->getStyle("A{$rowNumber}:G{$rowNumber}")->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->setCellValue("A{$rowNumber}", "{$no_remun}");
				$this->excel->getActiveSheet()->setCellValue("B{$rowNumber}", "{$detail1->indikator}");
				$this->excel->getActiveSheet()->setCellValue("C{$rowNumber}", "{$detail1->definisi}");
				$this->excel->getActiveSheet()->setCellValue("D{$rowNumber}", "{$capaian->target}");
				$this->excel->getActiveSheet()->setCellValue("E{$rowNumber}", "{$capaian->capaian}");
				$this->excel->getActiveSheet()->setCellValue("F{$rowNumber}", "{$capaian->bobot}");
				$this->excel->getActiveSheet()->setCellValue("G{$rowNumber}", "{$capaian->hasil_kinerja}");

				$no_remun++;
				$rowNumber++;
				$i++;
				$i_jumlah++;

				$totalbobot += $capaian->bobot;
				$totalhasil_kinerja += $capaian->hasil_kinerja;
			}

			//Jumlah Per Penilaian
			$styleArray = array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);
			$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->setCellValue("B{$i}", "Jumlah $penilaian->nama_penilaian")->mergeCells("B{$i}:C{$i}");

			$this->excel->getActiveSheet()->setCellValue("F{$i}", "{$totalbobot}");
			$this->excel->getActiveSheet()->setCellValue("G{$i}", "{$totalhasil_kinerja}");
			//End Jumlah Per Penilaian


			$no_remun++;
			$rowNumber++;
			$i++;
			$i_jumlah++;


			$subtotalhasil_kinerja += $totalhasil_kinerja;
		}

		//End Looping Header Penilaian


		//Data atasan 
		$where1 = [
			'nip_pegawai' => $id,
			'pejabat_penilai' => 1
		];
		$pejabat_penilai = $this->atasan->getByNipPegawaiAndNipAtasanWhere($where1)->row();
		$where2 = [
			'nip_pegawai' => $id,
			'atasan_langsung' => 1
		];
		$atasan_langsung = $this->atasan->getByNipPegawaiAndNipAtasanWhere($where2)->row();


		//Total Nilai Keseluruhan
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->applyFromArray($styleArray);
		$this->excel->getActiveSheet()->getStyle("A{$i}:G{$i}")->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue("B{$i}", "Total Nilai Kerja Individu")->mergeCells("B{$i}:C{$i}");
		$this->excel->getActiveSheet()->setCellValue("G{$i}", "{$subtotalhasil_kinerja}");
		//End Total Nilai Keseluruhan



		$colttd1 = $i + 2;
		$nama1 = $colttd1 + 5;
		$nip1 = $nama1 + 1;
		$colttd2 = $i + 2;
		$nama2 = $colttd2 + 5;
		$colttd3 = $i + 7;
		$nama3 = $colttd3 + 5;
		$nip3 = $nama3 + 1;
		//Ini Buat ttd

		//Pegawai
		$this->excel->getActiveSheet()->setCellValue("B$colttd1", "Pegawai yang dinilai");
		$this->excel->getActiveSheet()->setCellValue("B$nama1", "$pegawai->nama_pegawai");
		$this->excel->getActiveSheet()->getStyle("B$nip1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->setCellValue("B$nip1", "NIP. $pegawai->nip2");
		//End Pegawai


		$this->excel->getActiveSheet()->setCellValue("D$colttd2", "Pejabat Penilai")->mergeCells("D{$colttd2}:G{$colttd2}");
		$this->excel->getActiveSheet()->setCellValue("D{$nama2}", "$pejabat_penilai->nama_pegawai")->mergeCells("D{$nama2}:G{$nama2}");

		$this->excel->getActiveSheet()->setCellValue("D$nip1", "NIP. $pejabat_penilai->nip2")->mergeCells("D{$nip1}:G{$nip1}");

		if ($atasan_langsung) {
			# code...
			$this->excel->getActiveSheet()->setCellValue("C$colttd3", "Atasan Langsung Pejabat Penilai");
			$this->excel->getActiveSheet()->setCellValue("C$nama3", "$atasan_langsung->nama_pegawai");
			$this->excel->getActiveSheet()->getStyle("C$nip3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$this->excel->getActiveSheet()->setCellValue("C$nip3", "NIP. $atasan_langsung->nip2");
		}



		//End TTD





		//CLEAN THE OUTPUT BUFFER
		ob_end_clean();
		//OUTPUT EXCEL
		$token = $this->input->get('token');
		$filename = "Tmp{$token}.xls";
		// header('Content-Type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment;filename="' . $filename . '"');
		// header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save($filename);

		echo json_encode($filename);
	}
}
