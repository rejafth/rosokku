<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!isset($_SESSION['login']) & !isset($_SESSION['user']) & !isset($_SESSION['role'])) {
            redirect('login');
            die;
        }

        // Check logged in user role is admin or not
        if ($_SESSION['role'] != 'Admin') {
            echo $this->load->view('denied', true, true);
            die;
        }

        // Set userdata
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();
        define('USER', $user);
    }


    /* 
    ==================================================================================
    KEUANGAN
    ==================================================================================
    */
    public function index()
    {
        $data['kategori'] = $this->Master_model->get_kategori();
        $data['sum_pemasukan'] = $this->Keuangan_model->get_summary('in');
        $data['sum_pengeluaran'] = $this->Keuangan_model->get_summary('out');
        $data['pemasukan'] = $this->Keuangan_model->get_keuangan(NULL, 'in');
        $data['pengeluaran'] = $this->Keuangan_model->get_keuangan(NULL, 'out');
        $data['title'] = 'Rosokku | Keuangan';
        $this->load->view('template/header', $data);
        $this->load->view('keuangan/index');
        $this->load->view('template/footer');
    }

    public function add_keuangan()
    {
        if (!empty($_POST)) {
            $data = [
                'tipe'          => $_POST['tipe'],
                'kategori'      => $_POST['kategori'],
                'keterangan'    => $_POST['keterangan'],
                'nominal'       => str_replace(',', '', $_POST['nominal']),
                'tanggal'       => $_POST['tanggal']
            ];
            $this->Keuangan_model->add_keuangan($data);
            redirect('keuangan');
        }
    }

    public function edit_keuangan()
    {
        if (!empty($_POST)) {
            $data = [
                'tipe'          => $_POST['tipe'],
                'keterangan'    => $_POST['keterangan'],
                'nominal'       => str_replace(',', '', $_POST['nominal']),
                'tanggal'       => $_POST['tanggal']
            ];
            $this->Keuangan_model->edit_keuangan($data, $_POST['id_keuangan']);
            redirect('keuangan');
        }
    }

    public function delete_keuangan($id)
    {
        $this->Keuangan_model->delete_keuangan($id);
        redirect('keuangan');
    }

    public function get_keuangan($id)
    {
        $keuangan = $this->Keuangan_model->get_keuangan($id);
        header('Content-Type: application/json');
        echo json_encode($keuangan);
    }


    /* 
    ==================================================================================
    PENCAIRAN
    ==================================================================================
    */
    public function pencairan()
    {
        $data['request'] = $this->Keuangan_model->get_requestSaldo();
        $data['title'] = 'Rosokku | Pencairan';
        $this->load->view('template/header', $data);
        $this->load->view('keuangan/pencairan');
        $this->load->view('template/footer');
    }

    public function pencairan_saldo($id = NULL)
    {
        if ($id != NULL) {
            $request = $this->Keuangan_model->get_requestSaldo($id);
            $keuangan = [
                'tanggal'       => date('Y-m-d'),
                'keterangan'    => 'Pencairan saldo ' . $request['nama_pelanggan'] . ' | (' . $request['bank_pelanggan'] . ') ' . $request['rekening_pelanggan'],
                'nominal'       => $request['saldo'],
                'tipe'          => 'out',
                'kategori'      => 'request_saldo'
            ];
            $this->Keuangan_model->pencairan_saldo($keuangan, $id);
            redirect('keuangan/pencairan');
        }
    }
}

/* End of file Keuangan.php */
