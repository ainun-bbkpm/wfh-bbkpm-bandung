<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_m', 'jabatan');
        $this->load->model('unit_m', 'unit');
        $this->load->model('Akses_m', 'akses');

        $this->load->model('Remun_m', 'remun');
        $this->load->model('Penilaian_m', 'penilaian');
        $this->load->model('Indikator_m', 'indikator');
        $this->load->model('Capaian_m', 'capaian');
        $this->load->model('Atasan_m', 'atasan');
    }


    public function index()
    {



        echo "Token get : " . $token = $this->input->get('id');
        echo "<br>";
        echo $str = "Bbkpm2020";
        echo "<br>";
        $sha1  = substr(sha1($str), 4, 5);
        $md5  = substr(md5($str), 3, 5);
        $sha256  = substr(hash('sha256', $str), 3, 5);
        $all = substr($sha1 . $md5 . $sha256, 3, 5);
        echo "Token 1 : " . $token1 = strtoupper($sha1);
        echo "<br>";
        echo "Token 2 : " . $token2 = strtoupper($md5);
        echo "<br>";
        echo "Token 3 : " . $token3 = strtoupper($sha256);
        echo "<br>";
        echo "Token 4 : " . $token4 = strtoupper($all);
        echo "<br>";
        echo "All in one : $token1-$token2-$token3-$token4";
        echo "<br>";
        echo "<br>";
        $allthere = $token1 . "-" . $token2 . "-" . $token3 . "-" . $token4;
        $options = [
            'cost' => 10,
        ];
        echo "Password Hash : " . $hash = password_hash($allthere, PASSWORD_BCRYPT, $options);
        echo "<br>";

        // $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

        if (password_verify($allthere, $hash)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }
        die();
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


    public function validasi_upload_remun()
    {

        // $datapenilaian = [
        //     ['id_penilaian' => '1','nama_penilaian'=>'Kuantitas','max_bobot'=>0.35],
        //     ['id_penilaian' => '2','nama_penilaian'=>'Kualitas','max_bobot'=>0.23]
        // ];


        // // print_r($datapenilaian);
        // // foreach ($datapenilaian as $key => $value) {
        // //    echo $value
        // // }
        // $data = json_encode($datapenilaian);
        // $max_bobot = 0;
        // foreach ($datapenilaian as $key => $value) {
        //     echo $value['id_penilaian']." max = " .$value['max_bobot']."<br>";
        //     $max_bobot += $value['max_bobot'];

        // }   
        // echo "<br>";
        // echo $max_bobot;


        // die();
        echo "upload remun";
        echo "<br>";
        echo form_open_multipart('test/do_upload');
        echo "<br>";
        $data = array(
            'name'          => 'upload_excel',
            'id'            => 'upload_excel',
            'type'          => 'file',


        );

        echo form_input($data);
        $data1 = array(
            'name'          => 'submit',
            'id'            => 'submit',
            'type'          => 'submit',
            'maxlength'     => '100',

            'value' => 'Upload'
        );

        echo form_input($data1);


        echo form_close();
    }

    public function do_upload()
    {
        $this->load->model('Pegawai_m', 'pegawai');
        if ($_FILES["upload_excel"]["error"] == 4) {

            $status = 0;
            $pesan = "Tidak ada file yang dipilih";
        } else {

            // cek_session();
            $config['upload_path']          = './uploads/test';
            $config['allowed_types']        = 'xls';
            $config['max_size']             = 2000;
            // $config['overwrite']             = TRUE;

            $dataupload = $_FILES['upload_excel'];
            // print_r($dataupload);
            $Filepath = base_url("./uploads/test/$dataupload[name]") . PHP_EOL;
            if (file_exists(FCPATH . "./uploads/test/$dataupload[name]")) {

                $status = 0;
                $pesan = "File Excel Remun sudah ada";
                // echo "<br>";
                // $namaFile = $dataupload['name'];
                // array_map('unlink', glob(FCPATH . "uploads/test/$namaFile"));
            } else {


                $filefound = 'Belum Adad' . PHP_EOL;


                $this->load->library('upload', $config);

                // Load Library
                if (!$this->upload->do_upload('upload_excel')) {
                    $error = array('error' => $this->upload->display_errors());

                    $pesan = "Error saat upload";
                    $status = 2;
                } else {

                    $status = 1;
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

                                echo "Nama Penilaian $Name, max bobotnya $datapenilaian->max_bobot" . "<br>";




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
                                            echo "Bobot " . $Row[5];

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
                                            $bobot = $Row[5];
                                            array_push($simpandataindikator, array(
                                                'id_indikator' => $id_indikator,
                                                'id_remun' => $idUniq,
                                                'indikator' =>  $Row[2],
                                                'definisi' => $Row[3],
                                                'target' =>  $Row[4],
                                                'bobot' => $Row[5],
                                                'range1' => $tgl_pertama1,
                                                'range2' => $tgl_pertama2,
                                                'range_target1' => $range_target1,
                                                'range_target2' => $range_target2,
                                            ));
                                            // simpan ke database

                                            //jika penilaian 4 atau perilaku maka tidak di bagi 12 kosongkan saja

                                            if ($id_penilaian == '4' && $Row[2] == "Kehadiran" || $Row[2] == "kehadiran") {
                                                $target_perbulan = '';
                                            } else {
                                                $target_perbulan = $Row[4] / 12;
                                            }




                                            // $this->remun->simpan_indikator($simpandataindikator);

                                            //ini simpan 1 bulan 

                                            $simpandatacapaian1 = array(
                                                'id_indikator' => $id_indikator,
                                                'bulan' => $tgl_remun,
                                                'target' => $target_perbulan,
                                                'capaian' => '',
                                                'bobot' => $Row[5],

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
                                                    // 'capaian' => '',
                                                    'bobot' => $Row[5],
                                                );

                                                // $this->capaian->simpan($datacapaian);
                                                // $this->db->insert_batch('tr_capaian', $simpandatacapaian1);
                                                $this->db->insert('tr_capaian', $datacapaian);

                                                $i++;
                                            }


                                            $bobot_indikator = $bobot;
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

                                            echo "Nilai didalammnya " . $bobot_indikator . "<br>";
                                        } else {
                                            // var_dump($Row);
                                        }
                                    }
                                }





                                echo "Total Nilai didalammnya " . $max_bobot_indikator . "<br>";
                                if (round($max_bobot_indikator, 2) > round($max_bobot, 2)) {
                                    echo "Ada kelebihan <br>";
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
                            $status = 0;
                        } else {
                            if ($err > 0) {
                                $this->db->trans_rollback();
                                $status = 0;
                                $pesan = "Data kelebihan $err ADA kelebihan, Roll back";
                            } else {
                                $this->db->trans_commit();
                                $pesan = "data kelebihan 0 Tidak ada yang kelebihan, Komit";
                            }
                        }





                        // if ($err >  0) {

                        //     $status = 2;
                        //     // $this->db->trans_rollback();
                        //     // $pesan = "Rol back , maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id";
                        //     $pesan = "Rol back , maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id ada yang lebih " . $err;
                        // } else {
                        //     $status = 1;
                        //     // $pesan = "Berhasil disimpan, maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id";
                        //     $pesan = "Berhasil  tidak ada yang lebih maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id ";
                        //     // $this->db->trans_commit();
                        // }


                        // $this->db->trans_begin();
                        // $this->db->insert_batch('remun', $simpandatapenilaian);
                        // $this->db->insert_batch('tr_indikator', $simpandataindikator);
                        // $this->db->insert_batch('tr_capaian', $simpandatacapaian1);
                        // $this->db->insert_batch('tr_capaian', $simpandatacapaian2);

                        // $this->remun->simpan_penilaian($datapenilaian);
                        // $this->remun->simpan_indikator($simpandataindikator);

                        // if ($this->db->trans_status() === FALSE) {
                        //     $pesan = "Gagal disimpan";
                        // } else {
                        //     if ($max_bobot_indikator == 0) {
                        //         $pesan = "Bobot 0";
                        //     } else {
                        //         $max_bobot_indikator = round($max_bobot_indikator, 2);
                        //         if ($max_bobot_indikator >  $max_bobot) {
                        //             $this->db->trans_rollback();
                        //             $pesan = "Rol back , maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id";
                        //         } else {
                        //             $pesan = "Berhasil disimpan, maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot id $id";
                        //             $this->db->trans_commit();
                        //         }
                        //     }
                        // }

                        // if ($max_bobot == 0) {
                        //     $pesan = "Berhasil disimpan, maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot";
                        //     $this->db->trans_commit();
                        // } else {
                        //     if ($this->db->trans_status() === FALSE && $max_bobot_indikator > $max_bobot) {
                        //         $this->db->trans_rollback();
                        //         $pesan = "Rol back";
                        //     } else {
                        //         $pesan = "Berhasil disimpan, maksimal bobot indikator $max_bobot_indikator dan max bobot penilaian $max_bobot";
                        //         $this->db->trans_commit();
                        //     }
                        //     # code...
                        // }



                    } catch (Exception $E) {
                        echo $E->getMessage();
                    }
                    // echo "<br>";
                    $namaFile = $dataupload['name'];
                    array_map('unlink', glob(FCPATH . "uploads/test/$namaFile"));
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

        );
        echo json_encode($hasil);
    }

    public function upload_excel()
    {
        $this->load->model('Pegawai_m', 'pegawai');
        /**
         * XLS parsing uses php-excel-reader from http://code.google.com/p/php-excel-reader/
         */
        header('Content-Type: text/plain');

        // if (isset($argv[1])) {
        //     $Filepath = $argv[1];
        // } elseif (isset($_GET['File'])) {
        //     $Filepath = site_url('assets/test.xlsx');
        // } else {
        //     if (php_sapi_name() == 'cli') {
        //         echo 'Please specify filename as the first argument' . PHP_EOL;
        //     } else {
        //         echo 'Please specify filename as a HTTP GET parameter "File", e.g., "/test.php?File=test.xlsx"';
        //     }
        //     exit;
        // }


        $Filepath = FCPATH . "./uploads/test/Format_Rekap_Senam_2020.xlsx";

        if (file_exists(FCPATH . "./uploads/test/Format_Rekap_Senam_2020.xlsx")) {

            echo "File Excel Remun sudah ada";
            // echo "<br>";
            // $namaFile = $dataupload['name'];
            // array_map('unlink', glob(FCPATH . "uploads/test/$namaFile"));
        } else {

            echo "Ga da";
        }

        // Excel reader from http://code.google.com/p/php-excel-reader/
        include APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php';
        include APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php';



        //date_default_timezone_set('UTC');

        $StartMem = memory_get_usage();
        echo '---------------------------------' . PHP_EOL;
        echo 'Starting memory: ' . $StartMem . PHP_EOL;
        echo '---------------------------------' . PHP_EOL;

        try {
            //Definisi array
            $data1 = array();
            $Spreadsheet = new SpreadsheetReader($Filepath);
            $BaseMem = memory_get_usage();

            $Sheets = $Spreadsheet->Sheets();

            echo '---------------------------------' . PHP_EOL;
            echo 'Spreadsheets:' . PHP_EOL;
            print_r($Sheets);
            echo '---------------------------------' . PHP_EOL;
            echo '---------------------------------' . PHP_EOL;

            foreach ($Sheets as $Index => $Name) {
                echo '---------------------------------' . PHP_EOL;
                echo '*** Sheet ' . $Name . ' ***' . PHP_EOL;
                echo '---------------------------------' . PHP_EOL;

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
                                echo "NIP Pegawai " . $Row[1] . PHP_EOL;
                                echo "Nama Pegawai " . $Row[2] . PHP_EOL;
                                echo "Total Absensi " . $Row[9] . PHP_EOL;
                                echo "Bulan " . $Name  . PHP_EOL;
                                $tahun = "2020";
                                $datapegawai = $this->db->query("SELECT `id_absensi_senam`,`nip_pegawai`,tahun FROM ref_absensi_senam WHERE nip_pegawai='$Row[1]' AND tahun='$tahun'")->row();
                                if ($datapegawai) {
                                    echo "Ada, id absensi " . $datapegawai->id_absensi_senam . PHP_EOL;
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
                                    echo "Ga ada " . PHP_EOL;
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
                                var_dump($Row);
                            }
                            $CurrentMem = memory_get_usage();

                            echo 'Memory: ' . ($CurrentMem - $BaseMem) . ' current, ' . $CurrentMem . ' base' . PHP_EOL;
                            echo '---------------------------------' . PHP_EOL;

                            if ($Key && ($Key % 500 == 0)) {
                                echo '---------------------------------' . PHP_EOL;
                                echo 'Time: ' . (microtime(true) - $Time);
                                echo '---------------------------------' . PHP_EOL;
                            }
                        }
                    }

                    echo PHP_EOL . '---------------------------------' . PHP_EOL;
                    echo 'Time: ' . (microtime(true) - $Time);
                    echo PHP_EOL;

                    echo '---------------------------------' . PHP_EOL;
                    echo '*** End of sheet ' . $Name . ' ***' . PHP_EOL;
                    echo '---------------------------------' . PHP_EOL;
                } else {
                    echo "Sheet Error" . PHP_EOL;
                }
            }


            // $this->db->insert_batch('ref_absensi_senam', $data1);
        } catch (Exception $E) {
            echo $E->getMessage();
        }
    }



    function is_between_times($start = null, $end = null)
    {
        if ($start == null) $start = '00:00';
        if ($end == null) $end = '23:59';
        return ($start <= date('H:i') && date('H:i') <= $end);
    }

    public function upload_log_book()
    {

        // die();
        $config['upload_path']          = "./uploads/wfh";
        $config['allowed_types']        = 'xls|xlsx|pdf|jpg|jpeg|png|docx|doc|rar|zip|ppt|pptx';
        // $config['max_size']             = 5000; // 5MB
        $config['max_size']             = 85000; //80MN
        $this->load->library('upload', $config);

        // Load Library
        if (!$this->upload->do_upload('output')) {
            $error = $this->upload->display_errors();

            $pesan = print_r($error);
            $status = 2;
            echo json_encode($pesan);
        } else {
            $data = $this->upload->data();

            // $pesan = "File ada " .json_encode($data);
            // $pesan = print_r($data);
            $pesan = "Berhasil disipman ";
            $status = 1;
            $hasil = array(
                'status' => $status,
                'pesan' => $pesan,

            );
            echo json_encode($hasil);
        }
    }
}
