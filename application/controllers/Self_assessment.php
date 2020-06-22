<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Self_assessment extends CI_Controller
{


    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function pegawai(Type $var = null)
    {
        if ($this->session->has_userdata('login_wfh') != 1) {
            $this->session->set_flashdata('success', 'Anda sudah login');
            // echo "Sudah Login";
            redirect('wfh/login');
        }
        $nip = $this->session->nip;
        // print_r($this->session);
        $data['atasan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip]);
        $data['jml_atasan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip]);
        $data['jml_bawahan'] = $this->db->get_where('atasan_wfh', ['nip_atasan' => $nip])->num_rows();
        $data['nip'] =  $nip;
        $data['level'] = $this->session->level;
        $this->load->view('self_assessment/index', $data);
    }

    public function tambah()
    {
        // cek_session();
        $this->load->library('form_validation');
        $this->load->model('Self_assessment_m', 'self_assessment');
        $this->load->model('Pegawai_m', 'pegawai');
        $this->form_validation->set_rules('q1', 'question 1', 'required');
        $this->form_validation->set_rules('q2', 'question 2', 'required');
        $this->form_validation->set_rules('q3', 'question 3', 'required');
        $this->form_validation->set_rules('q4', 'question 4', 'required');
        $this->form_validation->set_rules('q5', 'question 5', 'required');
        $this->form_validation->set_rules('q6', 'question 6', 'required');
        $this->form_validation->set_rules('q7', 'Komorbid', 'required');


        if ($this->form_validation->run() == FALSE) {
            $status = 2;
            $pesan = validation_errors('<li class="text-danger">', '</li>');
        } else {
            $id_pegawai = $this->session->nip;
            //Cek  data pegawai
            $datapegawa = $this->pegawai->find($id_pegawai);
            if ($id_pegawai && $datapegawa->num_rows() > 0) {
                $dataself_assessment = $this->self_assessment->findNIP($id_pegawai);
                // if ($dataself_assessment->num_rows() > 0) {
                //     $status = 2;
                //     $pesan = "Terjadi kesalahan, Self Assessment sudah ada";
                // } else {
                # code...
                //cek self_assessment, kalo sudah ada tidak bisa input lagi
                $status = 1;
                //LOping
                $jml_ya = 0;
                $jml_tidak = 0;
                $total_ya = 0;
                $total_tidak = 0;
                foreach ($this->input->post() as $key => $value) {
                    if ($value == 1 || $value == 5) {
                        $jml_ya++;
                        $total_ya += $value;
                    } else {
                        $jml_tidak++;
                        $total_tidak += $value;
                    }
                }
                switch ($total_ya) {
                    case '0':
                        $keterangan = "";
                        break;

                    default:
                        $keterangan = "Tidak diketahui";
                        break;
                }

                //LOping
                $simpan = [
                    'id_pegawai' => $id_pegawai,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'q1' => $this->input->post("q1"),
                    'q2' => $this->input->post("q2"),
                    'q3' => $this->input->post("q3"),
                    'q4' => $this->input->post("q4"),
                    'q5' => $this->input->post("q5"),
                    'q6' => $this->input->post("q6"),
                    'q7' => $this->input->post("q7"),
                    'jml_ya' => $total_ya,
                    'jml_tidak' => $total_tidak,
                    'keterangan' => $keterangan,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $this->self_assessment->simpan($simpan);
                $pesan = "Berhasil disimpan";
                // }
            } else {
                $status = 2;
                $pesan = "Terjadi kesalahan, ID Pegawai tidak ada";
            }
        }


        $data = [
            'post' => $_POST,

            'status' => $status,
            'pesan' => $pesan
        ];



        $response = $data;
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}
