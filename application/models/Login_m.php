
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_m extends CI_Model
{

    public function getAll()
    {
        $query = "
        SELECT
        *,
        pegawai.`nama_pegawai` AS nama_login

        FROM
        login

        LEFT JOIN pegawai ON login.`nip_pegawai`=pegawai.`nip`
        ";
        return $this->db->query($query);
        // return $this->db->get('login');
    }

    public function login($username, $password, $level)
    {
        $query = "
        SELECT
        *,
        pegawai.`nama_pegawai` AS nama_login

        FROM
        login

        LEFT JOIN pegawai ON login.`nip_pegawai`=pegawai.`nip`
        

        WHERE
            (
                login.`nip_pegawai`='$username' 
            OR pegawai.`nip2`='$username'
            OR pegawai.`nik`='$username'
            OR login.`email`='$username' 
            OR login.`no_hp`='$username'
            OR login.`username`='$username')
            AND login.`password`='$password'
            AND login.`level`='$level'
        ";
        return $this->db->query($query);
    }
    public function login_wfh($username, $password)
    {
        $query = "
        SELECT
        *,
        pegawai.`nama_pegawai` AS nama_login

        FROM
        login

        INNER JOIN pegawai ON login.`nip_pegawai`=pegawai.`nip`
        

        WHERE
            (
                login.`nip_pegawai`='$username' 
            OR pegawai.`nip2`='$username'
            OR pegawai.`nik`='$username'
            OR login.`email`='$username' 
            OR login.`no_hp`='$username'
            OR login.`username`='$username')
            AND login.`password`='$password'
            
        ";
        return $this->db->query($query);
    }

    public function find($id)
    {
        return $this->db->get_where('login', ['id_login' => $id]);
    }


    public function getByNipPegawai($nip)
    {
        return $this->db->get_where('login', ['nip_pegawai' => $nip]);
    }

    public function update($update, $id_login)
    {
        return $this->db->update('login', $update, ['id_login' => $id_login]);
    }

    public function simpan($data_modif)
    {
        return $this->db->insert('login', $data_modif);
    }

    public function hapus($id)
    {
        return $this->db->delete('login', ['id_login' => $id]);
    }
}
