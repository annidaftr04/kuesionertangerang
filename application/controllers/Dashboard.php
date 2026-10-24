<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('admin_id')) {
            redirect('admin/auth');
        }
    }

    public function index() {
        $this->load->view('admin/dashboard');
    }
}