<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    const TBL_RESPONDEN = 'responden';
    const TBL_PENILAIAN = 'penilaian_fasilitas';
    const TBL_TERBUKA   = 'pertanyaan_terbuka';
    const TBL_DAFTAR    = 'daftar_pertanyaan_fasilitas';
    const TBL_ADMIN     = 'admin';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function cek_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        return $this->db->get('admin')->row();
    }

    public function count_all_responden() {
        return $this->db->count_all(self::TBL_RESPONDEN);
    }

    public function get_rata_rata_persentase_per_pertanyaan($bulan = null, $tahun = null) 
{
    $this->db->select('dp.teks_pertanyaan, 
        ROUND(SUM(pf.skala_nilai) / SUM(pf.harapan) * 100, 2) AS total_presentase');
    $this->db->from('responden r');

    // filter langsung di responden
    if ($bulan) {
        $this->db->where('MONTH(r.tanggal_pengisian)', $bulan);
    }
    if ($tahun) {
        $this->db->where('YEAR(r.tanggal_pengisian)', $tahun);
    }

    $this->db->join('penilaian_fasilitas pf', 'pf.id_responden = r.id_responden');
    $this->db->join('daftar_pertanyaan_fasilitas dp', 'dp.id_pertanyaan = pf.pertanyaan_id');

    $this->db->group_by('pf.pertanyaan_id');

    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->result() : [];
}



    public function get_all_daftar_pertanyaan($search_term = null) {
        if ($search_term) {
            $this->db->like('teks_pertanyaan', $search_term);
        }
        return $this->db->order_by('id_pertanyaan', 'ASC')->get(self::TBL_DAFTAR)->result();
    }

    public function get_age_distribution($bulan = null, $tahun = null) {
        if ($bulan) {
            $this->db->where('MONTH(tanggal_pengisian)', $bulan);
        }
        if ($tahun) {
            $this->db->where('YEAR(tanggal_pengisian)', $tahun);
        }

        $this->db->select('usia, COUNT(*) AS jumlah');
        $this->db->from(self::TBL_RESPONDEN);
        $this->db->group_by('usia');
        $result = $this->db->get()->result_array();

        $age_order = ['<17', '17-25', '26-35', '36-45', '>45'];
        usort($result, function($a, $b) use ($age_order) {
            return array_search($a['usia'], $age_order) - array_search($b['usia'], $age_order);
        });

        return $result;
    }

    public function get_all_responden($bulan = null, $tahun = null, $search_term = null) {
        if ($bulan) {
            $this->db->where('MONTH(tanggal_pengisian)', $bulan);
        }
        if ($tahun) {
            $this->db->where('YEAR(tanggal_pengisian)', $tahun);
        }
        if ($search_term) {
            $this->db->like('nama_responden', $search_term); // Filter berdasarkan nama
        }

        return $this->db->order_by('tanggal_pengisian', 'DESC')->get(self::TBL_RESPONDEN)->result();
    }

    public function get_responden_by_id($id_responden) {
        return $this->db->get_where(self::TBL_RESPONDEN, ['id_responden' => $id_responden])->row();
    }

   public function get_penilaian_by_responden_id($id_responden, $bulan = null, $tahun = null) 
{
    $this->db->select('dpf.teks_pertanyaan, pf.skala_nilai, pf.harapan, r.nama_responden, r.tanggal_pengisian, r.nama_destinasi');
    $this->db->from(self::TBL_PENILAIAN . ' pf');
    $this->db->join(self::TBL_DAFTAR . ' dpf', 'pf.pertanyaan_id = dpf.id_pertanyaan');
    $this->db->join('responden r', 'pf.id_responden = r.id_responden');

    $this->db->where('pf.id_responden', $id_responden);
    $this->db->where('pf.skala_nilai IS NOT NULL');

    if ($bulan) {
        $this->db->where('MONTH(r.tanggal_penilaian)', $bulan);
    }
    if ($tahun) {
        $this->db->where('YEAR(r.tanggal_penilaian)', $tahun);
    }

    $this->db->order_by('dpf.id_pertanyaan', 'ASC');
    return $this->db->get()->result();
}



    public function get_all_responden_with_details() {
        return $this->get_all_responden();
    }

    public function get_persentase_kepuasan_by_bulan_tahun($bulan = null, $tahun = null)
{
    $this->db->select('SUM(pf.skala_nilai) AS total_nilai, SUM(pf.harapan) AS total_harapan');
    $this->db->from('penilaian_fasilitas pf');
    $this->db->join('responden r', 'pf.id_responden = r.id_responden'); // sesuaikan kolom join

    if ($bulan) {
        $this->db->where('MONTH(r.tanggal_pengisian)', $bulan);
    }
    if ($tahun) {
        $this->db->where('YEAR(r.tanggal_pengisian)', $tahun);
    }

    $result = $this->db->get()->row();

    if ($result && $result->total_harapan > 0) {
        $persentase = ($result->total_nilai / $result->total_harapan) * 100;
        $persentase_str = number_format(floor($persentase * 100) / 100, 2, '.', '');
        return $persentase_str;
    }

    return '0.00';
}


    public function count_responden($bulan = null, $tahun = null) {
        $this->db->from(self::TBL_RESPONDEN . ' r');

        if (!empty($bulan)) {
            $this->db->where('MONTH(r.tanggal_pengisian)', $bulan);
        }
        if (!empty($tahun)) {
            $this->db->where('YEAR(r.tanggal_pengisian)', $tahun);
        }

        return $this->db->count_all_results();
    }

   public function get_all_penilaian_fasilitas($bulan = null, $tahun = null, $search_term = null)
{
    $this->db->select('
        r.id_responden,
        r.nama_responden,
        r.nama_destinasi, 
        r.tanggal_pengisian,
        p.id_pertanyaan,
        p.teks_pertanyaan,
        pf.skala_nilai,
        pf.harapan
    ');
    $this->db->from('responden r');
    $this->db->join('penilaian_fasilitas pf', 'pf.id_responden = r.id_responden', 'left');
    $this->db->join('daftar_pertanyaan_fasilitas p', 'p.id_pertanyaan = pf.pertanyaan_id', 'left');

    // Filter bulan & tahun
    if (!empty($bulan)) {
        $this->db->where('MONTH(r.tanggal_pengisian)', $bulan);
    }
    if (!empty($tahun)) {
        $this->db->where('YEAR(r.tanggal_pengisian)', $tahun);
    }

    // Pencarian nama responden
    if (!empty($search_term)) {
        $this->db->like('r.nama_responden', $search_term);
    }

    $this->db->order_by('r.id_responden', 'ASC');
    $this->db->order_by('p.id_pertanyaan', 'ASC');

    return $this->db->get()->result();
}



    public function get_all_destinasi($bulan = null, $tahun = null, $search_term = null) {
    $this->db->from('destinasi_wisata');

    // Filter pencarian
    if (!empty($search_term)) {
        $this->db->like('nama_destinasi', $search_term);
    }

    // Filter bulan dan tahun (kalau memang ada kolom tanggal di tabel)
    if (!empty($bulan) && $bulan != 'Semua') {
        $this->db->where('MONTH(tanggal)', $bulan);
    }
    if (!empty($tahun) && $tahun != 'Semua') {
        $this->db->where('YEAR(tanggal)', $tahun);
    }
    

    $this->db->order_by('id_destinasi', 'ASC');
    return $this->db->get()->result();
}


    public function get_destinasi_by_id($id) {
        return $this->db->get_where('destinasi_wisata', ['id_destinasi' => $id])->row();
    }

    public function insert_destinasi($nama) {
        return $this->db->insert('destinasi_wisata', ['nama_destinasi' => $nama]);
    }

    public function update_destinasi($id, $nama) {
        return $this->db->where('id_destinasi', $id)->update('destinasi_wisata', ['nama_destinasi' => $nama]);
    }

    public function delete_destinasi($id) {
        return $this->db->where('id_destinasi', $id)->delete('destinasi_wisata');
    }
    
    public function update_pertanyaan_fasilitas($id, $teks) {
        return $this->db->where('id_pertanyaan', $id)->update('daftar_pertanyaan_fasilitas', ['teks_pertanyaan' => $teks]);
    }

    public function insert_pertanyaan_fasilitas($teks) {
        return $this->db->insert('daftar_pertanyaan_fasilitas', ['teks_pertanyaan' => $teks]);
}
}