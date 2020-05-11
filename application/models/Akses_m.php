<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_m extends CI_Model {

	public function getAll()
    {
        return $this->db->get('ref_hak_akses');
    }

	public function find($id)
    {
        return $this->db->get_where('ref_hak_akses',['id_hak_akses'=>$id]);
    }

	public function hapus($id)
    {
        return $this->db->delete('ref_hak_akses',['id_hak_akses'=>$id]);
    }

	public function update($data,$id)
    {
        return $this->db->update('ref_hak_akses',$data,['id_hak_akses'=>$id]);
    }

	public function simpan($data)
    {
        return $this->db->insert('ref_hak_akses',$data);
    }

    
    


}
