<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pegawai_m', 'pegawai');
        $this->load->model('Indikator_m', 'indikator');
        $this->load->model('Login_m', 'login');
        // $this->load->model('Capaian_m','capaian');


    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $nip = $this->input->get('id');
                $level = $this->input->get('level');
                // cek key header yg dikirimkan oleh user
                $headers = apache_request_headers();
                if (isset($headers['key'])) {
                    $headerskey = $headers['key'];
                } else {
                    $headerskey = $this->input->get('key');
                    // $headerskey = "bbkpm2019";
                    # code...
                }

                // Data header dari session atau dari database
                $databaseheader = [
                    'key' => "bbkpm2019"
                ];



                // jika header tidak sama 
                if ($headerskey ==  $databaseheader['key']) {

                    // jika dalam prosess request id tidak ada maka tampilkan semua
                    // $this->pegawai->getAll()->result()
                    if ($nip == NULL) {

                        $response = $this->input->get('cmd');
                        if ($this->input->get('cmd') == 'select2') {
                            $search = $this->input->get('search');
                            $this->db->like('nama_pegawai', $search);
                            $data = $this->db->get('pegawai')->result_array();
                            $list = array();
                            $key = 0;

                            foreach ($data as $row) {
                                $list[$key]['id'] = $row['nip'];
                                $list[$key]['text'] = $row['nama_pegawai'];
                                $key++;
                            }
                            // echo json_encode($list);
                            // $response = json_encode($list) ;
                            $response = $list;
                        } else {
                            $return = array(
                                "total" => $this->pegawai->getAll()->num_rows(),
                                "records" => $this->pegawai->getAll()->result()
                            );
                            $response = str_replace('"nip":', '"recid":', json_encode($return));
                        }


                        $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                    } else {
                        // $response = $this->pegawai->find($nip)->row();
                        $where = [
                            'nip' => $nip,
                            'level' => $level
                        ];
                        // $tgl_absen="2020-05-04";
                        $tgl_absen = date('Y-m-d');
                        $response = [
                            'pegawai' => $this->pegawai->findwhere($where)->row(),
                            // 'indikator'=>$this->indikator->getAllByIdpegawai($nip)->result(),
                            'Datalogin' => $this->login->getByNipPegawai($nip)->result(),
                            'wfh_telah_diajukan' => $this->db->query("SELECT id_wfh from ref_wfh where id_pegawai='$nip' AND tgl_absen='$tgl_absen' AND status='1' ")->num_rows(),
                            'wfh_hari_ini_aktif' => $this->db->query("SELECT id_wfh from ref_wfh where id_pegawai='$nip' AND tgl_absen='$tgl_absen' AND status='0' ")->num_rows(),
                            'wfh_hari_ini_setuju' => $this->db->query("SELECT id_wfh from ref_wfh where id_pegawai='$nip' AND tgl_absen='$tgl_absen' AND status='2' ")->num_rows(),
                            'absen_pertengahan' => $this->db->query("SELECT id_wfh from ref_wfh where jam_absen_pertengahan!='00:00:00' AND id_pegawai='$nip' AND tgl_absen='$tgl_absen' AND status='0' ")->num_rows()
                            // 'absen_pulang' => $this->db->query("SELECT id_wfh from ref_wfh where jam_absen_pulang!='00:00:00'  AND id_pegawai='$nip'  AND tgl_absen='$tgl_absen' AND status='0'  ")->num_rows()
                        ];

                        $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                    }
                } else {
                    $response = ['status' => 401, 'pesan' => "API Key tidak ditemukan"];
                    $this->output
                        ->set_status_header(401)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                        ->_display();
                    exit;
                }


                break;

            case 'POST':
                $headers = apache_request_headers();
                if (isset($headers['key'])) {
                    $headerskey = $headers['key'];
                } else {
                    $headerskey = $this->input->get('key');
                    // $headerskey = "bbkpm2019";
                    # code...
                }

                // Data header dari session atau dari database
                $databaseheader = [
                    'key' => "bbkpm2019"
                ];



                echo $nama_pegawai = $this->input->post('fname');
                $nik = $this->input->post('lname');
                // die();
                $datapegawai = array(
                    'nip_pegawai' => $nama_pegawai,
                    'nik' => $nik,
                    'id_unit_kerja' => 42,
                    'id_jabatan' => 48,


                );

                // simpan ke database
                $this->pegawai->simpan($datapegawai);
                $response = ['status' => 200, 'data' => $datapegawai];
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
                break;

            default:
                $response = ['status' => 400, 'pesan' => "REQUEST METHOD TIDAK DIKETAHUI"];
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
                break;
        }
    }

    public function api_pegawai() //Api ini digunakan untuk khusus select2
    {
        $search = $_GET['search'];

        // $sql = "SELECT * FROM pegawai WHERE nama_pegawai LIKE '%$search%' ORDER BY nama_pegawai ASC";
        $sql = "
        SELECT
        *
        FROM
        pegawai
        WHERE nama_pegawai LIKE '%$search%' ORDER BY nama_pegawai ASC
        ";
        $result = $this->db->query($sql);
        // print_r($result);
        if ($result->num_rows() > 0) {
            $list = array();
            $key = 0;

            foreach ($result->result_array() as $row) {
                $list[$key]['id'] = $row['nip'];
                $list[$key]['text'] = $row['nama_pegawai'];
                $key++;
            }
            echo json_encode($list);
        } else {
            echo "hasil kosong";
        }
    }
}
