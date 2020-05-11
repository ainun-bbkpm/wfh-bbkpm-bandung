<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator_m extends CI_Model {

    public function getAll()
    {
        return $this->db->get('tr_indikator');
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tr_indikator');

        $this->db->where('tr_indikator.id_indikator=',$id);
        return $this->db->get();

        // return $this->db->get('tr_indikator');
    }

    public function getAllByIdRemun($id)
    {
        $this->db->select('*');
        $this->db->from('tr_indikator');

        $this->db->where('tr_indikator.id_remun=',$id);
        $this->db->order_by('created_at','ASC');
        return $this->db->get();

        // return $this->db->get('tr_indikator');
    }

    public function total_bobot_indikator($id)
    {
        $query="
        SELECT 

        *,
       

        ROUND(SUM(tr_indikator.`bobot`), 3) AS total_bobot

        FROM
        tr_indikator
        WHERE tr_indikator.`id_remun`='$id'
        ";

        return $this->db->query($query);
    }


    public function hapus($id)
    {
        $this->db->delete('tr_capaian',['id_indikator'=>$id]);
        return $this->db->delete('tr_indikator',['id_indikator'=>$id]);
    }


}