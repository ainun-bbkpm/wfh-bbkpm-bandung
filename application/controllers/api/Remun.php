<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remun extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Remun_m', 'remun');
        $this->load->model('Indikator_m', 'indikator');
        $this->load->model('Capaian_m', 'capaian');
        $this->load->model('Atasan_m', 'atasan');

        header("Access-Control-Allow-Origin: http://bbkpm-bandung.org");
    }

    public function index()
    {
        $tahun = $this->input->get('tahun');
        if ($tahun) {
            $thn = $tahun;
        } else {

            $thn = substr(date('Y-m-d'), 0, 4);
            # code...
        }
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $id_remun = $this->input->get('id');
                // cek key header yg dikirimkan oleh user
                $headers = apache_request_headers();
                if (isset($headers['key'])) {
                    $headerskey = $headers['key'];
                } else {
                    $headerskey = $this->input->get('key');
                    # code...
                }

                // Data header dari session atau dari database
                $databaseheader = [
                    'key' => "bbkpm2019"
                ];



                // jika header tidak sama 
                if ($headerskey ==  $databaseheader['key']) {

                    // jika dalam prosess request id tidak ada maka tampilkan semua
                    // $this->remun->getAll()->result()

                    // jika yang dicarai lewat nip maka tampilkan
                    $nip = $this->input->get('nip');

                    // Jika tidak menulis id remuun maka tampilkan semua remun

                    if ($id_remun == NULL) {
                        $response = $this->remun->getAll()->result();

                        $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                    } else {
                        // $response = $this->remun->find($id_remun)->row();


                        $response = [
                            'remun' => $this->remun->find($id_remun)->row(),
                            'indikator' => $this->indikator->getAllByIdRemun($id_remun)->result(),
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


    public function test()
    {
        // $this->remun->getByNIPAndThn($id,$thn),;
        $tahun = $this->input->get('tahun');
        if ($tahun) {
            $thn = $tahun;
        } else {

            $thn = substr(date('Y-m-d'), 0, 4);
            # code...
        }
        $nip = $this->input->get('nip');
        $data = [
            'nip' => $nip,
            'tahun' => $thn,
            'data' => $this->remun->getByNIPAndThn($nip, $thn)->result()
        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function indikator()
    {
        $data = [];
        $this->load->model('Pegawai_m', 'pegawai');

        $id_remun = $this->input->get('id_remun');
        $bulan = $this->input->get('bulan');
        $status = $this->input->get('status');


        $datapenilaian = $this->remun->getByIdJoinPenilaian($id_remun)->row();

        $total_atasan = $this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows();


        // UpdateOtomatis
        //Blok Update Capaian Absensi
        if ($this->_getAbsenNipBln($datapenilaian->nip,  $bulan)) {
            # code...
            $dataabsen = $this->_getAbsenNipBln($datapenilaian->nip,  $bulan);
            $id_capaian = $this->_getAbsenNipKehadiranBln($datapenilaian->nip, $bulan)->id_capaian;
            $this->capaian->update(['capaian' => $dataabsen->jumlah_kerja_menit], $id_capaian);
        } else {
            $datacapaiansenam = "belum tersedia";
        }

        // $dataabsen = $this->_getAbsenNipKehadiranBln($datapenilaian->nip, $bulan)->id_capaian;
        //End Blok Update Capaian Absensi

        $datapegawai = $this->pegawai->find($datapenilaian->nip)->row();
        if ($total_atasan == 2) {
            $total_atasan = $total_atasan + 1; // ini untuk jika atasannya cuma dua
        } elseif ($total_atasan == 1) {
            $total_atasan = $total_atasan + 1; // ini untuk jika atasannya cuma satu

        } elseif ($total_atasan == 3 && $this->atasan->getAllByNipPegawaiStatus($datapenilaian->nip)->num_rows() == 3) {
            $total_atasan = $total_atasan + 1; // ini untuk jika atasannya cuma satu

        }



        //  elseif ( $datapegawai->id_unit_kerja == '59' && $datapegawai->id_jabatan =='90' )  { //ini berlaku untuk pegawai yang di instalasi rawat jalan  dan kepala instalasi, pokoknya di bawah pak ijan deh :')
        //     $total_atasan=$total_atasan+1; // up gan
        // }

        else {
            $total_atasan = $total_atasan;
        }
        $jaja = $this->atasan->getAllByNipPegawai($datapenilaian->nip)->result();
        foreach ($jaja as $key => $value) {
            $data["atasan_ke"] = $value->nip;
        }

        $data = [
            'id_remun' => $id_remun,
            'nama_penilaian' => $datapenilaian->nama_penilaian,
            'bulan' => $bulan,
            'where' => $status,
            'atasan' =>  [

                'total_atasan' => $this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows(),
                'total_approval' => $this->atasan->getAllByNipPegawaiStatus($datapenilaian->nip)->num_rows(),
                'data_atasan' => $this->atasan->getAllByNipPegawaiStatus($datapenilaian->nip)->result()

            ],

            'total' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->num_rows(),

            // 'total_ajuan'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan,$status)->num_rows(),
            // 'total_status_max'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan,$this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows())->num_rows(), //ini diperuntukan untuk yang atasannya langsung ke bu maya
            'id_unit_kerja' => $datapegawai->id_unit_kerja,
            'id_jabatan' => $datapegawai->id_jabatan,


            'status_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            'status_setuju' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status + 1)->num_rows(),
            'validasi_cetak' => $this->capaian->validasi_cetak($bulan, $datapenilaian->nip, $total_atasan)->num_rows(),
            'total_yang_dicetak' => $this->capaian->total_yang_dicetak($bulan, $datapenilaian->nip)->num_rows(),
            'status_belum_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            'status_telah_disetujui' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $total_atasan)->num_rows(), //ini berarti sudah disetujui oleh atasan paling  atas
            // 'total_status_2'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan," ='2'")->num_rows(),
            // 'total_status_3'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan," ='3'")->num_rows(),
            // 'total_status_4'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan," ='4'")->num_rows(),
            'indikator' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result(),
            'jumalah_kierja' => $this->remun->queryGetJumlahHasilKinerjaCapaianByNipBulan($datapenilaian->nip, $bulan)->row()->hasil_kinerja,


        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function detail_remun()
    {
        $bulan = explode("-", $_POST['bulan']);
        $nip = $this->input->post('nip');
        $thn = $this->input->post('tahun');
        $data = array(
            'bulan' => $bulan[0],
            'tahun' => $this->input->post('tahun'),
            'nip' => $nip,
            'remun' => $this->remun->getByNIPAndThn($nip, $thn)->result()
        );


        $this->load->view('pegawai/detail_remun', $data);
    }

    public function update_capaian()
    {


        // $data = $_POST;
        $datacapaian = $this->capaian->getById($this->input->post('id_capaian'))->row();
        $dataindikator = $this->indikator->getById($datacapaian->id_indikator)->row();

        $id_capaian = $this->input->post('id_capaian');
        $target = $this->input->post('target');
        $bobot = $this->input->post('bobot');
        $value = $this->input->post('changes')[0][3];
        $capaian = $this->input->post('changes')[0][3];
        $field = $this->input->post('changes')[0][1];

        if ($field == "target_perbulan") {
            $field = "target";
        } else {
            $field = $field;
        }





        if (($dataindikator->range_target1) && ($dataindikator->range_target2)) {
            $range1 = $dataindikator->range_target1;
            $range2 = $dataindikator->range_target2;
            if (($capaian <= $range1 && $capaian < $range2)) {
                $stat = "kurang";
                $value2 = $range1;
            } else {
                if (($capaian > $range1 && $capaian < $range2)) {
                    $stat = "diantara";
                    $value2 = $capaian;
                } else {
                    $stat = "Lebih";
                    $value2 = $range2;
                }
            }
            $updated_at = date("Y-m-d H:i:s");
            $this->db->query("UPDATE `tr_capaian` SET  `target` = '$value2', `updated_at` = '$updated_at' WHERE `tr_capaian`.`id_capaian` = '$id_capaian';");
        } else {
            $range1 = '';
            $range2 = '';
            $stat = '';
            $value2 = $this->input->post('changes')[0][3];
            // $this->db->query("UPDATE `tr_capaian` SET  `target` = '$value2' WHERE `tr_capaian`.`id_capaian` = '$id_capaian';");
        }
        $hasil_kinerja = floor((($value2 / $capaian) * $bobot) * 1000) / 1000;

        $data = array(
            'id_capaian' => $this->input->post('id_capaian'),
            'hasil_kinerja' => $hasil_kinerja,
            'id_indkator' => $datacapaian->id_indikator,
            'id_remun' => $dataindikator->id_remun,
            'capaian' => $capaian,
            // 'target_perbulan'=>$value,
            'stat' => $stat,
            'range1' => $range1,
            'range2' => $range2,
            'bulan' => $datacapaian->bulan,
            'field' => $this->input->post('changes')[0][1],
            'value' => $this->input->post('changes')[0][3],

        );

        $updated_at = date("Y-m-d H:i:s");
        $this->db->query("UPDATE `tr_capaian` SET  `$field` = '$value',`updated_at` = '$updated_at', `hasil_kinerja`='$hasil_kinerja' WHERE `tr_capaian`.`id_capaian` = '$id_capaian';");



        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function ajukan()
    {
        $id_remun = $this->input->get('id_remun');
        $bulan = $this->input->get('bulan');

        $datapenilaian = $this->remun->getByIdJoinPenilaian($id_remun)->row();
        $dataajuan = $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result();
        foreach ($dataajuan as $key => $value) {

            //Data untuk update capaian
            $dataupdatecapaian = ['status' => 1];

            //data untuk disimpan di table ajuan
            $datasimpanajuan = [
                'id_capaian' => $value->id_capaian,
                'target_ajuan' => $value->target,
                'capaian_ajuan' => $value->capaian,
                'bobot_ajuan' => $value->bobot,
                'hasil_kinerja_ajuan' => $value->hasil_kinerja,
                'updated_at' => date("Y-m-d H:i:s")
            ];

            //update status capaian 
            $this->capaian->update2($dataupdatecapaian, $datasimpanajuan, $value->id_capaian);
            //simpan ke tr_ajuan
            // $this->capaian->update($dataupdatecapaian,$value->id_capaian);


        }


        $data = [
            'id_remun' => $id_remun,

            'bulan' => $bulan,
            'total' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->num_rows(),

            'indikator' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result(),

            'pesan' => 'Berhasil diajukan'

        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function setujui()
    {
        $id_remun = $this->input->get('id_remun');
        $bulan = $this->input->get('bulan');
        $status = $this->input->get('status');
        $nip_atasan = $this->input->get('nip_atasan');
        // $total_atasan = $this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows();
        $datapenilaian = $this->remun->getByIdJoinPenilaian($id_remun)->row();
        $dataajuan = $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result();
        $dataupdatecapaian = ['status' => $status, 'approved_by' => $nip_atasan, 'updated_at' => date("Y-m-d H:i:s")];
        foreach ($dataajuan as $key => $value) {

            //Data untuk update capaian

            //data untuk disimpan di table ajuan
            // $datasimpanajuan=[
            //     'id_capaian'=>$value->id_capaian,
            //     'target_ajuan'=>$value->target,
            //     'capaian_ajuan'=>$value->capaian,
            //     'bobot_ajuan'=>$value->bobot,
            //     'hasil_kinerja_ajuan'=>$value->hasil_kinerja

            // ];

            //update status capaian 
            // $this->capaian->update2($dataupdatecapaian,$datasimpanajuan,$value->id_capaian);
            $this->capaian->update($dataupdatecapaian, $value->id_capaian);
            //simpan ke tr_ajuan
            // $this->capaian->update($dataupdatecapaian,$value->id_capaian);


        }


        $data = [
            'id_remun' => $id_remun,
            'status' => $status,

            'bulan' => $bulan,
            'total' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->num_rows(),
            'status_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            'status_setuju' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status + 1)->num_rows(),
            'status_belum_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            // 'total_status_max'=>$this->remun->queryGetCapaianByIdRemunStatus2($id_remun,$bulan,$status)->num_rows(), //ini diperuntukan untuk yang atasannya langsung ke bu maya
            // 'status_telah_disetujui'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan,$total_atasan)->num_rows(), //ini berarti sudah disetujui oleh atasan paling  atas
            'indikator' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result(),
            'pesan' => 'Berhasil di setujui'

        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function setujuiv2()
    {

        $bulan = $this->input->get('bulan');
        $status = $this->input->get('status');
        $nip = $this->input->get('nip');
        $nip_atasan = $this->input->get('nip_atasan');
        // $total_atasan = $this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows();

        $qwr = "
        SELECT

        remun.`id_remun`,
       
		tr_indikator.id_indikator,
        tr_capaian.id_capaian,
        tr_capaian.status
        FROM

        remun
	    LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        
        LEFT JOIN tr_capaian ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator` 


        WHERE remun.`nip`='$nip' and tr_capaian.bulan LIKE '%$bulan%'
        ";
        $dataajuan = $this->db->query($qwr)->result();
        $dataupdatecapaian = ['status' => $status, 'approved_by' => $nip_atasan, 'updated_at' => date("Y-m-d H:i:s")];
        foreach ($dataajuan as $key => $value) {

            //update status capaian 
            // $this->capaian->update2($dataupdatecapaian,$datasimpanajuan,$value->id_capaian);
            $this->capaian->update($dataupdatecapaian, $value->id_capaian);
            //simpan ke tr_ajuan
            // $this->capaian->update($dataupdatecapaian,$value->id_capaian);


        }


        $data = [

            'status' => 'ok',


            'pesan' => 'Berhasil di setujui'

        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function kembalikan()
    {
        $id_remun = $this->input->get('id_remun');
        $bulan = $this->input->get('bulan');
        $status = $this->input->get('status');
        $nip_atasan = $this->input->get('nip_atasan');
        // $total_atasan = $this->atasan->getAllByNipPegawai($datapenilaian->nip)->num_rows();
        $datapenilaian = $this->remun->getByIdJoinPenilaian($id_remun)->row();
        $dataajuan = $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result();
        $dataupdatecapaian = ['status' => $status, 'return_by' => $nip_atasan, 'approved_by' => '', 'updated_at' => date("Y-m-d H:i:s")];
        foreach ($dataajuan as $key => $value) {

            //Data untuk update capaian

            //data untuk disimpan di table ajuan
            // $datasimpanajuan=[
            //     'id_capaian'=>$value->id_capaian,
            //     'target_ajuan'=>$value->target,
            //     'capaian_ajuan'=>$value->capaian,
            //     'bobot_ajuan'=>$value->bobot,
            //     'hasil_kinerja_ajuan'=>$value->hasil_kinerja

            // ];

            //update status capaian 
            // $this->capaian->update2($dataupdatecapaian,$datasimpanajuan,$value->id_capaian);
            $this->capaian->update($dataupdatecapaian, $value->id_capaian);
            //simpan ke tr_ajuan
            // $this->capaian->update($dataupdatecapaian,$value->id_capaian);


        }


        $data = [
            'id_remun' => $id_remun,
            'status' => $status,

            'bulan' => $bulan,
            'total' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->num_rows(),
            'status_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            'status_setuju' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status + 1)->num_rows(),
            'status_belum_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
            // 'total_status_max'=>$this->remun->queryGetCapaianByIdRemunStatus2($id_remun,$bulan,$status)->num_rows(), //ini diperuntukan untuk yang atasannya langsung ke bu maya
            // 'status_telah_disetujui'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan,$total_atasan)->num_rows(), //ini berarti sudah disetujui oleh atasan paling  atas
            'indikator' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result(),
            'pesan' => 'Berhasil di setujui'

        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function kembalikanV2()
    {
        $nip = $this->input->get('nip');
        $bulan = $this->input->get('bulan');
        $status = $this->input->get('status');
        $nip_atasan = $this->input->get('nip_atasan');
        $qwr = "
        SELECT

        remun.`id_remun`,
       
		tr_indikator.id_indikator,
        tr_capaian.id_capaian,
        tr_capaian.status
        FROM

        remun
	    LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        
        LEFT JOIN tr_capaian ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator` 


        WHERE remun.`nip`='$nip' and tr_capaian.bulan LIKE '%$bulan%'
        ";
        $dataajuan = $this->db->query($qwr)->result();
        $dataupdatecapaian = ['status' => $status, 'return_by' => $nip_atasan, 'approved_by' => '', 'updated_at' => date("Y-m-d H:i:s")];
        foreach ($dataajuan as $key => $value) {

            //Data untuk update capaian

            //data untuk disimpan di table ajuan
            // $datasimpanajuan=[
            //     'id_capaian'=>$value->id_capaian,
            //     'target_ajuan'=>$value->target,
            //     'capaian_ajuan'=>$value->capaian,
            //     'bobot_ajuan'=>$value->bobot,
            //     'hasil_kinerja_ajuan'=>$value->hasil_kinerja

            // ];

            //update status capaian 
            // $this->capaian->update2($dataupdatecapaian,$datasimpanajuan,$value->id_capaian);
            $this->capaian->update($dataupdatecapaian, $value->id_capaian);
            //simpan ke tr_ajuan
            // $this->capaian->update($dataupdatecapaian,$value->id_capaian);


        }

        $data = [

            'status' => 'ok',


            'pesan' => 'Berhasil di setujui'

        ];

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
        // $data = [
        //     'id_remun' => $id_remun,
        //     'status' => $status,

        //     'bulan' => $bulan,
        //     'total' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->num_rows(),
        //     'status_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
        //     'status_setuju' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status + 1)->num_rows(),
        //     'status_belum_diajukan' => $this->remun->queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status)->num_rows(),
        //     // 'total_status_max'=>$this->remun->queryGetCapaianByIdRemunStatus2($id_remun,$bulan,$status)->num_rows(), //ini diperuntukan untuk yang atasannya langsung ke bu maya
        //     // 'status_telah_disetujui'=>$this->remun->queryGetCapaianByIdRemunStatus($id_remun,$bulan,$total_atasan)->num_rows(), //ini berarti sudah disetujui oleh atasan paling  atas
        //     'indikator' => $this->remun->queryGetCapaianByIdRemun($id_remun, $bulan)->result(),
        //     'pesan' => 'Berhasil di setujui'

        // ];

        // $response = $data;
        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json', 'utf-8')
        //     ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        //     ->_display();
        // exit;
    }

    public function cetak()
    {
        # code...
    }

    public function  remunbynip()
    {

        $nip = $this->input->get('nip');
        $id_penilaian = $this->input->get('id_penilaian');
        $this->load->model('Remun_m', 'remun');
        $data = $this->remun->getByNIPAndPenilaian($nip, $id_penilaian);

        echo json_encode($data->row());
    }

    public function  remunbynipandbln()
    {
        $bulan = $this->input->get('bulan');
        $nip = $this->input->get('nip');
        $qwr = "
        SELECT

        remun.`id_remun`,
        tr_indikator.`id_indikator`,
        tr_capaian.`status`

        FROM

        remun

        LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        LEFT JOIN tr_capaian ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator` 



        WHERE remun.`nip`='$nip' AND tr_capaian.`bulan` LIKE '%$bulan%' AND tr_capaian.`status` = '0' 
        ";

        $data = $this->db->query($qwr);
        $data = [
            'status' => "Berhasil",
            'jumlah_atasan' => $this->atasan->getAllByNipPegawai($nip)->num_rows(),
            'jumlah' => $data->num_rows()

        ];
        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function ajukanV2()
    {
        $bulan = $this->input->get('bulan');
        $nip = $this->input->get('nip');
        $qwr = "
        UPDATE

        remun

        LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        LEFT JOIN tr_capaian ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator`

        SET tr_capaian.`status`='1'

        WHERE remun.`nip`='$nip' AND tr_capaian.`bulan` LIKE '%$bulan%' 
        ";

        $this->db->query($qwr);
        $data = [
            'status' => "Berhasil",

        ];
        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function _getAbsenNipKehadiranBln($nip, $bulan)
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
        return $data = $this->db->query($query)->row();
    }

    public function _getAbsenNipBln($nip, $bulan)
    {
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

        $result = $this->db->query($query)->row();


        return $result;
    }
}
