<?php
defined('BASEPATH') or exit('No direct script access allowed');

class remun_m extends CI_Model
{


    public function getAll()
    {
        // return $this->db->get('remun');
        $this->db->select('*');
        $this->db->from('remun');
        // $this->db->join('ref_hak_akses','remun.hak_akses_remun=ref_hak_akses.id_hak_akses');
        return $this->db->get();
    }

    public function getByNIP($id)
    {
        $this->db->select('*');
        $this->db->from('remun');
        $this->db->join('penilaian', 'remun.id_penilaian=penilaian.id_penilaian');
        $this->db->where('remun.nip=', $id);
        $this->db->order_by('remun.id_remun', 'ASC');
        return $this->db->get();
        // return $this->db->get_where('remun',['id_unit_kerja'=>$id_unit_kerja]);    
    }

    public function getByNIPAndPenilaian($id, $id_penilaian)
    {
        $this->db->select('*');
        $this->db->from('remun');
        $this->db->join('penilaian', 'remun.id_penilaian=penilaian.id_penilaian');
        $this->db->where('remun.nip=', $id);
        $this->db->where('penilaian.id_penilaian=', $id_penilaian);
        $this->db->order_by('remun.id_remun', 'ASC');
        return $this->db->get();
        // return $this->db->get_where('remun',['id_unit_kerja'=>$id_unit_kerja]);    
    }


    public function getByNIPAndThn($id, $thn)
    {
        $this->db->select('*');
        $this->db->from('remun');
        $this->db->join('penilaian', 'remun.id_penilaian=penilaian.id_penilaian');
        $this->db->where('remun.nip=', $id);
        $where = "remun.`nip`='$id' AND remun.`tgl_remun` LIKE '%$thn%'";
        // $where = "remun.`nip`='$id' AND remun.`created_at` LIKE '%$thn%'";
        $this->db->where($where);
        $this->db->order_by('remun.id_penilaian', 'ASC');
        return $this->db->get();
    }

    public function getByIdRemunJoin($id_remun)
    {
        $this->db->select('*');
        $this->db->from('remun');
        $this->db->where('remun.id_remun', $id_remun);
        return  $this->db->get();

        // $this->db->get_where($this->_table,['nip'=>$nip]);
    }
    public function getByIdJoinPenilaian($id_remun)
    {
        $this->db->select('*');
        $this->db->from('remun');
        $this->db->join('penilaian', 'remun.id_penilaian=penilaian.id_penilaian');
        $this->db->where('remun.id_remun', $id_remun);
        return  $this->db->get();

        // $this->db->get_where($this->_table,['nip'=>$nip]);
    }

    public function find($id)
    {
        return $this->db->get_where('remun', ['id_remun' => $id]);
    }


    public function findByPenilaianAndId($id_penilaian, $nip)
    {
        return $this->db->get_where('remun', ['id_penilaian' => $id_penilaian, 'nip' => $nip]);
    }

    public function findByPenilaianAndIdAndThn($id_penilaian, $nip, $thn)
    {
        $query = "SELECT
        *
        FROM
        remun

        WHERE 
        remun.`id_penilaian`='$id_penilaian' AND remun.`nip`='$nip' OR  remun.`no_abs`='$nip' AND remun.`created_at` LIKE '%$thn%'";

        return $this->db->query($query);
    }

    public function hapus($id)
    {

        // $this->db->delete('tr_indikator', ['id_remun' => $id]);
        // return $this->db->delete('remun', ['id_remun' => $id]);

        $sql = "
        DELETE
        tr_indikator, remun, tr_capaian

        FROM
        remun

        LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        LEFT JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator`

        WHERE remun.`id_remun`='$id'
        ";


        return $this->db->query($sql);
    }

    public function update($data, $id)
    {
        return $this->db->update('remun', $data, ['id_remun' => $id]);
    }

    public function update_indikator($data, $id)
    {
        return $this->db->update('tr_indikator', $data, ['id_indikator' => $id]);
    }

    public function simpan_penilaian($data)
    {
        return $this->db->insert('remun', $data);
    }

    public function simpan_indikator($data)
    {
        return $this->db->insert('tr_indikator', $data);
    }

    //Query Get Capaian PerBulan lewat id remun
    public function queryGetCapaianByIdRemun($id_remun, $bulan)
    {
        $sql = "
        SELECT
        tr_capaian.`id_capaian` AS id_capaian,
        tr_indikator.`id_indikator` AS id_indikator,
        tr_indikator.`indikator` AS indikator,
        tr_indikator.`definisi` AS definisi,
        tr_indikator.`target` AS target,

        /* Penambahan Range target */
        IF(tr_indikator.`range_target1` IS NULL OR tr_indikator.`range_target1` = 0, '',CONCAT(tr_indikator.`range_target1`,'-',tr_indikator.`range_target2`)) AS range_target12,
        
        
        tr_capaian.`target` AS target_perbulan,
        
        
        COALESCE(ROUND(tr_capaian.`capaian`,3),0) AS capaian,
        
        
        
        tr_indikator.`bobot` AS bobot,
        
        
        tr_capaian.`hasil_kinerja` AS hasil_kinerja,



        tr_capaian.`status` AS status,
        tr_capaian.`approved_by` AS approved_by,
        pegawai.`nama_pegawai` AS nama_approved_by,
        tr_capaian.`return_by` AS return_by,
        pegawai2.`nama_pegawai` AS nama_return_by,


        COALESCE(ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3), 0)  AS hasil_kinerja2
         
        


        /*
        jika pakai ini maka nilai (1/1)*0.02   0.0199
        TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4)  AS hasil_kinerja2


        jika pakai ini maka nilai (1/1)*0.02   0.020 dibulatkan
        ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3)  AS hasil_kinerja2


        */

        FROM
        tr_capaian

        LEFT JOIN tr_indikator ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator`
        LEFT JOIN pegawai ON pegawai.`nip`=tr_capaian.`approved_by`
        LEFT JOIN pegawai AS pegawai2 ON pegawai2.`nip`=tr_capaian.`return_by`  
        

        WHERE tr_indikator.`id_remun`='$id_remun' AND tr_capaian.`bulan` LIKE '%$bulan%'
        ";

        return $this->db->query($sql);
    }

