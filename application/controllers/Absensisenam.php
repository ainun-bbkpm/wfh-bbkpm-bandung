<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensisenam extends CI_Controller
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

        $this->load->view('absensisenam/index');
    }

    public function simpan()
    {
        cek_session();
        $config['upload_path']          = './uploads/absensi';
        $config['allowed_types']        = 'xls|xlsx';
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


            $array_nama_file  = explode("_", $namaFile);


            $tahun = $array_nama_file[3];
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
                    if (
                        $Name == "01" or $Name == "02" or $Name == "03" or $Name == "04" or $Name == "05"
                        or $Name == "06" or $Name == "07" or $Name == "08" or $Name == "09" or $Name == "10" or $Name == "11" or $Name == "12"
                    ) {
                        # code...
                        $Time = microtime(true);

                        $Spreadsheet->ChangeSheet($Index);

                        foreach ($Spreadsheet as $Key => $Row) {
                            //echo $Key . ': ';
                            if ($Key > 3 and $Row[1] != "") {
                                if ($Row) {

                                    // Ini Simpan Bulan
                                    // $data = ['tahun'=>];
                                    // echo "NIP Pegawai " . $Row[1] . PHP_EOL;
                                    // echo "Nama Pegawai " . $Row[2] . PHP_EOL;
                                    // echo "Total Absensi " . $Row[9] . PHP_EOL;
                                    // echo "Bulan " . $Name  . PHP_EOL;
                                    // $tahun = "2020";
                                    $datapegawai = $this->db->query("SELECT `id_absensi_senam`,`nip_pegawai`,tahun FROM ref_absensi_senam WHERE nip_pegawai='$Row[1]' AND tahun='$tahun'")->row();
                                    if ($datapegawai) {
                                        // echo "Ada, id absensi " . $datapegawai->id_absensi_senam . PHP_EOL;
                                        //Update
                                        switch ($Name) {
                                            case '02':
                                                $this->db->update('ref_absensi_senam', ['februari' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '03':
                                                $this->db->update('ref_absensi_senam', ['maret' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '04':
                                                $this->db->update('ref_absensi_senam', ['april' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '05':
                                                $this->db->update('ref_absensi_senam', ['mei' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '06':
                                                $this->db->update('ref_absensi_senam', ['juni' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '07':
                                                $this->db->update('ref_absensi_senam', ['juli' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '08':
                                                $this->db->update('ref_absensi_senam', ['agustus' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '09':
                                                $this->db->update('ref_absensi_senam', ['september' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '10':
                                                $this->db->update('ref_absensi_senam', ['oktober' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '11':
                                                $this->db->update('ref_absensi_senam', ['november' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;
                                            case '12':
                                                $this->db->update('ref_absensi_senam', ['desember' => $Row[9], 'updated_at' => date("Y-m-d H:i:s")], ['id_absensi_senam' => $datapegawai->id_absensi_senam]);
                                                break;

                                            default:
                                                # code...
                                                break;
                                        }
                                    } else {
                                        // echo "Ga ada " . PHP_EOL;
                                        $data1 = array(

                                            'nip_pegawai' => $Row[1], // Insert data nama dari kolom B di excel
                                            'tahun' => $tahun,
                                            'januari' => $Name == "01" ? $Row[9] : null,
                                            // 'februari' => $Name == "02" ? $Row[9] : null,
                                            // 'maret' => $Name == "03" ? $Row[9] : null,
                                            // 'april' => null,
                                            // 'mei' => null,
                                            // 'juni' => null,
                                            // 'juli' => null,
                                            // 'agustus' => null,
                                            // 'september' => null,
                                            // 'oktober' => null,
                                            // 'november' => null,
                                            // 'desember' => null,
                                            'created_at' => date("Y-m-d H:i:s")

                                        );
                                        $this->db->insert('ref_absensi_senam', $data1);
                                    }


                                    // print_r($Row);
                                } else {
                                    // var_dump($Row);
                                }
                                $CurrentMem = memory_get_usage();

                                // echo 'Memory: ' . ($CurrentMem - $BaseMem) . ' current, ' . $CurrentMem . ' base' . PHP_EOL;
                                // echo '---------------------------------' . PHP_EOL;

                                // if ($Key && ($Key % 500 == 0)) {
                                //     echo '---------------------------------' . PHP_EOL;
                                //     echo 'Time: ' . (microtime(true) - $Time);
                                //     echo '---------------------------------' . PHP_EOL;
                                // }
                            }
                        }

                        // echo PHP_EOL . '---------------------------------' . PHP_EOL;
                        // echo 'Time: ' . (microtime(true) - $Time);
                        // echo PHP_EOL;

                        // echo '---------------------------------' . PHP_EOL;
                        // echo '*** End of sheet ' . $Name . ' ***' . PHP_EOL;
                        // echo '---------------------------------' . PHP_EOL;
                    } else {
                        // echo "Sheet Error" . PHP_EOL;
                    }
                }



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

        $nip = $this->input->get('nip');
        if ($nip != NULL) {
            $result = array(
                'nip' => $nip,
                'data' => $this->db->get_where('ref_absensi_senam', ['nip_pegawai' => $nip])->result(),
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
                'data' => $this->db->get('ref_absensi_senam')->result(),
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
}
