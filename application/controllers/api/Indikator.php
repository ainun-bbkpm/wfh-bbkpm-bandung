<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Indikator_m','indikator');
    }


    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $id_indikator = $this->input->get('id');
               
                if ($id_indikator == NULL) {
                    $response =$this->indikator->getAll()->result();
                    $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                    
                } else {
                    $data =$this->indikator->getById($id_indikator);
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

    public function jumlah()
    {
        $response =$this->indikator->getAll()->num_rows();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
        exit;
    }

    


}