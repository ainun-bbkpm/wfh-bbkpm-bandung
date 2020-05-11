<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jabatan_m extends CI_Model {

	public function getAll()
    {
        // return $this->db->get('ref_jabatan');
        $this->db->select('*');
        $this->db->from('ref_jabatan');
        $this->db->join('ref_hak_akses','ref_jabatan.hak_akses_jabatan=ref_hak_akses.id_hak_akses');
        return $this->db->get();
    }

    public function getByIdUnitKerja($id_unit_kerja)
    {
        $this->db->select('*');
        $this->db->from('ref_jabatan');
        $this->db->join('ref_hak_akses','ref_jabatan.hak_akses_jabatan=ref_hak_akses.id_hak_akses');
        $this->db->where('ref_jabatan.id_unit_kerja=',$id_unit_kerja);    
        return $this->db->get();
        // return $this->db->get_where('ref_jabatan',['id_unit_kerja'=>$id_unit_kerja]);    
    }

	public function find($id)
    {
        return $this->db->get_where('ref_jabatan',['id_jabatan'=>$id]);
    }

	public function hapus($id)
    {
        return $this->db->delete('ref_jabatan',['id_jabatan'=>$id]);
    }

	public function update($data,$id)
    {
        return $this->db->update('ref_jabatan',$data,['id_jabatan'=>$id]);
    }

	public function simpan($data)
    {
        return $this->db->insert('ref_jabatan',$data);
    }

    
    


}
