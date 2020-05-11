<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Capaian_m','capaian');
    }


    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $id_capaian = $this->input->get('id');
                $id_unit_kerja = $this->input->get('id_unit_kerja');
                if ($id_capaian == NULL) {
                    $response =$this->capaian->getAll()->result();
                    $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                    
                } else {
                    $data =$this->capaian->getById($id_capaian);
                    if ($data->num_rows() == 0) {
                        $response =['pesan'=>'Id Tidak ditemukan'];
                        $this->output
                                ->set_status_header(404)
                                ->set_content_type('application/json', 'utf-8')
                                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                                ->_display();
                        exit;
                    } else {
                        # code...
                        $response =$data->row();
                        $this->output
                                ->set_status_header(200)
                                ->set_content_type('application/json', 'utf-8')
                                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                                ->_display();
                        exit;
                    }
                    
                }
                
                break;
            case 'POST':
                $response =$this->input->post();
                $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                        ->_display();
                exit;
                break;
            
            case 'PUT':
                $response =$this->input->input_stream();
                $this->output
                        ->set_status_header(200)
                        ->set_content_type('application/json', 'utf-8')
                        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                        ->_display();
                exit;
                break;
            default:
                
                
                break;
        }


       
    }

    public function capaian_unitkerja()
    {
        $id_capaian = $this->input->post('id');
        $data =$this->capaian->getByIdUnitKerja($id_capaian);
        if ($data->num_rows() == 0) {
            $response =['pesan'=>'Id Tidak ditemukan'];
            $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
            exit;
        } else {
            # code...
            $response =$data->result();
            foreach ($response as $option) {
               echo "<option value='".$option->id_capaian."'>".$option->nama_capaian."</option>";
            }
            exit;
        }
    }



}