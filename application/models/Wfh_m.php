<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wfh_m extends CI_Model
{

    public function getAll()
    {
        // return $this->db->get('ref_wfh');
        $this->db->select('*');
        $this->db->from('ref_wfh');
        $this->db->join('ref_hak_akses', 'ref_wfh.hak_akses_wfh=ref_hak_akses.id_hak_akses');
        return $this->db->get();
    }

    public function find($id)
    {
        return $this->db->get_where('ref_wfh', ['id_wfh' => $id]);
    }
    public function where($where)
    {
        return $this->db->get_where('ref_wfh', $where);
    }

    public function hapus($id)
    {
        // $this->db->delete('ref_jabatan',['id_wfh'=>$id]);
        return $this->db->delete('ref_wfh', ['id_wfh' => $id]);
    }

    public function update($data, $where)
    {
        return $this->db->update('ref_wfh', $data, $where);
    }

    public function simpan($data)
    {
        return $this->db->insert('ref_wfh', $data);
    }



    public function simapnlogbook($data)
    {
        return $this->db->insert('tr_log_wfh', $data);
    }
}
