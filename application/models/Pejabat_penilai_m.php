
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat_penilai_m extends CI_Model {

    public $_table = "pejabat_penilai";

    public function login($nip,$password)
    {
        return $this->db->get_where($this->_table,['nip'=>$nip,'password'=>$password]);
    }

}
