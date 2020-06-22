<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atasan_m extends CI_Model
{

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->order_by('id_atasan', 'ASC');
        return $this->db->get();
    }

    public function getByNipPegawai($id)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan', 'left');
        $this->db->join('ref_hak_akses', 'atasan.id_hak_akses=ref_hak_akses.id_hak_akses', 'left');
        $this->db->where('atasan.nip_pegawai=', $id);
        $this->db->order_by('atasan.id_atasan', 'ASC');
        return $this->db->get();
    }


    public function getByNipPegawaiWFH($id)
    {
        $this->db->select('*');
        $this->db->from('atasan_wfh');
        $this->db->join('pegawai', 'atasan_wfh.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja', 'left');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan', 'left');
        $this->db->join('ref_hak_akses', 'atasan_wfh.id_hak_akses=ref_hak_akses.id_hak_akses', 'left');
        $this->db->where('atasan_wfh.nip_pegawai=', $id);
        $this->db->order_by('atasan_wfh.id_atasan', 'ASC');
        return $this->db->get();
    }

    public function getAllByNipPegawai($nip)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan');
        $this->db->where('atasan.nip_pegawai=', $nip);
        $this->db->order_by('atasan.atasan_ke', 'ASC');
        return $this->db->get();
    }
    public function getAllByNipPegawaiStatus($nip)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan');
        $this->db->where('atasan.nip_pegawai=', $nip);
        $this->db->where('atasan.id_hak_akses=16');
        $this->db->order_by('atasan.atasan_ke', 'ASC');
        return $this->db->get();
    }


    public function getByNipPegawaiAndNipAtasan($nip_atasan, $nip_pegawai)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan');
        $this->db->where('atasan.nip_atasan=', $nip_atasan);
        $this->db->where('atasan.nip_pegawai=', $nip_pegawai);
        $this->db->order_by('atasan.atasan_ke', 'ASC');
        return $this->db->get();
    }

    public function getByNipPegawaiAndNipAtasanWhere($where)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_atasan=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan');
        $this->db->where($where);
        // $this->db->where('atasan.nip_pegawai=',$nip_pegawai);
        // $this->db->order_by('atasan.atasan_ke','ASC');
        return $this->db->get();
    }



    public function getAtasanByAtasan($nip)
    {
        $sql = "
        select
        *
        from
        atasan


        right join pegawai on atasan.`nip_atasan`=pegawai.`nip`
        left join ref_unit_kerja on pegawai.`id_unit_kerja`=ref_unit_kerja.`id_unit_kerja`
        left join ref_jabatan on pegawai.`id_jabatan`=ref_jabatan.`id_jabatan`

        where atasan.`nip_pegawai`='$nip' and (atasan.`pejabat_penilai` != '0' OR atasan.`atasan_langsung`!='0')
        ";

        return $this->db->query($sql);
    }

    public function getByNIPAtasan($id)
    {
        $this->db->select('*');
        $this->db->from('atasan');
        $this->db->join('pegawai', 'atasan.nip_pegawai=pegawai.nip', 'right');
        $this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja=ref_unit_kerja.id_unit_kerja');
        $this->db->join('ref_jabatan', 'pegawai.id_jabatan=ref_jabatan.id_jabatan');
        $this->db->where('atasan.nip_atasan=', $id);
        // $this->db->order_by('atasan.atasan_ke','ASC');
        return $this->db->get();
    }


    public function find($id)
    {
        return $this->db->get_where('atasan', ['id_atasan' => $id]);
    }

    public function hapus($id)
    {
        return $this->db->delete('atasan', ['id_atasan' => $id]);
    }

    public function update($data, $id)
    {
        return $this->db->update('atasan', $data, ['id_atasan' => $id]);
    }

    public function simpan($data)
    {
        return $this->db->insert('atasan', $data);
    }

    // WFH
    public function find_wfh($id)
    {
        return $this->db->get_where('atasan_wfh', ['id_atasan' => $id]);
    }

    public function hapus_wfh($id)
    {
        return $this->db->delete('atasan_wfh', ['id_atasan' => $id]);
    }

    public function update_wfh($data, $id)
    {
        return $this->db->update('atasan_wfh', $data, ['id_atasan' => $id]);
    }

    public function simpan_wfh($data)
    {
        return $this->db->insert('atasan_wfh', $data);
    }
}
