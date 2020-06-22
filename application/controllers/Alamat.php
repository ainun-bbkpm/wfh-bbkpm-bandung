<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alamat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getProp()
    {
        $token = $this->_getToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne$token/m/wilayah/provinsi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $data = json_decode($response);

        // $dataAPI = ['id' => '', 'name' => 'Pilih'];
        $dataAPI['dataapi'] = $data->data;
        // array_push($dataAPI['dataapi'],  ['id' => 0, 'name' => 'Pilih']);
        array_unshift($dataAPI['dataapi'], ['id' => 0, 'name' => 'Pilih Provinsi']);
        $data = str_replace('"name":', '"text":', json_encode($dataAPI['dataapi']));
        $response = json_decode($data);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function getKab()
    {
        $idpropinsi = $this->input->post('idpropinsi');
        $token = $this->_getToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne$token/m/wilayah/kabupaten?idpropinsi=$idpropinsi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $data = json_decode($response);
        $dataAPI['dataapi'] = $data->data;
        // array_push($dataAPI['dataapi'],  ['id' => 0, 'name' => 'Pilih']);
        array_unshift($dataAPI['dataapi'], ['id' => 0, 'name' => 'Pilih Kota/Kabupaten']);
        $data = str_replace('"name":', '"text":', json_encode($dataAPI['dataapi']));
        $response = json_decode($data);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
    public function getKec()
    {
        $idkabupaten = $this->input->post('idkabupaten');
        $token = $this->_getToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne$token/m/wilayah/kecamatan?idkabupaten=$idkabupaten",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response);
        $dataAPI['dataapi'] = $data->data;
        // array_push($dataAPI['dataapi'],  ['id' => 0, 'name' => 'Pilih']);
        array_unshift($dataAPI['dataapi'], ['id' => 0, 'name' => 'Pilih Kecamatan']);
        $data = str_replace('"name":', '"text":', json_encode($dataAPI['dataapi']));
        $response = json_decode($data);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function getKel()
    {

        $idkecamatan = $this->input->post('idkecamatan');
        $token = $this->_getToken();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne$token/m/wilayah/kelurahan?idkecamatan=$idkecamatan",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
        $data = json_decode($response);
        $response = str_replace('"name":', '"text":', json_encode($data->data));
        $response = json_decode($response);
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function _getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://x.rajaapi.com/poe",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response;
        $respontoken = json_decode($response);
        return $respontoken = $respontoken->token;
    }
}
