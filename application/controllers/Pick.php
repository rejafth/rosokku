<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pick extends CI_Controller
{

    /* CONSTRUCT */
    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!isset($_SESSION['login']) & !isset($_SESSION['user']) & !isset($_SESSION['role'])) {
            redirect('login');
            die;
        }

        // Set userdata
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();
        define('USER', $user);
    }

    /* INDEX */
    public function index()
    {
        // Get data antrian request penjemputan pelanggan
        $data['antrian'] = $this->Transaksi_model->get_antrian_transaksi();
        // Create view
        $data['title'] = 'Rosokku | Pengambilan Barang';
        $this->load->view('template/header', $data);
        $this->load->view('pick/index');
        $this->load->view('template/footer');
    }

    /* PROSES ANTRIAN */
    public function proses_antrian($id)
    {
        if ($id != NULL) {
            $this->Transaksi_model->proses_antrian($id);
            redirect('pick');
        }
    }
}

/* End of file Pick.php */
