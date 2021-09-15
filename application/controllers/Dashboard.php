<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        // Parent construct
        parent::__construct();

        // Cek is user already logged in
        if (!isset($_SESSION['login']) & !isset($_SESSION['user']) & !isset($_SESSION['role'])) {
            redirect('login');
            die;
        }

        // Set userdata
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();
        define('USER', $user);
    }


    public function index()
    {
        // Set view data
        $data['keuangan'] = $this->Report_model->grafik_keuangan();
        $data['stock'] = $this->Report_model->grafik_stock();
        $data['kurir'] = $this->Report_model->peringkat_kurir();
        $data['title'] = 'Rosokku | Dashboard';

        // Create View
        $this->load->view('template/header', $data);
        $this->load->view('dashboard/index');
        $this->load->view('template/footer');
    }
}

/* End of file Dashboard.php */
