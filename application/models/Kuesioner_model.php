<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner_model extends CI_Model {
    
    public function get_all_destinasi()
    {
        // Mengambil kolom 'nama_destinasi' dari tabel 'destinasi_wisata'
        $this->db->select('nama_destinasi');
        $query = $this->db->get('destinasi_wisata');
        
        // Mengembalikan hasilnya sebagai array of objects (atau array of arrays, tergantung preferensi Anda)
        // Kita gunakan result_array() agar lebih mudah diolah di view
        return $query->result_array(); 
    }
    
    public function search_destinasi($keyword) {
        $this->db->like('nama_destinasi', $keyword, 'both');
        $query = $this->db->get('destinasi_wisata');
        
        $result = [];
        foreach ($query->result() as $row) {
            $result[] = $row->nama_destinasi;
        }
        return $result;
    }
    public function save_kuesioner_data($responden, $penilaian) 
    {
        $this->db->trans_start();

        // Simpan data responden
        $this->db->insert('responden', $responden);
        $responden_id = $this->db->insert_id();

        // Simpan penilaian (kenyataan dan harapan)
        foreach ($penilaian as $nilai) {
        $data = [
            'id_responden'   => $responden_id,
            'pertanyaan_id'  => $nilai['pertanyaan_id'],
            'skala_nilai'    => $nilai['skala_nilai'],
            'harapan'        => $nilai['harapan']
        ];
        $this->db->insert('penilaian_fasilitas', $data);
    }


        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    public function get_all_pertanyaan()
    {
        $query = $this->db->get('daftar_pertanyaan_fasilitas');
        return $query->result_array();
    }



}
