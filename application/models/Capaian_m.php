<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capaian_m extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('tr_capaian');
    }


    public function getById($id)
    {
        return $this->db->get_where('tr_capaian', ['id_capaian' => $id]);
    }
    public function getByIdIndikator($id)
    {
        return $this->db->get_where('tr_capaian', ['id_indikator' => $id]);
    }

    public function update($data, $id)
    {
        return $this->db->update('tr_capaian', $data, ['id_capaian' => $id]);
    }
    public function update2($data, $datasimpan, $id)
    {


        // return $this->db->update('tr_capaian',$data,['id_capaian'=>$id]);

        $this->db->trans_begin();

        $this->db->update('tr_capaian', $data, ['id_capaian' => $id]);
        $this->db->insert('tr_ajuan', $datasimpan);



        if ($this->db->trans_status() === FALSE) {
            return  $this->db->trans_rollback();
        } else {
            return  $this->db->trans_commit();
        }
    }


    public function updatebyindikator($data, $id)
    {
        return $this->db->update('tr_capaian', $data, ['id_indikator' => $id]);
    }




    public function getAllByIdIndikator($id)
    {
        $this->db->select('*');
        $this->db->from('tr_capaian');

        $this->db->where('tr_capaian.id_indikator=', $id);
        return $this->db->get();

        // return $this->db->get('tr_indikator');
    }

    public function simpan($data)
    {
        return $this->db->insert('tr_capaian', $data);
    }


    public function validasi_cetak($bulan, $nip, $status)
    {
        $query = "
        SELECT 

      
        remun.`id_remun` as id_remun,
        tr_indikator.`id_indikator` as id_indikator,
        tr_capaian.`id_capaian` as id_capaian
      




        FROM remun

        LEFT JOIN tr_indikator ON remun.`id_remun`=tr_indikator.`id_remun`         
        LEFT JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator`

        WHERE  remun.`nip`='$nip' AND tr_capaian.`bulan` LIKE '%$bulan%' AND STATUS='$status'

        ORDER BY remun.`created_at` ASC
        ";

        return $this->db->query($query);
    }

    public function total_yang_dicetak($bulan, $nip)
    {
        $query = "
        SELECT 

      
        remun.`id_remun` as id_remun,
        tr_indikator.`id_indikator` as id_indikator,
        tr_capaian.`id_capaian` as id_capaian
      




        FROM remun

        LEFT JOIN tr_indikator ON remun.`id_remun`=tr_indikator.`id_remun`         
        LEFT JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator`

        WHERE  remun.`nip`='$nip' AND tr_capaian.`bulan` LIKE '%$bulan%' 

        ORDER BY remun.`created_at` ASC
        ";

        return $this->db->query($query);
    }



    public function cetak($bulan, $nip)
    {
        $query = "
        SELECT * FROM remun

         /* JOIN penilaian ON penilaian.`id_penilaian`=remun.`id_penilaian`

        JOIN tr_indikator ON remun.`id_remun`=tr_indikator.`id_remun` 

        JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator` 

        WHERE tr_capaian.`bulan` LIKE '%$bulan%' AND remun.`nip`='$nip' */


         WHERE  remun.`nip`='$nip'

         ORDER BY remun.`created_at` ASC
        ";

        return $this->db->query($query);
    }

    public function getByIdRemunJoin($bulan, $id_remun)
    {
        $query = "
        SELECT * FROM tr_indikator

	    JOIN tr_capaian ON tr_indikator.`id_indikator`=tr_capaian.`id_indikator`
	    
        
        WHERE tr_indikator.id_remun='$id_remun' AND tr_capaian.`bulan` LIKE '%$bulan%'

       
        

        ";

        return $this->db->query($query);
    }

    public function getCapaianByIndikator($id, $bulan)
    {
        $query = "
        SELECT * FROM tr_capaian


        WHERE tr_capaian.`id_indikator`='$id' AND tr_capaian.`bulan`='$bulan'
        
        
        
        ";

        return $this->db->query($query);
    }

    public function hapus($id)
    {

        return $this->db->delete('tr_capaian', ['id_capaian' => $id]);
    }
    public function hapusByIndikator($id)
    {

        return $this->db->delete('tr_capaian', ['id_indikator' => $id]);
    }
}
