<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class penilaian_m extends CI_Model {

	public function getAll()
    {
        return $this->db->get('penilaian');
    }

	public function find($id)
    {
        return $this->db->get_where('penilaian',['id_penilaian'=>$id]);
    }
	public function getByName($nama_penilaian)
    {
        return $this->db->get_where('penilaian',['nama_penilaian'=>$nama_penilaian]);
    }

	public function hapus($id)
    {
        return $this->db->delete('penilaian',['id_penilaian'=>$id]);
    }

	public function update($data,$id)
    {
        return $this->db->update('penilaian',$data,['id_penilaian'=>$id]);
    }

	public function simpan($data)
    {
        return $this->db->insert('penilaian',$data);
    }

    
    


}
