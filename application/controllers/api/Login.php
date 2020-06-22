<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function index()
    {
        $this->load->model('Login_m', 'login');
        $this->load->model('Pegawai_m', 'pegawai');


        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $id_login = $this->input->get('id_login');

                if ($id_login == NULL) {
                    $data = array(
                        'status' => true,
                        'data' => $this->login->getAll()->result(),
                        'total' => $this->login->getAll()->num_rows(),
                    );
                    $response = $data;
                    $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                        ->_display();
                    exit;
                    break;
                } else {
                    $datalogin = $this->login->find($id_login)->row();

                    if ($datalogin) {
                        $data = array(
                            'status' => true,
                            'data' => $datalogin
                        );
                        $response = $data;
                        $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                        break;
                    } else {
                        $data = array(
                            'status' => false,

                            'pesan' => 'Id Tidak ditemukan',
                        );
                        $response = $data;
                        $this->output
                            ->set_status_header(404)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                        exit;
                        break;
                    }
                }




            case 'POST':

                //kerena post sangat rahasia dan harus dilindungi dari requestan luar maka lakukan auth key dan session
                // cek_session();
                $config['upload_path']          = './uploads/pegawai/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 200;
                $config['max_width']            = 1924;
                $config['max_height']           = 1768;

                $this->load->library('upload', $config);

                if ($this->input->post('email')) {
                    $email = $this->input->post('email');
                } else {
                    # code...
                    $email = "pegawai" . $this->input->post('nip_pegawai') . "@gmail.com";
                }
                if ($this->input->post('no_hp')) {
                    $no_hp = $this->input->post('no_hp');
                } else {
                    # code...
                    $no_hp = "08123456789";
                }

                if ($this->input->post('username')) {
                    $username = $this->input->post('username');
                } else {
                    # code...
                    $username = "pegawai" . $this->input->post('nip_pegawai');
                }

                if ($this->input->post('password')) {
                    $password = md5(sha1(hash('sha256', sha1(md5($this->input->post('password'))))));
                } else {
                    # code...
                    $password = md5(sha1(hash('sha256', sha1(md5("1234")))));
                }



                if ($this->input->post('level')) {
                    $level = $this->input->post('level');
                } else {
                    # code...
                    $level = 4;
                }


                if (!$this->upload->do_upload('picture')) {
                    $error = array('error' => $this->upload->display_errors());

                    // $this->load->view('upload_form', $error);
                    echo  json_encode($error);
                    $pic = "no_pic.jpeg";
                    $data_modif = [

                        'nip_pegawai' => $this->input->post('nip_pegawai'),
                        'email' => $email,
                        'no_hp' => $no_hp,
                        'username' => $username,
                        'password' => $password,
                        'level' => $level,
                        'status' => 1,
                        'picture' => $pic,
                        'created_at' => date("Y-m-d H:i:s")
                    ];




                    // simpan ke database login
                    $this->login->simpan($data_modif);
                } else {
                    $data = array('upload_data' => $this->upload->data());

                    $pic = $data['upload_data']['file_name'];
                    $data_modif = [

                        'nip_pegawai' => $this->input->post('nip_pegawai'),
                        'email' => $email,
                        'no_hp' => $no_hp,
                        'username' => $this->input->post('username') == "" ? $this->input->post('username') : "pegawai" . $this->input->post('username'),
                        'password' => md5(sha1(hash('sha256', sha1(md5($this->input->post('password') == "" ? $this->input->post('password') : "1234"))))),
                        'level' => $this->input->post('level') == "" ? $this->input->post('level') : "4",
                        'status' => 1,
                        'picture' => $pic,
                        'created_at' => date("Y-m-d H:i:s")
                    ];




                    // simpan ke database login
                    $this->login->simpan($data_modif);
                }


                $data = array(
                    'data_real' => $_POST,
                    'data_modif' => $data_modif
                );
                $response = $data;
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
                break;


            case 'PUT':

                if (empty($this->input->input_stream('password'))) {
                    $password = $this->input->input_stream('password_lama_admin');
                } else {
                    $password = md5(sha1(hash('sha256', sha1(md5($this->input->input_stream('password'))))));
                }



                $id = $this->input->input_stream('id_login');
                $data_modif = [


                    'email' => $this->input->input_stream('email'),
                    'no_hp' => $this->input->input_stream('no_hp'),
                    'username' => $this->input->input_stream('username'),
                    'password' => $password,
                    'level' => $this->input->input_stream('level'),
                    'status' => 1,
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $alamat_nm_propinsi = $this->input->input_stream('alamat_nm_propinsi');
                $alamat_nm_kab_kota = $this->input->input_stream('alamat_nm_kab_kota');
                $alamat_nm_kec = $this->input->input_stream('alamat_nm_kec');
                $alamat_nm_desa = $this->input->input_stream('alamat_nm_desa');
                $alamat = $this->input->input_stream('alamat');
                $nip = $this->session->nip;
                $alamat_pegawai = [
                    'alamat_nm_propinsi' => $alamat_nm_propinsi,
                    'alamat_nm_kab_kota' => $alamat_nm_kab_kota,
                    'alamat_nm_kec' => $alamat_nm_kec,
                    'alamat_nm_desa' => $alamat_nm_desa,
                    'alamat' => $alamat
                ];

                //Update ALamat di Pegawai

                $this->pegawai->update($alamat_pegawai, $nip);

                // uodate ke database login
                $this->login->update($data_modif, $id);
                $response = ['pesan' => 'Ok'];
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
                break;

            case 'DELETE':

                $id = $this->input->input_stream('id');

                $datalogin = $this->login->find($id);
                if ($datalogin->num_rows() > 0) {
                    $this->login->hapus($id);
                    $data = array(
                        'status' => true,
                        'pesan' => "id $id berhasil dihapus"
                    );
                    $response = $data;
                    $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                        ->_display();
                    exit;
                } else {
                    $data = array(
                        'total' => $datalogin->num_rows(),
                        'status' => false,
                        'pesan' => "id $id tidak ditemukan"
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

            default:
                $data = array(
                    'status' => false,
                    'pesan' => 'Method tidak diketahui'
                );
                $response = $data;
                $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                exit;
                break;
        }
    }

    public function tampil()
    {

        if ($this->session->level == 1) {

            cek_session();
            $this->load->view('datalogin/index');
        } else {
            $this->session->set_flashdata('error', 'Anda tidak berhak ke halaman tersebut');
            redirect('dashboard');
        }
    }

    public function tambah()
    {
        cek_session();
        $this->load->view('datalogin/tambah');
    }

    public function edit()
    {
        cek_session();
        $this->load->model('Login_m', 'login');
        $this->load->model('Pegawai_m', 'pegawai');
        $data = array(
            'id_login' => $this->input->get('id'),
            'datalogin' => $this->login->find($this->input->get('id'))->row(),
            'pegawai_all' => $this->pegawai->getAll()->result()
        );
        $this->load->view('datalogin/edit', $data);
    }

    public function simpan()
    {
        # code...
    }


    public function upload_picture()
    {

        $this->load->model('Login_m', 'login');



        $config['upload_path']          = './uploads/pegawai/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200;
        // $config['max_width']            = 1924;
        // $config['max_height']           = 1768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('picture')) {
            $error = array('error' => $this->upload->display_errors());

            // $this->load->view('upload_form', $error);
            // echo  json_encode($error);
            $data['status'] = 2;
            // $data['respon'] = "Data Nilai Kerja atau catatan tidak boleh kosong";
            $data['respon'] =  $this->upload->display_errors('<li class="text-danger">', '</li>');
        } else {
            $data = array('upload_data' => $this->upload->data());


            $id_login = $_POST['id_login'];
            $picture_old = $_POST['picture_old'];
            echo json_encode($picture_old);

            //Hapus FOto lama
            $filename = explode(".", $picture_old)[0];
            array_map('unlink', glob(FCPATH . "uploads/pegawai/$filename.*"));


            $data_modif = [

                'picture' => $data['upload_data']['file_name'],

            ];
            // simpan ke database login
            $this->login->update($data_modif, $id_login);
            // $this->load->view('upload_success', $data);
            $data['status'] = 1;
            // $data['respon'] = "Data Nilai Kerja atau catatan tidak boleh kosong";
            $data['respon'] = "Berhasil disimpan";
        }

        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}
