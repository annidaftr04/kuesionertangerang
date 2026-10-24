<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session']);
        $this->load->model('Kuesioner_model');
    }

    public function index() 
    {
        $data['pertanyaan'] = $this->Kuesioner_model->get_all_pertanyaan();
        $data['destinasi_list'] = $this->Kuesioner_model->get_all_destinasi();
        $this->load->view('kuesioner_form', $data);
    }


    public function get_destinasi_wisata() {
        if ($this->input->is_ajax_request()) {
            $search = $this->input->get('term');
            $result = $this->Kuesioner_model->search_destinasi($search);
            echo json_encode($result);
        } else {
            show_404();
        }
    }

    public function submit() 
    {
        // Validasi input responden
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('usia', 'Usia', 'required');
        $this->form_validation->set_rules('domisili', 'Domisili', 'required');
        $this->form_validation->set_rules('nama_destinasi', 'Nama Destinasi', 'required');

        // Ambil semua pertanyaan dari DB
        $pertanyaan = $this->Kuesioner_model->get_all_pertanyaan();

        // Validasi setiap pertanyaan dinamis
        foreach ($pertanyaan as $p) {
            $this->form_validation->set_rules("harapan[{$p['id_pertanyaan']}]", "Harapan", 'required');
            $this->form_validation->set_rules("kenyataan[{$p['id_pertanyaan']}]", "Kenyataan", 'required');
        }

        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['pertanyaan'] = $pertanyaan;
            $this->load->view('kuesioner_form', $data);
            return;
        }

        // Simpan data responden
        $responden = [
            'nama_responden' => $this->input->post('nama'),
            'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            'usia'           => $this->input->post('usia'),
            'domisili'       => $this->input->post('domisili'),
            'nama_destinasi' => $this->input->post('nama_destinasi'),
        ];

        // Simpan penilaian dari POST array
        $input_harapan = $this->input->post('harapan');
        $input_kenyataan = $this->input->post('kenyataan');

        $penilaian = [];
        foreach ($pertanyaan as $p) {
            $id = $p['id_pertanyaan'];
            $penilaian[] = [
                'pertanyaan_id' => $id,
                'harapan' => (int) $input_harapan[$id],
                'skala_nilai' => (int) $input_kenyataan[$id]
            ];
        }

        // Simpan ke database
        $success = $this->Kuesioner_model->save_kuesioner_data($responden, $penilaian);

        if ($success) {
            $this->session->set_flashdata('success_msg', 'Terima kasih, kuesioner Anda telah berhasil disimpan!');
            redirect('kuesioner/terimakasih');
        } else {
            $this->session->set_flashdata('error_msg', 'Terjadi kesalahan saat menyimpan, silakan coba lagi.');
            redirect('kuesioner');
        }
    }


    public function terimakasih() {
        $this->load->view('kuesioner_terimakasih');
    }
}
