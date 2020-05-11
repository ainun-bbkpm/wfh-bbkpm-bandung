<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends CI_Model {

	public function getAll()
    {
        // return $this->db->get('ref_unit_kerja');
        $this->db->select('*');
        $this->db->from('ref_unit_kerja');
        $this->db->join('ref_hak_akses','ref_unit_kerja.hak_akses_unit_kerja=ref_hak_akses.id_hak_akses');
        return $this->db->get();
    }

	public function find($id)
    {
        return $this->db->get_where('ref_unit_kerja',['id_unit_kerja'=>$id]);
    }

	public function hapus($id)
    {
        $this->db->delete('ref_jabatan',['id_unit_kerja'=>$id]);
        return $this->db->delete('ref_unit_kerja',['id_unit_kerja'=>$id]);
    }

	public function update($data,$id)
    {
        return $this->db->update('ref_unit_kerja',$data,['id_unit_kerja'=>$id]);
    }

	public function simpan($data)
    {
        return $this->db->insert('ref_unit_kerja',$data);
    }

    
    


}
