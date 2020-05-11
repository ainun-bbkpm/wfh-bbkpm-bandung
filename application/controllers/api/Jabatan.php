<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Jabatan_m','jabatan');
    }


    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $id_jabatan = $this->input->get('id');
                $id_unit_kerja = $this->input->get('id_unit_kerja');
                if ($id_jabatan == NULL) {
                    $response =$this->jabatan->getAll()->result();
                    $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                    
                } else {
                    $data =$this->jabatan->find($id_jabatan);
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
            case 'DELETE':
                
                $id_unit_kerja =$this->input->input_stream('id');
                $data =$this->jabatan->find($id_unit_kerja);
                
                if ($data->num_rows() == 0) {
                    $response =['pesan'=>'Id Tidak ditemukan'];
                    $this->output
                            ->set_status_header(404)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                } else {
                    $hapus =$this->jabatan->hapus($id_unit_kerja);
                    if ($hapus) {
                       $data=['status'=>1,'pesan'=>'Berhasil dihapus'];
                    } else {
                        $data=['status'=>0,'pesan'=>'Gagal dihapus'];
                    }
                    
                    $response =$data;
                    $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                }
            default:
                
                
                break;
        }


       
    }




    public function unit_kerja()
    {
        $id_unit_kerja = $this->input->get('id');
        $data =$this->jabatan->getByIdUnitKerja($id_unit_kerja);
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
            $response =['data'=>$data->result()];
            $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
            
            exit;
        }
    }


    public function jabatan_unitkerja()
    {
        $id_jabatan = $this->input->post('id');
        $data =$this->jabatan->getByIdUnitKerja($id_jabatan);
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
               echo "<option value='".$option->id_jabatan."'>".$option->nama_jabatan."</option>";
            }
            exit;
        }
    }



}