<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('pegawai');
    }
    public function getAllJoinAdmin()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('admin', 'pegawai.nip=admin.nip_pegawai', 'left');
        return $this->db->get();
    }

    public function getAllJoin()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan', 'left');
        return $this->db->get();
    }

    public function find($id)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan', 'left');

        $this->db->where('pegawai.nip', $id);
        return $this->db->get();
    }
    public function findwhere($where)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan', 'left');
        $this->db->join('login', 'pegawai.nip=login.nip_pegawai', 'left');
        $this->db->where($where);
        return $this->db->get();
    }

    public function findno_abs($no_abs)
    {
        $this->db->select('*');
        $this->db->from('pegawai');

        $this->db->where('pegawai.no_abs', $no_abs);
        return $this->db->get();
    }

    public function hapus($id)
    {
        return $this->db->delete('pegawai', ['nip' => $id]);
    }

    public function update($data, $id)
    {
        return $this->db->update('pegawai', $data, ['nip' => $id]);
    }

    public function simpan($data)
    {
        return $this->db->insert('pegawai', $data);
    }

    public function insert_multiple($data)
    {
        $this->db->insert_batch('ref_pegawai', $data);
    }
    public function insert_multiple2($data)
    {
        $this->db->insert_batch('pegawai', $data);
    }

    public function login($id, $password)
    {
        $query = "SELECT * FROM pegawai WHERE (username_pegawai='$id' OR email_pegawai='$id' OR no_hp_pegawai='$id' OR nip='$id') AND password_pegawai='$password'";
        // return $this->db->get();
        return $this->db->query($query);
    }
}
