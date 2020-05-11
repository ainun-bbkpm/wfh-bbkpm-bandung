<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class W2ui extends CI_Controller {




    public function index()
    {
        $this->load->view('w2ui/index');
    }

}