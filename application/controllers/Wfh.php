<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wfh extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pegawai_m', 'pegawai');
        $this->load->model('Wfh_m', 'wfh');
        // $this->load->model('Unit_m', 'unit');
        // $this->load->model('Jabatan_m', 'jabatan');
        // $this->load->model('Atasan_m', 'atasan');
        // $this->load->model('Akses_m', 'akses');


        // cek_session();


    }

    public function index()
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }
        $nip = $this->session->nip;

        $data['atasan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip]);
        $data['jml_atasan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip]);
        $data['jml_bawahan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip])->num_rows();
        $data['nip'] =  $nip;
        $data['level'] = $this->session->level;
        $this->load->view('wfh/index', $data);
    }

    public function login()
    {

        $this->load->view('login_wfh');
    }

    public function logout()
    {
        $this->load->model('Login_m', 'login');
        $id_login = $this->session->id_login;

        $updatelogin = [
            'last_logout' => date('Y-m-d H:i:s')
        ];
        $this->login->update($updatelogin, $id_login);
        $datasession = array(
            'id_login',
            'nip',
            'nama_login',
            'level',
            'id_unit_kerja',
            'hak_akses_unit_kerja',
            'id_jabatan',
            'hak_akses_jabatan',
            'login',
            'login_wfh'
        );
        $this->session->unset_userdata($datasession);

        // $this->session->set_flashdata('success', 'Anda telah logout');
        redirect('wfh/login');
    }

    public function cek_login()
    {
        $this->load->model('Login_m', 'login');

        if ($this->session->has_userdata('login_wfh') == 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Tidak ada');
            redirect('wfh/login');
        } else {
            // print_r($_POST);
            // echo "<br>";
            // echo "<br>";
            $username = $this->input->post('username');
            $password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password'))))));
            $hi = $this->input->post('password');

            $dataadmin = $this->login->login_wfh($username, $password);

            if ($dataadmin->num_rows() > 0) {
                //Ambil data dari database
                $admin = $dataadmin->row();
                // print_r($admin);
                // die();
                //cek status login aktif apa tidak
                if ($admin->status != 1) {
                    $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                    redirect('wfh/login');
                } else {
                    # code...
                    //update lastlogin
                    $updatelogin = [
                        'last_login' => date('Y-m-d H:i:s')
                    ];
                    $this->login->update($updatelogin, $admin->id_login);

                    $datasession = [
                        'id_login' => $admin->id_login,
                        'nip' => $admin->nip_pegawai,
                        'nama_login' => $admin->nama_login,
                        //     'id_unit_kerja'=> $admin->id_unit_kerja,
                        //     'hak_akses_unit_kerja'=> $admin->hak_akses_unit_kerja,
                        //     'id_jabatan'=> $admin->id_jabatan,
                        //     'hak_akses_jabatan'=> $admin->hak_akses_jabatan,
                        'level' => $admin->level,
                        'login_wfh' => true
                    ];
                    // print_r($admin);
                    $this->session->set_userdata($datasession);
                    $this->session->set_flashdata('success', "Selamat datang $admin->nama_login");
                    // print_r($this->session);
                    // die();
                    redirect('wfh');

                    $this->db->query("INSERT INTO `remunerasi`.`tes` (`nama`)
                    VALUES
                      ('$username dan $hi');
        
                    ");
                }
            } else {

                $this->session->set_flashdata('warning', "Akun tidak terdaftar");
                redirect('wfh/login');
            }

            die();

            // switch ($login_sebagai) {
            //     case '1':

            //         break;

            //     case '2':
            //         $dataapproval = $this->login->login($username, $password, $login_sebagai);
            //         if ($dataapproval->num_rows() > 0) {
            //             //Ambil data dari database
            //             $approval = $dataapproval->row();
            //             //cek status login aktif apa tidak
            //             if ($approval->status != 1) {
            //                 $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
            //                 redirect('auth/login');
            //             } else {
            //                 # code...
            //                 //update lastlogin
            //                 $updatelogin = [
            //                     'last_login' => date('Y-m-d H:i:s')
            //                 ];
            //                 $this->login->update($updatelogin, $approval->id_login);

            //                 $datasession = [
            //                     'id_login' => $approval->id_login,
            //                     'nip' => $approval->nip_pegawai,
            //                     'nama_login' => $approval->nama_login,
            //                     //     'id_unit_kerja'=> $approval->id_unit_kerja,
            //                     //     'hak_akses_unit_kerja'=> $approval->hak_akses_unit_kerja,
            //                     //     'id_jabatan'=> $approval->id_jabatan,
            //                     //     'hak_akses_jabatan'=> $approval->hak_akses_jabatan,
            //                     'level' => $approval->level,
            //                     'login' => true
            //                 ];
            //                 // print_r($approval);
            //                 // die();
            //                 $this->session->set_userdata($datasession);
            //                 $this->session->set_flashdata('success', "Selamat datang $approval->nama_login");
            //                 redirect('approval');
            //             }
            //         } else {

            //             $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Approval");
            //             redirect('auth/login');
            //         }

            //         break;


            //     case '3':
            //         $datapenilai = $this->login->login($username, $password, $login_sebagai);
            //         // print_r($datapenilai);
            //         //         die();
            //         if ($datapenilai->num_rows() > 0) {
            //             //Ambil data dari database
            //             $penilai = $datapenilai->row();
            //             //cek status login aktif apa tidak
            //             if ($penilai->status != 1) {
            //                 $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
            //                 redirect('auth/login');
            //             } else {
            //                 # code...
            //                 //update lastlogin
            //                 $updatelogin = [
            //                     'last_login' => date('Y-m-d H:i:s')
            //                 ];
            //                 $this->login->update($updatelogin, $penilai->id_login);

            //                 $datasession = [
            //                     'id_login' => $penilai->id_login,
            //                     'nip' => $penilai->nip_pegawai,
            //                     'nama_login' => $penilai->nama_login,
            //                     //     'id_unit_kerja'=> $penilai->id_unit_kerja,
            //                     //     'hak_akses_unit_kerja'=> $penilai->hak_akses_unit_kerja,
            //                     //     'id_jabatan'=> $penilai->id_jabatan,
            //                     //     'hak_akses_jabatan'=> $penilai->hak_akses_jabatan,
            //                     'level' => $penilai->level,
            //                     'login' => true
            //                 ];
            //                 // print_r($penilai);
            //                 // die();
            //                 $this->session->set_userdata($datasession);
            //                 $this->session->set_flashdata('success', "Selamat datang $penilai->nama_login");
            //                 redirect('penilai');
            //             }
            //         } else {

            //             $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Penilai");
            //             redirect('auth/login');
            //         }

            //         break;


            //     case '4':
            //         $datapegawai = $this->login->login($username, $password, $login_sebagai);
            //         // print_r($datapegawai);
            //         //         die();
            //         if ($datapegawai->num_rows() > 0) {
            //             //Ambil data dari database
            //             $pegawai = $datapegawai->row();
            //             //cek status login aktif apa tidak
            //             if ($pegawai->status != 1) {
            //                 $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
            //                 redirect('auth/login');
            //             } else {
            //                 # code...
            //                 //update lastlogin
            //                 $updatelogin = [
            //                     'last_login' => date('Y-m-d H:i:s')
            //                 ];
            //                 $this->login->update($updatelogin, $pegawai->id_login);

            //                 $datasession = [
            //                     'id_login' => $pegawai->id_login,
            //                     'nip' => $pegawai->nip_pegawai,
            //                     'nama_login' => $pegawai->nama_login,
            //                     //     'id_unit_kerja'=> $pegawai->id_unit_kerja,
            //                     //     'hak_akses_unit_kerja'=> $pegawai->hak_akses_unit_kerja,
            //                     //     'id_jabatan'=> $pegawai->id_jabatan,
            //                     //     'hak_akses_jabatan'=> $pegawai->hak_akses_jabatan,
            //                     'level' => $pegawai->level,
            //                     'login' => true
            //                 ];
            //                 // print_r($pegawai);
            //                 // die();
            //                 $this->session->set_userdata($datasession);
            //                 $this->session->set_flashdata('success', "Selamat datang $pegawai->nama_login");
            //                 redirect('pegawai');
            //             }
            //         } else {

            //             $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai pegawai");
            //             redirect('auth/login');
            //         }

            //         break;
            //     default:
            //         //         $this->session->set_flashdata('success', "Selamat datang");
            //         //         // redirect('dashboard');
            //         break;
            // }
        }
    }

    public function pegawai()
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }
        $nip = $this->session->nip;
        $data['atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
        $data['jml_atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
        $data['jml_bawahan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows();
        $data['nip'] =  $nip;
        $data['level'] = $this->session->level;
        $data = [
            'nip' => $this->session->nip,
            'level' => $this->session->level,
            'jml_bawahan' => $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows(),
            'sidebar' => 'pegawai',

        ];
        $this->load->view('pegawai/wfh', $data);
    }

    public function getJam()
    {
        $data = [
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s')
            //'tanggal' => "2020-05-06",
            // 'jam' => '07:24:00'
        ];
        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function api_list_where_nip()
    {

        $nip = $this->input->get('nip');
        if ($nip != NULL) {
            $result = array(
                'nip' => $nip,
                'data' => $this->db->get_where('ref_wfh', ['id_pegawai' => $nip])->result(),
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

    public function api_getWfh_where_idwfh()
    {

        $wfh = $this->input->get('wfh');
        if ($wfh != NULL) {
            $result = array(
                'wfh' => $wfh,
                'data' => $this->db->get_where('ref_wfh', ['id_wfh' => $wfh])->row(),
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

    public function hadir_masuk()
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }

        if ($_FILES["file_selfie"]["error"] == 4) {


            $pesan = "tidak ada file yang dipilih";
            $status = 2;
        } else {
            //Buat folder
            $id_folder = $this->session->nip;
            // $tgl= date('Y-m-d');
            $tgl = $this->input->post('tgl_absen');
            $name_folder = $id_folder . "_" . $tgl;
            $curldir = getcwd();
            $folderpath = FCPATH . "./uploads/wfh/$name_folder";
            if (is_dir($folderpath) == true) {
                $pesan = "Hari ini anda sudah masuk";
                $status = 2;
            } else {
                // $pesan="Tidak ada";
                // $status = 2;
                $folder = mkdir("./uploads/wfh/$name_folder");
                if ($folder) {

                    $config['upload_path']          = "./uploads/wfh/$name_folder";
                    $config['allowed_types']        = 'jpg|jpeg|png';
                    $config['max_size']             = 10000;
                    $config['file_name']             = "foto-absen-masuk-" . $name_folder;
                    $this->load->library('upload', $config);
                    // Load Library
                    if (!$this->upload->do_upload('file_selfie')) {
                        $pesan = (array('error' => $this->upload->display_errors()));
                        $pesan = json_encode($pesan);
                        $status = 2;
                        // echo json_encode($error);
                        // $this->load->view('upload_form', $error);
                    } else {
                        $dataupload = array('upload_data' => $this->upload->data());
                        // print_r($dataupload);
                        // echo json_encode($dataupload);
                        $data = [
                            'id_pegawai' => $this->session->nip,
                            'tgl_absen' => $tgl,
                            'jam_absen_hadir' => $this->input->post('jam_masuk'),
                            'foto_absen_hadir' => $this->upload->data('file_name'),
                            'created_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->wfh->simpan($data);
                        $pesan = "Berhasil";
                        $status = 1;
                    }
                } else {
                    $pesan = "Gagal Buat Folder";
                    $status = 2;
                }
            }
        }






        $hasil = array(
            'status' => $status,
            'pesan' => $pesan,

        );
        echo json_encode($hasil);
    }

    public function absen_tengah()
    {
        // cek_session();
        //Update WFH hari ini

        $this->wfh->update(['jam_absen_pertengahan' => date('H:i:s')], $_POST);
        $result = array(
            'data' => $_POST,

        );
        $response = $result;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function absen_pulang()
    {
        //Update WFH hari ini
        // cek_session();
        $datawfh = $this->wfh->where($_POST)->row();
        $datalogbook = $this->db->get_where('tr_log_wfh', ['id_wfh' => $datawfh->id_wfh])->num_rows();
        $datalogbookBelumSimpan = $this->db->get_where('tr_log_wfh', ['id_wfh' => $datawfh->id_wfh, 'status_simpan' => 0])->num_rows();

        if ($datawfh->demam == ""  and $datawfh->sesak == "" and $datawfh->batuk == "" and $datawfh->nyeri_nelan == "") {
            $pesan = "Data kesehatan  masih kosong, silahkan isi kesehatan ";
            $status = 2;
        } elseif ($datalogbook == 0) {
            $pesan = "Data  log book masih kosong, silahkan isi  log book";
            $status = 2;
            # code...

        } elseif ($datalogbookBelumSimpan > 0) {
            $pesan = "Data  log book masih belum tersimpan, silahkan simpan  log book";
            $status = 2;
            # code...
        } elseif ($datawfh->jam_absen_pertengahan == "00:00:00") {
            $pesan = "Upss, ada belum Klik Hadir Pertengahan";
            $status = 2;
        } else {
            $pesan = "Berhasil";
            $this->wfh->update(['jam_absen_pulang' => date('H:i:s'), 'updated_at' => date('Y-m-d H:i:S'), 'status' => 1], $_POST);
            $status = 1;
        }


        $result = array(
            'data' => $datawfh,
            'pesan' => $pesan,
            'status' => $status

        );
        $response = $result;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function log_book()
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }
        $nip = $this->session->nip;
        // $data['atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
        // $data['jml_atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
        // $data['jml_bawahan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows();
        $data = [
            'nip' => $this->session->nip,
            'level' => $this->session->level,
            'sidebar' => 'pegawai',
            'jml_bawahan' => $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows(),
            'id_wfh' => $this->input->get('id')

        ];
        $this->load->view('pegawai/_wfh_log_book', $data);
    }

    public function api_list_log_book_where_idwfh()
    {


        $id_wfh = $this->input->get('id_wfh');
        $datawfh = $this->db->get_where('ref_wfh', ['id_wfh' => $id_wfh])->row();
        if ($id_wfh != NULL) {
            $query = "
            SELECT

            *,
            concat(tr_log_wfh.path,'/',tr_log_wfh.output) as files

            from 
            tr_log_wfh
            where id_wfh='$id_wfh'
            ";
            $data = $this->db->query($query)->result();
            $result = array(
                'id_wfh' => $id_wfh,
                'status' => $datawfh->status,
                'data' => $data,
            );
            $response = $result;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        } else {
            // $this->db->select('*');
            // $this->db->order_by('id_wfh', 'ASC');
            // $data =  $this->db->get('tr_log_wfh')->result();
            $query = "
            SELECT

            *,
            concat(tr_log_wfh.output,tr_log_wfh.path) as files

            from 
            tr_log_wfh
            
            ";
            $data = $this->db->query($query)->result();
            $result = array(
                'data' => $data,
                'data_wfh' => $this->db->get_where('ref_wfh', ['id_wfh' => $id_wfh, 'status' => 1])->num_rows()

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

    public function tambah_log_book()
    {
        // cek_session();
        $this->load->library('form_validation');


        $this->form_validation->set_rules('uraian_kegiatan', 'Uraian Kegiatan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $pesan = "Urian Kegiatan diperlukan, tidak boleh kosong";
            $status = 2;
            $hasil = array(
                'status' => $status,
                'pesan' => $pesan,

            );
            echo json_encode($hasil);
        } else {
            if ($_FILES["output"]["error"] == 4) {
                $pesan = "tidak ada file yang dipilih";
                $status = 2;
                $hasil = array(
                    'status' => $status,
                    'pesan' => $pesan,

                );
                echo json_encode($hasil);
            } else {
                $id_wfh = $this->input->post('id_wfh');
                $uraian_kegiatan = $this->input->post('uraian_kegiatan');
                $datawfh = $this->wfh->find($id_wfh)->row();

                $id_folder = $datawfh->id_pegawai;
                // $tgl= date('Y-m-d');
                $tgl = $datawfh->tgl_absen;
                $name_folder = $id_folder . "_" . $tgl;


                $config['upload_path']          = "./uploads/wfh/$name_folder";
                $config['allowed_types']        = 'xls|xlsx|pdf|jpg|jpeg|png|docx|doc|rar|zip|ppt|pptx';
                $config['max_size']             = 5000;
                $this->load->library('upload', $config);

                // Load Library
                if (!$this->upload->do_upload('output')) {
                    $error = $this->upload->display_errors();

                    $pesan = print_r($error);
                    $status = 2;
                    echo json_encode($pesan);
                } else {
                    $data = $this->upload->data();
                    $simpan = [
                        'id_wfh' => $id_wfh,
                        'uraian_kegiatan' => $uraian_kegiatan,
                        'output' => $data['file_name'],
                        'path' => "./uploads/wfh/$name_folder",
                        'type_file' => $data['file_ext'],

                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $this->wfh->simapnlogbook($simpan);
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
    }

    public function simpan_log_book()
    {
        $id_wfh = $_POST['id_wfh'];

        $this->db->update('tr_log_wfh', ['status_simpan' => 1, 'updated_at' => date('Y-m-d H:i:S')], ['id_wfh' => $id_wfh]);

        $data = [
            'id_wfh' => $id_wfh,

            'pesan' => "Berhasil Di simpan",
            'status' => 1
        ];
        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function tambah_isi_kesehatan()
    {
        $id_wfh = $this->input->post('id_wfh');

        //cek apakah raddio buuton kosong apa tidak
        if (isset($_POST['demam']) and isset($_POST['sesak']) and isset($_POST['batuk']) and isset($_POST['nyeri'])) {
            # code...
            $datawfh = $this->wfh->find($id_wfh)->row();
            $response = $datawfh;
            $pesan = "Berhasil disipman ";
            $status = 1;
            $update = [
                'demam' => $this->input->post('demam'),
                'sesak' => $this->input->post('sesak'),
                'batuk' => $this->input->post('batuk'),
                'nyeri_nelan' => $this->input->post('nyeri'),
            ];
            $this->wfh->update($update, ['id_wfh' => $id_wfh]);
        } else {
            $pesan = "Masih Kosong ";
            $status = 2;
        }

        $hasil = array(
            'dataPost' => $_POST,
            'status' => $status,
            'pesan' => $pesan,

        );
        echo json_encode($hasil);
    }

    public function hapus_log_book()
    {
        $id = $this->input->input_stream('id');
        $rec = $this->db->query("SELECT * FROM tr_log_wfh WHERE id_tr_log_wfh='$id'")->row();

        $namaFile =  $rec->output;
        $path =  $rec->path;
        array_map('unlink', glob(FCPATH . "$path/$namaFile"));
        //Hapus
        $this->db->delete('tr_log_wfh', ['id_tr_log_wfh' => $id]);
        $data = [
            'id_wfh' => $rec->id_wfh,
            'pesan' => "Berhasil dihapus",
            'status' => 1
        ];
        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function biodata_edit()
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }
        $data = [];

        $nip = $this->input->get('id');
        $token = $this->input->get('token');
        if (sha1(sha1(md5($nip . md5($nip)))) == $token) {
            $datapegawai = $this->pegawai->find($nip);
            if ($datapegawai->num_rows() > 0) {

                $this->load->model('Login_m', 'login');
                $datalogin =  $this->login->getByNipPegawai($nip);
                // $data['atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
                // $data['jml_atasan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip]);
                // $data['jml_bawahan'] = $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows();
                // $data['nip'] =  $nip;
                // $data['level'] = $this->session->level;

                $data = array(
                    'id_login' => $datalogin->row()->id_login,
                    'datalogin' => $this->login->find($datalogin->row()->id_login)->row(),
                    'pegawai_all' => $this->pegawai->getAll()->result(),
                    'jml_bawahan' => $this->db->get_where('atasan', ['nip_atasan' => $nip])->num_rows(),
                    'pegawailogin' => $datapegawai->row()
                );

                if ($this->session->has_userdata('login_wfh') != 1) {
                    $this->session->set_flashdata('success', 'Anda sudah login');
                    // echo "Sudah Login";
                    redirect('wfh/login');
                }
                $this->load->view('wfh/biodata_edit', $data);
            } else {
                $this->session->set_flashdata('error', "Id Tidak ditemukan");
                redirect('wfh');
            }
        } else {
            $this->session->set_flashdata('warning', "Token Bermasalah");
            redirect('wfh');
        }
    }
}