    public function queryGetJumlahHasilKinerjaCapaianByIdRemun($id_remun, $bulan)
    {
        $sql = "
        SELECT
       
		
        sum(COALESCE(ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3), 0))  AS hasil_kinerja
         
      
        FROM
        tr_capaian

        LEFT JOIN tr_indikator ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator`
        LEFT JOIN pegawai ON pegawai.`nip`=tr_capaian.`approved_by`
        LEFT JOIN pegawai AS pegawai2 ON pegawai2.`nip`=tr_capaian.`return_by`  
        

        WHERE tr_indikator.`id_remun`='$id_remun' AND tr_capaian.`bulan` LIKE '%$bulan%'
        ";

        return $this->db->query($sql);
    }

    public function queryGetJumlahHasilKinerjaCapaianByNipBulan($nip, $bulan)
    {
        $sql = "
        SELECT
       
		
        sum(COALESCE(ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3), 0))  AS hasil_kinerja
         
      
        FROM
       remun
       
       LEFT JOIN tr_indikator on remun.id_remun=tr_indikator.id_remun
       LEFT JOIN tr_capaian on tr_indikator.id_indikator=tr_capaian.id_indikator
        
        

        WHERE remun.`nip`='$nip' AND tr_capaian.`bulan` LIKE '%$bulan%'
        ";

        return $this->db->query($sql);
    }

    public function queryGetCapaianByIdRemunStatus($id_remun, $bulan, $status = NULL)
    {
        $sql = "
        SELECT
        tr_capaian.`id_capaian` AS id_capaian,
        tr_indikator.`id_indikator` AS id_indikator,
        tr_indikator.`indikator` AS indikator,
        tr_indikator.`definisi` AS definisi,
        tr_indikator.`target` AS target,
        tr_capaian.`target` AS target_perbulan,

        COALESCE(ROUND(tr_capaian.`capaian`,3),0) AS capaian,



        tr_indikator.`bobot` AS bobot,
        tr_capaian.`hasil_kinerja` AS hasil_kinerja,
        tr_capaian.`status` AS status,
        tr_capaian.`approved_by` AS approved_by,
        pegawai.`nama_pegawai` AS nama_approved_by,
        tr_capaian.`return_by` AS return_by,
        pegawai2.`nama_pegawai` AS nama_return_by,

        COALESCE(ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3), 0)  AS hasil_kinerja2
         
        
        /*
        TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4)  AS hasil_kinerja2

        ROUND(TRUNCATE(((tr_capaian.`capaian`/tr_capaian.`target`)*tr_capaian.`bobot`),4),3)  AS hasil_kinerja2

        */

        FROM
        tr_capaian

        LEFT JOIN tr_indikator ON tr_capaian.`id_indikator`=tr_indikator.`id_indikator`
        LEFT JOIN pegawai ON pegawai.`nip`=tr_capaian.`approved_by`
        LEFT JOIN pegawai AS pegawai2 ON pegawai2.`nip`=tr_capaian.`return_by`  
        

        WHERE tr_indikator.`id_remun`='$id_remun' AND tr_capaian.`bulan` LIKE '%$bulan%' AND tr_capaian.`status` = '$status'


        ";

        return $this->db->query($sql);
    }

    public function getcapaianByIdAtasan($nip_atasan)
    {
        $query = "
        SELECT

        pegawai.`nip` AS nip_pegawai,
        pegawai.`nama_pegawai` AS nama_pegawai,
   
        tr_capaian.`updated_at` AS tgl_ajuan,
        remun.`id_remun` AS id_remun,
        tr_indikator.`id_indikator` AS id_indikator,
        tr_capaian.`id_capaian` AS id_capaian,
        atasan.`atasan_ke` AS atasan_ke,
        tr_capaian.`status` AS STATUS,
        tr_capaian.`approved_by` AS approved_by,
               pegawai2.`nama_pegawai` AS nama_approved_by,
               pegawai3.`nama_pegawai` AS nama_return_by

        FROM

        atasan

        RIGHT JOIN pegawai ON pegawai.`nip`=atasan.`nip_pegawai`

        LEFT JOIN remun ON pegawai.`nip`=remun.`nip`
        LEFT JOIN penilaian ON remun.`id_penilaian`=penilaian.`id_penilaian`
        LEFT JOIN tr_indikator ON tr_indikator.`id_remun`=remun.`id_remun`
        LEFT JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator`
        LEFT JOIN pegawai AS pegawai2 ON pegawai2.`nip`=tr_capaian.`approved_by`
        LEFT JOIN pegawai AS pegawai3 ON pegawai3.`nip`=tr_capaian.`return_by`   



