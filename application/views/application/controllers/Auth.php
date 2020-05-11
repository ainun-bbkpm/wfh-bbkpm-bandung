<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_m', 'admin');
        $this->load->model('Pegawai_m', 'pegawai');
        $this->load->model('Pejabat_penilai_m', 'pejabat_penilai');
        $this->load->model('Login_m', 'login');

        // if ($this->session->has_userdata('id_admin') == 1) {
        //     $this->session->set_flashdata('success', 'Anda telah login');
        //     redirect('dashboard');
        // }


    }
    public function index()
    {

        // die();
        // $this->load->view('welcome_message');
        redirect('dashboard');
    }


    public function login()
    {
        if ($this->session->has_userdata('login') == 1) {
            $this->session->set_flashdata('success', 'Anda  sudah login');
            switch ($this->session->level) {
                case '1':
                    redirect('dashboard');
                case '2':
                    redirect('approval');
                    break;
                case '3':
                    redirect('penilai');
                    break;
                case '4':
                    redirect('pegawai');
                    break;
                default:
                    //         $this->session->set_flashdata('success', "Selamat datang");
                    //         // redirect('dashboard');
                    break;
            }

            // print_r($this->session);
        }
        $this->load->view('login');
    }


    public function cek_login()
    {
        if ($this->session->has_userdata('login') == 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            redirect('dashboard');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('login_sebagai', 'login sebagai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Tidak ada');
            redirect('auth/login');
        } else {
            // print_r($_POST);
            // echo "<br>";
            // echo "<br>";
            $username = $this->input->post('username');
            $password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password'))))));
            $login_sebagai = $this->input->post('login_sebagai');

            // die();

            switch ($login_sebagai) {
                case '1':
                    $dataadmin = $this->login->login($username, $password, $login_sebagai);
                    if ($dataadmin->num_rows() > 0) {
                        //Ambil data dari database
                        $admin = $dataadmin->row();
                        //cek status login aktif apa tidak
                        if ($admin->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
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
                                'login' => true
                            ];
                            // print_r($admin);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $admin->nama_login");
                            redirect('dashboard');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai admin");
                        redirect('auth/login');
                    }

                    break;

                case '2':
                    $dataapproval = $this->login->login($username, $password, $login_sebagai);
                    if ($dataapproval->num_rows() > 0) {
                        //Ambil data dari database
                        $approval = $dataapproval->row();
                        //cek status login aktif apa tidak
                        if ($approval->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $approval->id_login);

                            $datasession = [
                                'id_login' => $approval->id_login,
                                'nip' => $approval->nip_pegawai,
                                'nama_login' => $approval->nama_login,
                                //     'id_unit_kerja'=> $approval->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $approval->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $approval->id_jabatan,
                                //     'hak_akses_jabatan'=> $approval->hak_akses_jabatan,
                                'level' => $approval->level,
                                'login' => true
                            ];
                            // print_r($approval);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $approval->nama_login");
                            redirect('approval');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Approval");
                        redirect('auth/login');
                    }

                    break;


                case '3':
                    $datapenilai = $this->login->login($username, $password, $login_sebagai);
                    // print_r($datapenilai);
                    //         die();
                    if ($datapenilai->num_rows() > 0) {
                        //Ambil data dari database
                        $penilai = $datapenilai->row();
                        //cek status login aktif apa tidak
                        if ($penilai->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $penilai->id_login);

                            $datasession = [
                                'id_login' => $penilai->id_login,
                                'nip' => $penilai->nip_pegawai,
                                'nama_login' => $penilai->nama_login,
                                //     'id_unit_kerja'=> $penilai->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $penilai->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $penilai->id_jabatan,
                                //     'hak_akses_jabatan'=> $penilai->hak_akses_jabatan,
                                'level' => $penilai->level,
                                'login' => true
                            ];
                            // print_r($penilai);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $penilai->nama_login");
                            redirect('penilai');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Penilai");
                        redirect('auth/login');
                    }

                    break;


                case '4':
                    $datapegawai = $this->login->login($username, $password, $login_sebagai);
                    // print_r($datapegawai);
                    //         die();
                    if ($datapegawai->num_rows() > 0) {
                        //Ambil data dari database
                        $pegawai = $datapegawai->row();
                        //cek status login aktif apa tidak
                        if ($pegawai->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $pegawai->id_login);

                            $datasession = [
                                'id_login' => $pegawai->id_login,
                                'nip' => $pegawai->nip_pegawai,
                                'nama_login' => $pegawai->nama_login,
                                //     'id_unit_kerja'=> $pegawai->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $pegawai->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $pegawai->id_jabatan,
                                //     'hak_akses_jabatan'=> $pegawai->hak_akses_jabatan,
                                'level' => $pegawai->level,
                                'login' => true
                            ];
                            // print_r($pegawai);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $pegawai->nama_login");
                            redirect('pegawai');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai pegawai");
                        redirect('auth/login');
                    }

                    break;
                default:
                    //         $this->session->set_flashdata('success', "Selamat datang");
                    //         // redirect('dashboard');
                    break;
            }
        }
    }

    public function api_cek_login()
    {



        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('login_sebagai', 'login sebagai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Tidak ada');
            $data = array(

                'status' => false,
                'pesan' => "id tidak ditemukan"

            );
            $response = $data;
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        } else {
            // print_r($_POST);
            // echo "<br>";
            // echo "<br>";
            $username = $this->input->post('username');
            $password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password'))))));
            $login_sebagai = $this->input->post('login_sebagai');

            // die();

            switch ($login_sebagai) {
                case '1':
                    $dataadmin = $this->login->login($username, $password, $login_sebagai);
                    if ($dataadmin->num_rows() > 0) {
                        //Ambil data dari database
                        $admin = $dataadmin->row();
                        //cek status login aktif apa tidak
                        if ($admin->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            $data = array(

                                'status' => false,
                                'pesan' => "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin"

                            );
                            $response = $data;
                            $this->output
                                ->set_status_header(200)
                                ->set_content_type('application/json', 'utf-8')
                                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                                ->_display();
                            exit;
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
                                'login' => true
                            ];
                            // print_r($admin);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $admin->nama_login");
                            // redirect('dashboard');
                            $data = array(

                                'status' => true,
                                'pesan' => "Selamat datang $admin->nama_login"

                            );
                            $response = $data;
                            $this->output
                                ->set_status_header(200)
                                ->set_content_type('application/json', 'utf-8')
                                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                                ->_display();
                            exit;
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai admin");
                        // redirect('auth/login');
                        $data = array(

                            'status' => false,
                            'pesan' => "Akun tidak terdaftar sebagai admin"

                        );
                        $response = $data;
                        $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                    }

                    break;

                case '2':
                    $dataapproval = $this->login->login($username, $password, $login_sebagai);
                    if ($dataapproval->num_rows() > 0) {
                        //Ambil data dari database
                        $approval = $dataapproval->row();
                        //cek status login aktif apa tidak
                        if ($approval->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $approval->id_login);

                            $datasession = [
                                'id_login' => $approval->id_login,
                                'nip' => $approval->nip_pegawai,
                                'nama_login' => $approval->nama_login,
                                //     'id_unit_kerja'=> $approval->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $approval->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $approval->id_jabatan,
                                //     'hak_akses_jabatan'=> $approval->hak_akses_jabatan,
                                'level' => $approval->level,
                                'login' => true
                            ];
                            // print_r($approval);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $approval->nama_login");
                            redirect('approval');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Approval");
                        redirect('auth/login');
                    }

                    break;


                case '3':
                    $datapenilai = $this->login->login($username, $password, $login_sebagai);
                    // print_r($datapenilai);
                    //         die();
                    if ($datapenilai->num_rows() > 0) {
                        //Ambil data dari database
                        $penilai = $datapenilai->row();
                        //cek status login aktif apa tidak
                        if ($penilai->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $penilai->id_login);

                            $datasession = [
                                'id_login' => $penilai->id_login,
                                'nip' => $penilai->nip_pegawai,
                                'nama_login' => $penilai->nama_login,
                                //     'id_unit_kerja'=> $penilai->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $penilai->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $penilai->id_jabatan,
                                //     'hak_akses_jabatan'=> $penilai->hak_akses_jabatan,
                                'level' => $penilai->level,
                                'login' => true
                            ];
                            // print_r($penilai);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $penilai->nama_login");
                            redirect('penilai');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai Penilai");
                        redirect('auth/login');
                    }

                    break;


                case '4':
                    $datapegawai = $this->login->login($username, $password, $login_sebagai);
                    // print_r($datapegawai);
                    //         die();
                    if ($datapegawai->num_rows() > 0) {
                        //Ambil data dari database
                        $pegawai = $datapegawai->row();
                        //cek status login aktif apa tidak
                        if ($pegawai->status != 1) {
                            $this->session->set_flashdata('warning', "Akun anda terdaftar tetapi tidak aktif, silahkan hubungi Admin");
                            redirect('auth/login');
                        } else {
                            # code...
                            //update lastlogin
                            $updatelogin = [
                                'last_login' => date('Y-m-d H:i:s')
                            ];
                            $this->login->update($updatelogin, $pegawai->id_login);

                            $datasession = [
                                'id_login' => $pegawai->id_login,
                                'nip' => $pegawai->nip_pegawai,
                                'nama_login' => $pegawai->nama_login,
                                //     'id_unit_kerja'=> $pegawai->id_unit_kerja,
                                //     'hak_akses_unit_kerja'=> $pegawai->hak_akses_unit_kerja,
                                //     'id_jabatan'=> $pegawai->id_jabatan,
                                //     'hak_akses_jabatan'=> $pegawai->hak_akses_jabatan,
                                'level' => $pegawai->level,
                                'login' => true
                            ];
                            // print_r($pegawai);
                            // die();
                            $this->session->set_userdata($datasession);
                            $this->session->set_flashdata('success', "Selamat datang $pegawai->nama_login");
                            redirect('pegawai');
                        }
                    } else {

                        $this->session->set_flashdata('warning', "Akun tidak terdaftar sebagai pegawai");
                        redirect('auth/login');
                    }

                    break;
                default:
                    //         $this->session->set_flashdata('success', "Selamat datang");
                    //         // redirect('dashboard');
                    break;
            }
        }
    }






    public function logout()
    {
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
        redirect('auth/login');
    }

    public function ganti_password()
    {
        $nip = $this->input->get('id');
        $key = $this->input->get('key');
        $data = [
            'nip' => $nip,
            'key' => $key
        ];
        if (md5($nip) == $key) {
            // $pegawai->
            // print_r($_SESSION);
            $this->load->library('form_validation');


            $this->form_validation->set_rules('no_hp', 'no_hp', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');

            if ($this->form_validation->run() === FALSE) {

                $data = [
                    'nip' => $nip,
                    'key' => $key
                ];
                $this->load->view('ganti_password.php', $data);
            } else {

                $password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password'))))));
                $update = [
                    // 'id_login'=>$this->session->id_login,
                    'username' => $this->input->post('username'),
                    'no_hp' => $this->input->post('no_hp'),
                    'email' => $this->input->post('email'),
                    'password' => $password
                ];
                $this->login->update($update, $this->session->id_login);
                $this->session->set_flashdata('success', "Berhasil memperbaru akun");
                redirect('wfh');
            }
        } else {
            $this->session->set_flashdata('warning', "Ups,Key bermasalah! Hubungi admin");
            // redirect('auth/login');
            echo "<script>history.go(-2)</script>";
        }
    }
}
