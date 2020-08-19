<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wfh_m extends CI_Model
{

    public function getAll()
    {
        // return $this->db->get('ref_wfh');
        $this->db->select('*');
        $this->db->from('ref_wfh');
        // $this->db->join('ref_hak_akses', 'ref_wfh.hak_akses_wfh=ref_hak_akses.id_hak_akses');
        return $this->db->get();
    }

    public function getAllJoin()
    {
        $query = "SELECT


        ref_wfh.`id_wfh`,
        pegawai.`nip`,
        ref_wfh.`foto_absen_hadir`,
        pegawai.`nama_pegawai`,
        ref_unit_kerja.`nama_unit_kerja`,
        ref_jabatan.`nama_jabatan`,
        ref_wfh.`tgl_absen`,
        ref_wfh.`jam_absen_hadir`,
        ref_wfh.`jam_absen_pertengahan`,
        ref_wfh.`jam_absen_pulang`,
        ref_wfh.`nilai_kinerja`,
        ref_wfh.`status`
        
        
        FROM
        
        ref_wfh
        
        INNER JOIN pegawai ON ref_wfh.`id_pegawai`=pegawai.`nip`
        INNER JOIN ref_unit_kerja ON pegawai.`id_unit_kerja`=ref_unit_kerja.`id_unit_kerja`
        INNER JOIN ref_jabatan ON ref_unit_kerja.`id_unit_kerja`=ref_jabatan.`id_unit_kerja`
        
        
        
        -- WHERE ref_wfh.`tgl_absen`='2020-06-17'
        
        GROUP BY pegawai.`nama_pegawai`
        ";
        return $this->db->query($query);
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
