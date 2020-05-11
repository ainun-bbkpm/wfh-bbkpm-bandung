<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {

	public function getAll()
    {
        return $this->db->get('admin');
    }

	public function find($id)
    {
        return $this->db->get_where('admin',['id_admin'=>$id]);
    }

	public function hapus($id)
    {
        return $this->db->delete('admin',['id_admin'=>$id]);
    }

	public function update($data,$id)
    {
        return $this->db->update('admin',$data,['id_admin'=>$id]);
    }

	public function simpan($data)
    {
        return $this->db->insert('admin',$data);
    }

    public function login($id,$password)
    {
        $query = "
        SELECT 
        pegawai.*,
        admin.`id_admin`,
        admin.`username_admin`,
        admin.`email_admin`,
        admin.`no_hp_admin`,
        admin.`level_admin`,
        ref_unit_kerja.`id_unit_kerja`,
        ref_unit_kerja.`nama_unit_kerja`,
        ref_hak_akses.`id_hak_akses` AS hak_akses_unit_kerja,
        ref_hak_akses.`nama_hak_akses`,
        ref_jabatan.`id_jabatan`,
        ref_jabatan.`nama_jabatan`,
        ref_hak_akses2.`id_hak_akses`  AS hak_akses_jabatan,
        ref_hak_akses2.`nama_hak_akses`


        FROM
        pegawai

        JOIN admin ON pegawai.`nip`=admin.`nip_pegawai`
        INNER JOIN ref_unit_kerja ON pegawai.`id_unit_kerja`=ref_unit_kerja.`id_unit_kerja`
        INNER JOIN ref_hak_akses ON ref_unit_kerja.`hak_akses_unit_kerja`=ref_hak_akses.`id_hak_akses`
        INNER JOIN ref_jabatan ON pegawai.`id_jabatan`=ref_jabatan.`id_jabatan`
        LEFT JOIN ref_hak_akses ref_hak_akses2 ON ref_jabatan.`hak_akses_jabatan`=ref_hak_akses2.`id_hak_akses`

        
        WHERE (admin.username_admin='$id' OR admin.email_admin='$id' OR admin.no_hp_admin='$id' OR admin.id_admin='$id') AND admin.password_admin='$password'";
		// return $this->db->get();
		return $this->db->query($query);
    }
    


}
