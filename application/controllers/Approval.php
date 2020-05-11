<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Admin_m', 'admin');
    $this->load->model('Pegawai_m', 'pegawai');
    $this->load->model('Atasan_m', 'atasan');
    $this->load->model('Remun_m', 'remun');

    // cek_session();
  }

  public function index()
  {
    $nip_atasan = $this->session->nip;

    $data = [

      // 'detail_remun' => $this->atasan->getByNIPAtasan($nip_atasan)
      'detail_remun' => $this->remun->getcapaianByIdAtasan($nip_atasan)
    ];


    $this->load->view('approval/index', $data);
    // echo "ASJSSJJ";


  }


  public function biodata()
  {
  }

  public function remun()
  {
    cek_session();
    $this->load->model('Remun_m', 'remun');

    $nip_atasan = $this->session->nip;

    $nip = $this->input->get('id');
    $pegawai =  $this->pegawai->find($nip)->row();
    $dataatasan = $this->atasan->getByNipPegawaiAndNipAtasan($nip_atasan, $nip)->row();


    $tahun = $this->input->get('tahun');


    if ($tahun) {
      $thn = $tahun;
    } else {

      $thn = substr(date('Y-m-d'), 0, 4);
      # code...
    }







    $data = array(
      'pegawai' => $pegawai,
      'atasan' => $dataatasan,
      'tahun' => $thn,
      'remun_all' => $this->remun->getByNIPAndThn($nip, $thn),

      // 'bulan'=>['januari','februari','maret']
    );

    // $this->load->view('approval/remun', $data);
    $this->load->view('approval/remun2', $data);
  }


  public function pegawai()
  {
    $nip_atasan = $this->session->nip;

    $data = [

      'atasan_all' => $this->atasan->getByNIPAtasan($nip_atasan)
    ];


    $this->load->view('approval/pegawai', $data);
  }


  public function wfh()
  {
    if ($this->session->has_userdata('login_wfh') != 1) {
      $this->session->set_flashdata('success', 'Anda sudah login');
      // echo "Sudah Login";
      redirect('wfh/login');
    }
    $nip_atasan = $this->session->nip;

    $data = [
      'jml_bawahan' => $this->db->get_where('atasan', ['nip_atasan' => $nip_atasan])->num_rows(),
      'detail_wfh' => $this->remun->getcapaianByIdAtasanWHF($nip_atasan)
    ];


    $this->load->view('approval/wfh', $data);
  }
  public function wfh_detail()
  {
    $nip_atasan = $this->session->nip;
    $id_wfh = $this->input->get('id');
    $nip = $this->input->get('nip');
    $pegawai =  $this->pegawai->find($nip)->row();
    $data = [
      'detail_wfh' => $this->remun->getcapaianByIdAtasanWHF($nip_atasan),
      'pegawai' => $pegawai,
      'id_wfh' => $id_wfh,
      'nip' => $nip,
      'jml_bawahan' => $this->db->get_where('atasan', ['nip_atasan' => $nip_atasan])->num_rows(),
      'nip_atasan' => $nip_atasan
    ];


    $this->load->view('approval/detail_wfh', $data);
  }

  public function approved_wfh()
  {

    //find id wfh
    $this->load->model('Wfh_m', 'wfh');
    $this->load->library('form_validation');


    $this->form_validation->set_rules('nilai_kinerja', 'nilai kinerja', 'required|max_length[3]');
    $this->form_validation->set_rules('catatan', 'catatan', 'required');
    $this->form_validation->set_rules('approved_by', 'approved by', 'required');

    $id_wfh = $this->input->post('id_wfh');

    if ($this->form_validation->run() === FALSE) {
      $data['status'] = 2;
      // $data['respon'] = "Data Nilai Kerja atau catatan tidak boleh kosong";
      $data['respon'] = validation_errors('<li class="text-danger">', '</li>');
    } else {
      # code...
      $data['request'] = $_POST;
      $data['total_record'] = $this->wfh->find($id_wfh)->num_rows();
      $data['record'] = $this->wfh->find($id_wfh)->row();
      if ($data['total_record'] > 0) {
        $where = ['id_wfh' => $id_wfh];
        $dataPost = [
          'nilai_kinerja' => $this->input->post('nilai_kinerja'),
          'catatan' => $this->input->post('catatan'),
          'approved_by' => $this->input->post('approved_by'),
          'status' => 2,
        ];
        $this->wfh->update($dataPost, $where);
        $data['respon'] = "ada";
        $data['status'] = 1;
      } else {
        $data['status'] = 2;
        $data['respon'] = "ada tidak ada";
        # code...
      }
    }


    $response = $data;
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;
  }

  public function api_getWfh_where_idwfh()
  {

    $wfh = $this->input->get('wfh');
    if ($wfh != NULL) {
      $result = array(
        'wfh' => $wfh,
        'data' => $this->db->get_where('ref_wfh', ['id_wfh' => $wfh])->result(),
      );
      $response = $result;
      $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;
    } else {

      $this->db->order_by('tgl_absen', 'ASC');
      $data =  $this->db->get('ref_wfh')->result();
      $result = array(
        'data' => $data,

      );
      $response = $result;
      $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;
    }
  }

  public function laporan_pilihan() {
    $id_wfh = explode(',',$this->input->post('id_wfh'));
    $this->load->library('M_pdf');
    foreach ($id_wfh as $key => $value) {
      $where['id_wfh'] = $value;
      $data['data'] = $this->remun->laporan_wfh($where);
      $laporan = $this->load->view('approval/laporan.php', $data, TRUE);
      $pdf = $this->m_pdf->load();

      $pdf->AddpageByArray(array(
            'orientation' => 'P',
            'mgl' => '15',
            'mgb' => '15',
            'mgr' => '15',
            'mgt' => '15',
            'mgh' => '10',
            'mgf' => '10',
            'newformat' => array(210,330)));
      $pdf->WriteHTML($laporan);
    }
    $pdf->Output('laporan',"I");
  }

  public function rekap() {
    $this->load->library('M_pdf');
    $where['a'] = $this->session->nip;
    $where['b'] = $this->session->nip;
    $where['begin'] = $this->input->post('begin');
    $where['end'] = $this->input->post('end');
    $where['c'] = $this->session->nip;
    $data['data'] = $this->remun->rekap($where);
    $laporan = $this->load->view('approval/rekap.php', $data, TRUE);
	
    $pdf = $this->m_pdf->load();

    $pdf->AddpageByArray(array(
          'orientation' => 'P',
          'mgl' => '15',
          'mgb' => '15',
          'mgr' => '15',
          'mgt' => '15',
          'mgh' => '10',
          'mgf' => '10',
          'newformat' => array(210,330)));
    $pdf->WriteHTML($laporan);
    $pdf->Output('laporan',"I");
  }
}
