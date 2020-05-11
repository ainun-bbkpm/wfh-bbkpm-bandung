<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hot extends CI_Controller {




    public function index()
    {
        $this->load->view('hot/index');
    }
    public function hot2()
    {
        $this->load->view('hot/index2');
    }

}