        WHERE atasan.`nip_atasan`='$nip_atasan' AND tr_capaian.`status`!='0'
        GROUP BY pegawai.`nama_pegawai`, tr_capaian.`status`
        
        ORDER BY tr_capaian.`updated_at` DESC
        

        ";

        return $this->db->query($query);
    }
    public function getcapaianByIdAtasanWHF($nip_atasan)
    {
        $query = "
        SELECT
        pegawai.`nip` AS nip_pegawai,
        pegawai2.`nama_pegawai` AS nama_atasan,
        pegawai.`nama_pegawai` AS nama_pegawai,
       
        atasan.`atasan_ke` AS atasan_ke,

        ref_wfh.*,
        pegawai3.nama_pegawai as nama_approved_by
        
        
        FROM
        
        atasan


        RIGHT JOIN pegawai
            ON pegawai.`nip` = atasan.`nip_pegawai`


        LEFT JOIN pegawai AS pegawai2
            ON pegawai2.`nip` = atasan.`nip_atasan`
            
       
		

            LEFT JOIN ref_wfh ON pegawai.`nip`=ref_wfh.`id_pegawai`
            
            LEFT JOIN pegawai as pegawai3 ON pegawai3.nip=ref_wfh.`approved_by`
        WHERE atasan.`nip_atasan` = '$nip_atasan'
        GROUP BY pegawai.`nama_pegawai`, ref_wfh.`tgl_absen`
        ";

        return $this->db->query($query);
    }

    public function laporan_wfh($where)
    {
        $sql = "SELECT B.nama_pegawai, B.nip2, DATE_FORMAT(A.tgl_absen,'%d-%m-%Y') AS tgl_absen, A.jam_absen_hadir, A.jam_absen_pertengahan, A.jam_absen_pulang, COALESCE(C.uraian_kegiatan,'') AS uraian_kegiatan, COALESCE(A.demam,'') AS demam, COALESCE(A.sesak,'') AS sesak, COALESCE(A.batuk,'') AS batuk, COALESCE(A.nyeri_nelan,'') AS nyeri_nelan, A.nilai_kinerja, A.catatan, COALESCE((SELECT D.nama_pegawai FROM pegawai D WHERE D.nip=A.approved_by),'') AS penilai, COALESCE((SELECT E.nip2 FROM pegawai E WHERE E.nip=A.approved_by),'') AS nip
                FROM ref_wfh A
                INNER JOIN pegawai B ON A.id_pegawai = B.nip
                LEFT JOIN tr_log_wfh C ON A.id_wfh = C.id_wfh
                WHERE A.id_wfh = ?";
        $query = $this->db->query($sql, $where);

        return $query->result_array();
    }

    public function rekap($where)
    {
        $sql = "SELECT COALESCE(B.nip2,B.nik) AS id, B.nama_pegawai, A.tgl_absen, A.jam_absen_hadir, A.jam_absen_pertengahan, A.jam_absen_pulang, A.nilai_kinerja, (SELECT C.nama_pegawai FROM pegawai C WHERE C.nip = ?) AS penilai, (SELECT D.nip2 FROM pegawai D WHERE D.nip = ?) AS nip
                FROM ref_wfh A
                INNER JOIN pegawai B ON B.nip = A.id_pegawai
                WHERE DATE_FORMAT(A.tgl_absen,'%d-%m-%Y') BETWEEN ? AND ?
                AND approved_by = ?";
        $query = $this->db->query($sql, $where);

        return $query->result_array();
    }
}
