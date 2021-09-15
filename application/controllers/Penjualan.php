<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    /* 
    ==================================================================================
    CONSTRUCT
    ==================================================================================
    */
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


    /* 
    ==================================================================================
    PENJUALAN
    ==================================================================================
    */
    public function index()
    {
        // Get data kategori
        $data['kategori'] = $this->Master_model->get_kategori();
        // Get message proses penjualan
        $data['penjualan'] = $this->session->flashdata('data');
        // Set submit button label
        $data['submitLabel'] = 'Tambah Penjualan';
        // Set form action url
        $data['action'] = base_url('penjualan/add');
        // Set header page label
        $data['pageLabel'] = 'Tambah Penjualan';
        // Create view
        $data['title'] = 'Rosokku | Tambah Penjualan';
        $this->load->view('template/header', $data);
        $this->load->view('penjualan/penjualan');
        $this->load->view('template/footer');
    }

    public function add()
    {
        if (!empty($_POST)) {
            // Add pejualan
            $status_add = $this->Penjualan_model->add_penjualan($_POST);
            // Cek status
            if ($status_add) {
                redirect('keuangan');
            } else {
                redirect('penjualan');
            }
        } else {
            redirect('penjualan');
        }
    }

    public function get_kategori($id_kategori)
    {
        $kategori = $this->Master_model->get_kategori($id_kategori);
        header('Content-Type: application/json');
        echo json_encode($kategori);
    }
}

/* End of file Penjualan.php */
