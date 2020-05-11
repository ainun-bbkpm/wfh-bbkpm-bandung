<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_m','admin');

        // if ($this->session->has_userdata('id_admin') == 1) {
        //     $this->session->set_flashdata('success', 'Anda telah login');
        //     redirect('dashboard');
        // }


    }


    public function cek_login()
    {
        $id = $this->input->post('username');
        $password = md5(sha1(hash('sha256',sha1(md5($this->input->post('password'))))));

        $datalogin = $this->admin->login($id,$password);

        if ($datalogin->num_rows() <= 0) {
            $response =['status'=>403,'pesan'=>"Data pengguna tidak terdaftar"];
            $this->output
                    ->set_status_header(403)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
            exit;
        } else {
            $response = $datalogin->row();
            $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
            exit;
        }
        


    }


}

