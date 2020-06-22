<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Self_assessment_m extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('self_assessment');
    }

    public function find($id)
    {
        return $this->db->get_where('self_assessment', ['id_self_assessment' => $id]);
    }
    public function findNIP($nip)
    {
        return $this->db->get_where('self_assessment', ['id_pegawai' => $nip]);
    }

    public function hapus($id)
    {
        return $this->db->delete('self_assessment', ['id_self_assessment' => $id]);
    }

    public function update($data, $id)
    {
        return $this->db->update('self_assessment', $data, ['id_self_assessment' => $id]);
    }

    public function simpan($data)
    {
        return $this->db->insert('self_assessment', $data);
    }
}
