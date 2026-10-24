<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function auth() {
        if ($this->session->userdata('admin')) {
            redirect('admin/dashboard');
        }

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $admin = $this->db->get_where('admin', ['username' => $username])->row();

            if ($admin) {
                if ($password === $admin->password) {
                    $this->session->set_userdata('admin', $admin->id);
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Password salah!');
                }
            } else {
                $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            }

            redirect('admin/auth');
        }

        $this->load->view('admin/login');
    }

    public function dashboard()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }

        // Ambil data filter dari query string (?bulan=8&tahun=2025)
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        // Kirim ke model untuk mendapatkan data yang terfilter
        $data['total_responden'] = $this->Admin_model->count_responden($bulan, $tahun);
        $data['persentase_kepuasan'] = $this->Admin_model->get_persentase_kepuasan_by_bulan_tahun($bulan, $tahun);
        $data['age_distribution'] = $this->Admin_model->get_age_distribution($bulan, $tahun);
        $data['avg_kepuasan'] = $this->Admin_model->get_rata_rata_persentase_per_pertanyaan($bulan, $tahun);
        $data['all_responden'] = $this->Admin_model->get_all_responden($bulan, $tahun);

        // Kirim juga nilai bulan & tahun ke view untuk form select
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;

        $this->load->view('admin/dashboard', $data);
    }

    public function logout() {
        $this->session->unset_userdata('admin');
        redirect('admin/auth');
    }

    public function detail($id_responden) {
        $this->load->model('Admin_model');
        $responden = $this->Admin_model->get_responden_by_id($id_responden);
        $penilaian_fasilitas = $this->Admin_model->get_penilaian_by_responden_id($id_responden);

        $data = [
            'responden' => $responden,
            'penilaian_fasilitas' => $penilaian_fasilitas,
        ];

        $this->load->view('admin/detail', $data);
    }
    
    public function export_responden() {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $search_term = $this->input->get('search'); // Ambil kata kunci pencarian

        // Kirim search_term ke model
        $responden = $this->Admin_model->get_all_responden($bulan, $tahun, $search_term);

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment;filename=data_responden_" . date('Ymd_His') . ".xls");

        echo "<table border='1'>";
        echo "<tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Domisili</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
            </tr>";
        
        foreach ($responden as $r) {
            echo "<tr>
                    <td>{$r->id_responden}</td>
                    <td>{$r->nama_responden}</td>
                    <td>" . date('d-m-Y', strtotime($r->tanggal_pengisian)) . "</td>
                    <td>{$r->domisili}</td>
                    <td>{$r->jenis_kelamin}</td>
                    <td>{$r->usia}</td>
                </tr>";
        }
        echo "</table>";
    }

    public function export_responden_pdf() {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $data['responden'] = $this->Admin_model->get_all_responden($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->library('pdf');
        $html = $this->load->view('admin/export_pdf', $data, true);
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("data_responden.pdf", array("Attachment"=>false));
    }

     public function responden() {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $search_term = $this->input->get('search'); // Ambil kata kunci pencarian

        $data['judul'] = 'Data Responden';
        // Kirim kata kunci pencarian ke model
        $data['responden'] = $this->Admin_model->get_all_responden($bulan, $tahun, $search_term);
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;
        $data['search_term'] = $search_term; // Teruskan kembali ke view

        $this->load->view('admin/responden', $data);
    }
    public function penilaian_fasilitas()
    {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $search_term = $this->input->get('search');


        $data['judul'] = 'Penilaian Fasilitas';
        $data['penilaian'] = $this->Admin_model->get_all_penilaian_fasilitas($bulan, $tahun, $search_term);
        $data['filter_bulan'] = $bulan;

        $data['filter_tahun'] = $tahun;
        $data['search_term'] = $search_term;


        $this->load->view('admin/penilaian_fasilitas', $data); // gunakan view yang sudah diperbaiki
    }

    public function destinasi() {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $search_term = $this->input->get('search'); // Tambahkan ini
        
        $data['judul'] = 'Daftar Destinasi Wisata';
        $data['destinasi'] = $this->Admin_model->get_all_destinasi($bulan, $tahun, $search_term); // Teruskan search_term ke model
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;
        $data['search_term'] = $search_term; // Teruskan kembali ke view
        
        $this->load->view('admin/destinasi', $data);
    }

    public function tambah_destinasi() {
    // Aturan validasi
    // Tambahkan array pesan kustom pada rules
    $this->form_validation->set_rules(
        'nama_destinasi', 
        'Nama Destinasi', 
        'required|is_unique[destinasi_wisata.nama_destinasi]',
        array(
            'required' => 'Nama destinasi wajib diisi.',
            'is_unique' => 'Nama destinasi "%s" sudah ada, silakan gunakan nama lain.'
        )
    );

    if ($this->form_validation->run() === FALSE) {
        // Jika validasi gagal, form akan ditampilkan kembali beserta pesan error
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        
        $data['judul'] = 'Tambah Destinasi';
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;

        $this->load->view('admin/destinasi_form', $data);
    } else {
        // Jika validasi berhasil
        $this->Admin_model->insert_destinasi($this->input->post('nama_destinasi'));
        $this->session->set_flashdata('success', 'Destinasi berhasil ditambahkan!');
        redirect('admin/destinasi');
    }
}
    public function edit_destinasi($id) {
        if ($this->input->post()) {
            $this->Admin_model->update_destinasi($id, $this->input->post('nama_destinasi'));
            redirect('admin/destinasi');
        }
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        $data['judul'] = 'Edit Destinasi';
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;

        $this->load->view('admin/destinasi_form', $data);
    }

    public function hapus_destinasi($id) {
        $this->Admin_model->delete_destinasi($id);
        redirect('admin/destinasi');
    }

    public function export_penilaian_fasilitas_excel()
{
    if (!$this->session->userdata('admin')) {
        redirect('admin/auth');
    }

    $bulan = $this->input->get('bulan');
    $tahun = $this->input->get('tahun');

    // Ambil data
    $this->db->select('
        responden.id_responden,
        responden.nama_responden,
        responden.nama_destinasi,
        responden.tanggal_pengisian,
        daftar_pertanyaan_fasilitas.teks_pertanyaan,
        penilaian_fasilitas.skala_nilai,
        penilaian_fasilitas.harapan
    ');
    $this->db->from('responden');
    $this->db->join('penilaian_fasilitas', 'penilaian_fasilitas.id_responden = responden.id_responden');
    $this->db->join('daftar_pertanyaan_fasilitas', 'daftar_pertanyaan_fasilitas.id_pertanyaan = penilaian_fasilitas.pertanyaan_id');

    if (!empty($bulan)) {
        $this->db->where('MONTH(responden.tanggal_pengisian)', $bulan);
    }
    if (!empty($tahun)) {
        $this->db->where('YEAR(responden.tanggal_pengisian)', $tahun);
    }

    $result = $this->db->get()->result();

    // Kelompokkan per responden
    $data_penilaian = [];
    foreach ($result as $row) {
        $id = $row->id_responden;
        if (!isset($data_penilaian[$id])) {
            $data_penilaian[$id] = [
                'nama' => $row->nama_responden,
                'destinasi' => $row->nama_destinasi,
                'tanggal' => $row->tanggal_pengisian,
                'penilaian' => [],
            ];
        }
        $data_penilaian[$id]['penilaian'][] = [
            'pertanyaan' => $row->teks_pertanyaan,
            'skala_nilai' => $row->skala_nilai,
            'harapan' => $row->harapan,
            'persentase' => ($row->harapan > 0) ? round(($row->skala_nilai / $row->harapan) * 100, 2) . '%' : '0%'
        ];
    }

    // Header Excel
    $filename = 'penilaian_fasilitas_' . date('Ymd_His') . '.xls';
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Tulis tabel HTML sebagai Excel
    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "<tr style='font-weight:bold; text-align:center;'>
            <td>No</td>
            <td>Nama Responden</td>
            <td>Nama Destinasi</td>
            <td>Tanggal</td>
            <td>Pertanyaan</td>
            <td>Skor Kenyataan</td>
            <td>Skor Harapan</td>
            <td>Persentase (%)</td>
          </tr>";

    $no = 1;
    foreach ($data_penilaian as $responden) {
        $rowspan = count($responden['penilaian']);
        $firstRow = true;

        foreach ($responden['penilaian'] as $penilaian) {
            echo "<tr>";
            if ($firstRow) {
                echo "<td rowspan='{$rowspan}'>{$no}</td>";
                echo "<td rowspan='{$rowspan}'>{$responden['nama']}</td>";
                echo "<td rowspan='{$rowspan}'>{$responden['destinasi']}</td>";
                echo "<td rowspan='{$rowspan}'>" . date('d-m-Y', strtotime($responden['tanggal'])) . "</td>";
                $firstRow = false;
            }
            echo "<td>{$penilaian['pertanyaan']}</td>";
            echo "<td>{$penilaian['skala_nilai']}</td>";
            echo "<td>{$penilaian['harapan']}</td>";
            echo "<td>{$penilaian['persentase']}</td>";
            echo "</tr>";
        }
        $no++;
    }
    echo "</table>";
}

    public function export_penilaian_fasilitas_pdf()
{
    if (!$this->session->userdata('admin')) {
        redirect('admin/auth');
    }

    $bulan = $this->input->get('bulan');
    $tahun = $this->input->get('tahun');

    $this->db->select('
        responden.id_responden,
        responden.nama_responden,
        responden.nama_destinasi, 
        responden.tanggal_pengisian,
        daftar_pertanyaan_fasilitas.teks_pertanyaan,
        penilaian_fasilitas.skala_nilai,
        penilaian_fasilitas.harapan
    ');
    $this->db->from('responden');
    $this->db->join('penilaian_fasilitas', 'penilaian_fasilitas.id_responden = responden.id_responden');
    $this->db->join('daftar_pertanyaan_fasilitas', 'daftar_pertanyaan_fasilitas.id_pertanyaan = penilaian_fasilitas.pertanyaan_id');

    if (!empty($bulan)) {
        $this->db->where('MONTH(responden.tanggal_pengisian)', $bulan);
    }
    if (!empty($tahun)) {
        $this->db->where('YEAR(responden.tanggal_pengisian)', $tahun);
    }

    $result = $this->db->get()->result();

    // Kelompokkan berdasarkan responden
    $data_penilaian = [];
    foreach ($result as $row) {
        $id = $row->id_responden;
        if (!isset($data_penilaian[$id])) {
            $data_penilaian[$id] = [
                'nama' => $row->nama_responden,
                'destinasi' => $row->nama_destinasi, // ✅ simpan destinasi
                'tanggal' => $row->tanggal_pengisian,
                'penilaian' => [],
            ];
        }

        $data_penilaian[$id]['penilaian'][] = [
            'pertanyaan' => $row->teks_pertanyaan,
            'skala_nilai' => $row->skala_nilai,
            'harapan' => $row->harapan,
        ];
    }

    // Kirim ke view untuk PDF
    $data = [
        'data_penilaian' => $data_penilaian,
        'bulan' => $bulan,
        'tahun' => $tahun,
    ];
    $this->load->view('admin/export_penilaian_fasilitas_pdf', $data);
}

    public function pertanyaan_fasilitas() {
        if (!$this->session->userdata('admin')) {
            redirect('admin/auth');
        }
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $search_term = $this->input->get('search');
        $data['judul'] = 'Daftar Pertanyaan Fasilitas';
        $data['pertanyaan'] = $this->Admin_model->get_all_daftar_pertanyaan($search_term);
        $data['search_term'] = $search_term;
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun']=$tahun;
        $this->load->view('admin/pertanyaan_fasilitas', $data);
    }

    public function tambah_pertanyaan_fasilitas() {
        if ($this->input->post()) {
            $this->Admin_model->insert_pertanyaan_fasilitas($this->input->post('teks_pertanyaan'));
            redirect('admin/pertanyaan_fasilitas');
        }
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['judul'] = 'Tambah Pertanyaan Fasilitas';
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun']=$tahun;
        $this->load->view('admin/form_tambah_pertanyaan_fasilitas', $data);
    }

    public function simpan_pertanyaan_fasilitas() {
        $teks = $this->input->post('teks_pertanyaan');
        $this->db->insert('daftar_pertanyaan_fasilitas', ['teks_pertanyaan' => $teks]);
        redirect('admin/pertanyaan_fasilitas');
    }

    public function edit_pertanyaan_fasilitas($id) {
        if ($this->input->post()) {
            $this->Admin_model->update_pertanyaan_fasilitas($id, $this->input->post('teks_pertanyaan'));
            redirect('admin/pertanyaan_fasilitas');
        }
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['pertanyaan'] = $this->db->get_where('daftar_pertanyaan_fasilitas', ['id_pertanyaan' => $id])->row();
        $data['judul'] = 'Edit Pertanyaan Fasilitas';
        $data['filter_bulan'] = $bulan;
        $data['filter_tahun']=$tahun;
        $this->load->view('admin/form_edit_pertanyaan_fasilitas', $data);
    }

    public function update_pertanyaan_fasilitas($id) {
        $teks = $this->input->post('teks_pertanyaan');
        $this->db->where('id_pertanyaan', $id)->update('daftar_pertanyaan_fasilitas', ['teks_pertanyaan' => $teks]);
        redirect('admin/pertanyaan_fasilitas');
    }

    public function hapus_pertanyaan_fasilitas($id) {
    // Hapus dulu data penilaian yang terkait
    $this->db->where('pertanyaan_id', $id);
    $this->db->delete('penilaian_fasilitas');

    // Hapus pertanyaannya
    $this->db->where('id_pertanyaan', $id);
    $this->db->delete('daftar_pertanyaan_fasilitas');

    redirect('admin/pertanyaan_fasilitas');
}

public function import_csv()
{
    if (!$this->session->userdata('admin')) {
        redirect('admin/auth');
    }

    $this->load->view('admin/import_csv');
}

public function proses_import_csv()
{
    $data = $this->session->userdata('preview_import');
    if (!$data) redirect('admin/import_csv');

    $this->db->trans_start();

    $last_nama = null;
    $id_responden = null;

    foreach ($data as $row) {
        if ($row['status'] == 'ERROR' || !$row['responden']) continue;

        // Jika ganti responden (berdasarkan nama dan destinasi)
        if ($last_nama !== $row['responden']['nama_responden']) {
            
            // Cek apakah responden sudah ada di DB untuk menghindari duplikasi
            $this->db->where('nama_responden', $row['responden']['nama_responden']);
            $this->db->where('nama_destinasi', $row['responden']['nama_destinasi']);
            $cek = $this->db->get('responden')->row();

            if ($cek) {
                $id_responden = $cek->id_responden;
            } else {
                $this->db->insert('responden', [
                    'nama_responden' => $row['responden']['nama_responden'],
                    'jenis_kelamin'  => $row['responden']['jenis_kelamin'],
                    'usia'           => $row['responden']['usia'],
                    'domisili'       => $row['responden']['domisili'],
                    'nama_destinasi' => $row['responden']['nama_destinasi'],
                    'tanggal_pengisian' => date('Y-m-d H:i:s')
                ]);
                $id_responden = $this->db->insert_id();
            }
            $last_nama = $row['responden']['nama_responden'];
        }

        // Insert penilaian_fasilitas
        $this->db->insert('penilaian_fasilitas', [
            'id_responden'  => $id_responden,
            'pertanyaan_id' => $row['id_pertanyaan'],
            'skala_nilai'   => $row['skala_nilai'],
            'harapan'       => $row['harapan'],
        ]);
    }

    $this->db->trans_complete();
    $this->session->unset_userdata('preview_import');

    $this->session->set_flashdata('success', 'Data berhasil diimport!');
    redirect('admin/responden');
}

public function preview_import_csv()
{
    if (!isset($_FILES['file_csv']) || $_FILES['file_csv']['error'] == UPLOAD_ERR_NO_FILE) {
        $this->session->set_flashdata('error', 'Silakan pilih file terlebih dahulu.');
        redirect('admin/import_csv');
    }

    $file = $_FILES['file_csv']['tmp_name'];
    $handle = fopen($file, "r");

    // Deteksi Delimiter otomatis (apakah pake , atau ;)
    $firstLine = fgets($handle);
    $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
    rewind($handle);

    $preview = [];
    $current_responden = null;
    $row_count = 0;

    while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
        if ($row_count == 0) { $row_count++; continue; } // Lewati header

        // Ambil data berdasarkan urutan kolom di gambar Excel Anda:
        // 0:nama, 1:jk, 2:usia, 3:domisili, 4:destinasi, 5:id_pertanyaan, 6:skala, 7:harapan

        // Jika kolom nama (indeks 0) tidak kosong, update data responden saat ini
        if (!empty($data[0])) {
            $current_responden = [
                'nama_responden' => $data[0],
                'jenis_kelamin'  => $data[1] ?? '',
                'usia'           => $data[2] ?? '',
                'domisili'       => $data[3] ?? '',
                'nama_destinasi' => $data[4] ?? '',
            ];
        }

        // Validasi minimal: ID Pertanyaan, Skala, dan Harapan harus ada
        $status = 'OK';
        if (!isset($data[5]) || $data[5] === '' || !isset($data[6]) || !isset($data[7])) {
            $status = 'ERROR';
        }

        $preview[] = [
            'responden'     => $current_responden,
            'id_pertanyaan' => $data[5] ?? null,
            'skala_nilai'   => $data[6] ?? 0,
            'harapan'       => $data[7] ?? 0,
            'status'        => $status
        ];

        $row_count++;
    }

    fclose($handle);

    // Kirim hasil ke session dan view
    $this->session->set_userdata('preview_import', $preview);
    $this->load->view('admin/preview_import_csv', ['preview' => $preview]);
}
public function download_template_csv()
{
    if (!$this->session->userdata('admin')) {
        redirect('admin/auth');
    }

    // Ambil hanya ID Pertanyaan
    $pertanyaan = $this->db
        ->select('id_pertanyaan')
        ->from('daftar_pertanyaan_fasilitas')
        ->order_by('id_pertanyaan', 'ASC')
        ->get()
        ->result();

    // Header HTTP untuk download CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="template_import_kuesioner.csv"');

    $output = fopen('php://output', 'w');

    // Tambahkan BOM (Byte Order Mark) agar Excel mendeteksi format dengan benar
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

    // Header kolom CSV (tanpa kolom pertanyaan)
    $header = [
        'nama_responden',
        'jenis_kelamin',
        'usia (<17 | 17-25 | 26-35 | 36-45 | >45)',
        'domisili',
        'nama_destinasi',
        'id_pertanyaan',
        'skala_nilai',
        'harapan'
    ];
    
    // Gunakan semicolon (;) agar otomatis rapi di Excel Indonesia
    fputcsv($output, $header, ";");

    // Isi template berdasarkan ID pertanyaan dari DB
    foreach ($pertanyaan as $p) {
        fputcsv($output, [
            '', // nama_responden
            '', // jenis_kelamin
            '', // usia
            '', // domisili
            '', // nama_destinasi
            $p->id_pertanyaan, // HANYA ID
            '', // skala_nilai
            ''  // harapan
        ], ";");
    }

    fclose($output);
    exit;
}


}