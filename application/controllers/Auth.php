<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        // Menampilkan form login
        $this->load->view('login'); // views/login.php
    }

  public function login() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $admin = $this->Admin_model->getByUsername($username);

    if ($admin) {
        if (password_verify($password, $admin->password)) {
            echo "Login berhasil!";
            print_r($admin); die;
        } else {
            echo "Password salah"; die;
        }
    } else {
        echo "User tidak ditemukan"; die;
    }
}


    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/auth');
    }
}