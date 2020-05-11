<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // $this->load->model('Admin_m','admin');
        // $this->load->model('Pegawai_m','pegawai');

        // cek_session();


    }

    public function index()
    {
        // cek_session();

        $this->load->view('absensi/index');
    }

    public function simpan()
    {
        cek_session();
        $config['upload_path']          = './uploads/absensi';
        $config['allowed_types']        = 'xls';
        $config['max_size']             = 2000;
        $this->load->library('upload', $config);
        // Load Library
        if (!$this->upload->do_upload('file_absensi')) {
            $error = array('error' => $this->upload->display_errors());
            $status = 2;
            // echo json_encode($error);
            // $this->load->view('upload_form', $error);
        } else {


            $dataupload = array('upload_data' => $this->upload->data());
            // print_r($dataupload);
            // echo json_encode($dataupload);
            $status = 1;
            // $Filepath = $_FILES['file_absensi']['name'];
            $Filepath = $dataupload['upload_data']['full_path'];
            $namaFile = $dataupload['upload_data']['file_name'];
            include APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php';
            include APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php';
            // date_default_timezone_set('UTC');

            try {
                $Spreadsheet = new SpreadsheetReader($Filepath);
                // $BaseMem = memory_get_usage();

                $Sheets = $Spreadsheet->Sheets();

                // echo '---------------------------------'.PHP_EOL; 
                // echo 'Spreadsheets:'.PHP_EOL;
                // print_r($Sheets);
                // echo '---------------------------------'.PHP_EOL;
                // echo '---------------------------------'.PHP_EOL;
                $data = array();
                foreach ($Sheets as $Index => $Name) {
                    // echo '---------------------------------'.PHP_EOL;
                    // echo '*** Sheet '.$Name.' ***'.PHP_EOL;
                    // echo '---------------------------------'.PHP_EOL;

                    // $Time = microtime(true);

                    $Spreadsheet->ChangeSheet($Index);

                    foreach ($Spreadsheet as $Key => $Row) {
                        if ($Key > 2 and $Name == "Sheet1" and $Row[1] != "") {
                            // echo $Name." ".$Key.': ';
                            if ($Row) {
                                // print_r($Row);
                                // echo "<br>";
                                // echo "no.abs ".$Row[1];
                                // echo "<br>";
                                array_push($data, array(

                                    'no_abs' => $Row[1], // Insert data nama dari kolom B di excel
                                    'tgl_absensi' => $_POST['date_absensi'],
                                    'nama_pegawai' => $Row[2], // Insert data nama dari kolom B di excel
                                    'terlambat' => $Row[3],
                                    'pulang_cepat' => $Row[4],
                                    'jumlah1' => $Row[5],
                                    'sakit' => $Row[6],
                                    'izin' => $Row[7],
                                    'alpa' => $Row[8],
                                    'cuti' => $Row[9],
                                    'dl_hari' => $Row[10],
                                    'll' => $Row[11],
                                    'kehadiran' => $Row[12],
                                    'hadir' => $Row[15],
                                    'surat_sakit' => $Row[16],
                                    'dirawat' => $Row[17],
                                    'dl_menit' => $Row[18],
                                    'c_tahunan' => $Row[19],
                                    'jumlah2' => $Row[20],
                                    'hari' => $Row[21],
                                    'jumlah_keterlambatan' => $Row[23],
                                    'jumlah_kerja_menit' => $Row[24],
                                    'created_at' => date("Y-m-d H:i:s")

                                ));
                            } else {
                                // var_dump($Row);
                            }
                            // $CurrentMem = memory_get_usage();

                            // echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
                            // echo '---------------------------------'.PHP_EOL;

                            if ($Key && ($Key % 500 == 0)) {
                                // echo '---------------------------------'.PHP_EOL;
                                // echo 'Time: '.(microtime(true) - $Time);
                                // echo '---------------------------------'.PHP_EOL;
                            }
                        }
                    }

                    // echo PHP_EOL.'---------------------------------'.PHP_EOL;
                    // echo 'Time: '.(microtime(true) - $Time);
                    // echo PHP_EOL;

                    // echo '---------------------------------'.PHP_EOL;
                    // echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
                    // echo '---------------------------------'.PHP_EOL;
                }


                $this->db->insert_batch('ref_absensi', $data);
                // hapus kembali file .xls yang di upload tadi
                // unlink($_FILES['test']['name']);


                // echo $namaFile = $dataupload['file_name'];
                array_map('unlink', glob(FCPATH . "uploads/absensi/$namaFile"));
            } catch (Exception $E) {
                echo $E->getMessage();
            }

            // $this->session->set_flashdata('success', "Berhasil Diupload");
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
            // echo "<script>window.history.go(-1);</script>";
            // echo $namaFile = $_FILES['file_absensi']['name'];

        }

        $hasil = array(
            'status' => $status,
            'pesan' => 'Berhasil Diupload',

        );
        echo json_encode($hasil);
    }


    public function simpanv2()
    {
        cek_session();
        $config['upload_path']          = './uploads/absensi';
        $config['allowed_types']        = 'xls';
        $config['max_size']             = 2000;
        $this->load->library('upload', $config);
        // Load Library
        if (!$this->upload->do_upload('file_absensi')) {
            $error = array('error' => $this->upload->display_errors());
            $status = 2;
            // echo json_encode($error);
            // $this->load->view('upload_form', $error);
        } else {


            $dataupload = array('upload_data' => $this->upload->data());
            // print_r($dataupload);
            // echo json_encode($dataupload);
            $status = 1;
            // $Filepath = $_FILES['file_absensi']['name'];
            $Filepath = $dataupload['upload_data']['full_path'];
            $namaFile = $dataupload['upload_data']['file_name'];
            include APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php';
            include APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php';
            // date_default_timezone_set('UTC');

            try {
                $Spreadsheet = new SpreadsheetReader($Filepath);
                // $BaseMem = memory_get_usage();

                $Sheets = $Spreadsheet->Sheets();

                // echo '---------------------------------'.PHP_EOL; 
                // echo 'Spreadsheets:'.PHP_EOL;
                // print_r($Sheets);
                // echo '---------------------------------'.PHP_EOL;
                // echo '---------------------------------'.PHP_EOL;
                $data = array();
                foreach ($Sheets as $Index => $Name) {
                    // echo '---------------------------------'.PHP_EOL;
                    // echo '*** Sheet '.$Name.' ***'.PHP_EOL;
                    // echo '---------------------------------'.PHP_EOL;

                    // $Time = microtime(true);

                    $Spreadsheet->ChangeSheet($Index);

                    foreach ($Spreadsheet as $Key => $Row) {
                        if ($Key > 2 and $Name == "Sheet1" and $Row[1] != "") {
                            // echo $Name." ".$Key.': ';
                            if ($Row) {
                                // print_r($Row);
                                // echo "<br>";
                                // echo "no.abs ".$Row[1];
                                // echo "<br>";
                                array_push($data, array(

                                    'no_abs' => $Row[16], // Insert data nama dari kolom B di excel
                                    'tgl_absensi' => $_POST['date_absensi'],
                                    'nama_pegawai' => $Row[2], // Insert data nama dari kolom B di excel
                                    'terlambat' => $Row[3],
                                    'pulang_cepat' => $Row[12],
                                    'jumlah1' => $Row[5],
                                    'sakit' => $Row[3],
                                    'izin' => $Row[4],
                                    'alpa' => $Row[5],
                                    'cuti' => $Row[9],
                                    'dl_hari' => '',
                                    'll' => $Row[11],
                                    'kehadiran' => $Row[12],
                                    'hadir' => $Row[15],
                                    'surat_sakit' => $Row[16],
                                    'dirawat' => $Row[17],
                                    'dl_menit' => $Row[18],
                                    'c_tahunan' => $Row[19],
                                    'jumlah2' => $Row[20],
                                    'hari' => $Row[21],
                                    'jumlah_keterlambatan' => $Row[10],
                                    'jumlah_kerja_menit' => $Row[15],
                                    'created_at' => date("Y-m-d H:i:s")

                                ));
                            } else {
                                // var_dump($Row);
                            }
                            // $CurrentMem = memory_get_usage();

                            // echo 'Memory: '.($CurrentMem - $BaseMem).' current, '.$CurrentMem.' base'.PHP_EOL;
                            // echo '---------------------------------'.PHP_EOL;

                            if ($Key && ($Key % 500 == 0)) {
                                // echo '---------------------------------'.PHP_EOL;
                                // echo 'Time: '.(microtime(true) - $Time);
                                // echo '---------------------------------'.PHP_EOL;
                            }
                        }
                    }

                    // echo PHP_EOL.'---------------------------------'.PHP_EOL;
                    // echo 'Time: '.(microtime(true) - $Time);
                    // echo PHP_EOL;

                    // echo '---------------------------------'.PHP_EOL;
                    // echo '*** End of sheet '.$Name.' ***'.PHP_EOL;
                    // echo '---------------------------------'.PHP_EOL;
                }


                $this->db->insert_batch('ref_absensi', $data);
                // hapus kembali file .xls yang di upload tadi
                // unlink($_FILES['test']['name']);


                // echo $namaFile = $dataupload['file_name'];
                array_map('unlink', glob(FCPATH . "uploads/absensi/$namaFile"));
            } catch (Exception $E) {
                echo $E->getMessage();
            }

            // $this->session->set_flashdata('success', "Berhasil Diupload");
            // header('Location: ' . $_SERVER['HTTP_REFERER']);
            // echo "<script>window.history.go(-1);</script>";
            // echo $namaFile = $_FILES['file_absensi']['name'];

        }

        $hasil = array(
            'status' => $status,
            'pesan' => 'Berhasil Diupload',

        );
        echo json_encode($hasil);
    }

    public function api_list()
    {

        $no_abs = $this->input->get('no_abs');
        if ($no_abs != NULL) {
            $result = array(
                'no_abs' => $no_abs,
                'data' => $this->db->get_where('ref_absensi', ['no_abs' => $no_abs])->result(),
            );
            $response = $result;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        } else {

            $result = array(
                'data' => $this->db->get('ref_absensi')->result(),
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


    public function api_list_senam()
    {

        $nip_pegawai = $this->input->get('nip_pegawai');
        if ($nip_pegawai != NULL) {
            $result = array(
                'nip_pegawai' => $nip_pegawai,
                'data' => $this->db->get_where('ref_absensi_senam', ['nip_pegawai' => $nip_pegawai])->result(),
            );
            $response = $result;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        } else {


            $result = array(
                'data' => $this->db->query('SELECT * FROM ref_absensi_senam LEFT JOIN pegawai ON ref_absensi_senam.nip_pegawai=pegawai.nip ')->result(),
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


    public function getAbsenNipKehadiranBln($nip, $bulan)
    {
        $query = "
       /*

        Query remun absensi
        */
        SELECT
        remun.`id_remun`,
        tr_indikator.`id_indikator`,
        tr_capaian.`id_capaian`,
        tr_capaian.`target`,
        tr_capaian.`capaian`,
        tr_indikator.`indikator`,
        tr_indikator.`definisi`,
        penilaian.`id_penilaian`,
        tr_capaian.`bulan`,

        penilaian.`nama_penilaian`

        nama
        FROM
        tr_capaian

        LEFT JOIN tr_indikator ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator`
        LEFT JOIN remun ON tr_indikator.`id_remun`=remun.`id_remun`
        LEFT JOIN penilaian ON remun.`id_penilaian`=penilaian.`id_penilaian`


        
        WHERE remun.`nip`='$nip' AND penilaian.`id_penilaian`='4' AND tr_capaian.`bulan` LIKE '%$bulan%' AND tr_indikator.`indikator` LIKE 'Kehadiran'
       ";
        $data = $this->db->query($query)->row();
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
    public function getAbsenNipBln()
    {
        $nip = $this->input->get('nip');
        $bulan = $this->input->get('bulan');
        $query = "
        SELECT
        pegawai.`nama_pegawai`,
        ref_absensi.`no_abs`,
        ref_absensi.`jumlah_kerja_menit`
        
        
        FROM
        pegawai
        
        LEFT JOIN ref_absensi ON pegawai.`no_abs` =ref_absensi.`no_abs`
        
        WHERE pegawai.`nip`='$nip' AND ref_absensi.`tgl_absensi` LIKE '%$bulan%'


    
       ";
        $result = array(
            'nip' => $nip,
            'bulan' => $bulan,
            'data' =>  $this->db->query($query)->row(),
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
