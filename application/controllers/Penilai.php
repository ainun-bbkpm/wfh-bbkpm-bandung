<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilai extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    // $this->load->model('Admin_m','admin');
    $this->load->model('Pegawai_m', 'pegawai');
    $this->load->model('Atasan_m', 'atasan');
    cek_session();
  }

  public function index()
  {
    $nip_atasan = $this->session->nip;
    $data = [

      'atasan_all' => $this->atasan->getByNIPAtasan($nip_atasan)
    ];
    $this->load->view('penilai/index', $data);
    // echo "ASJSSJJ";
  }

  public function remun()
  {
    cek_session();
    $this->load->model('Remun_m', 'remun');
    $nip = $this->input->get('id');
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

    $this->load->view('penilai/remun', $data);
  }
}
