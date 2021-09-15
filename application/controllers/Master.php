<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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
    MASTER PELANGGAN
    ==================================================================================
    */
    public function pelanggan()
    {
        $data['pelanggan'] = $this->Master_model->get_pelanggan();
        $data['title'] = 'Rosokku | Master Pelanggan';
        $this->load->view('template/header', $data);
        $this->load->view('master/pelanggan');
        $this->load->view('template/footer');
    }

    public function add_pelanggan()
    {
        if (!empty($_POST)) {
            $data = [
                'nama_pelanggan'     => $_POST['nama'],
                'alamat_pelanggan'   => $_POST['alamat'],
                'phone_pelanggan'    => $_POST['phone'],
                'rekening_pelanggan' => $_POST['rekening'],
                'bank_pelanggan'     => $_POST['bank'],
                'email_pelanggan'    => $_POST['email']
            ];
            if ($_POST['password'] != '') {
                $data['password_pelanggan']  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            // Check email
            $cekEmail = $this->db->get_where('pelanggan', ['email_pelanggan' => $data['email_pelanggan']]);
            if ($cekEmail->num_rows() > 0) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed !</strong> Email sudah digunakan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            } else {
                $this->Master_model->add_pelanggan($data);
            }
            redirect('master/pelanggan');
        } else {
            $data['title'] = 'Rosokku | Add Pelanggan';
            $data['action'] = base_url('master/add_pelanggan');
            $data['submitLabel'] = 'Tambahkan';
            $data['pageLabel'] = 'Tambah Pelanggan';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_pelanggan');
            $this->load->view('template/footer');
        }
    }

    public function edit_pelanggan($id = NULL)
    {
        if (!empty($_POST) & $id == NULL) {
            $data = [
                'nama_pelanggan'      => $_POST['nama'],
                'phone_pelanggan'     => $_POST['phone'],
                'rekening_pelanggan'  => $_POST['rekening'],
                'bank_pelanggan'      => $_POST['bank'],
            ];
            if ($_POST['email'] != '') {
                $data['email_pelanggan']  = $_POST['email'];
            }
            if ($_POST['password'] != '') {
                $data['password_pelanggan']  = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            // Check email
            $dataEmail = $this->db->get_where('pelanggan', ['id_pelanggan' => $_POST['id_pelanggan']])->row_array()['email_pelanggan'];
            if ($dataEmail != $_POST['email']) {
                $cekEmail = $this->db->get_where('pelanggan', ['email_pelanggan' => $data['email_pelanggan']]);
                if ($cekEmail->num_rows() > 0) {
                    $this->session->set_flashdata('status', '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed !</strong> Email sudah digunakan
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ');
                    redirect('master/edit_pelanggan/' . $_POST['id_pelanggan']);
                } else {
                    $this->Master_model->edit_pelanggan($data, $_POST['id_pelanggan']);
                    redirect('master/pelanggan');
                }
            } else {
                $this->Master_model->edit_pelanggan($data, $_POST['id_pelanggan']);
                redirect('master/pelanggan');
            }
        } else {
            $data['title'] = 'Rosokku | Edit Pelanggan';
            $data['pelanggan'] = $this->Master_model->get_pelanggan($id);
            $data['action'] = base_url('master/edit_pelanggan');
            $data['submitLabel'] = 'Simpan perubahan';
            $data['pageLabel'] = 'Edit Pelanggan';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_pelanggan');
            $this->load->view('template/footer');
        }
    }

    public function delete_pelanggan($id = NULL)
    {
        if ($id != NULL) {
            $this->Master_model->delete_pelanggan($id);
            redirect('master/pelanggan');
        }
    }

    public function view_pelanggan($id)
    {
        $data['title'] = 'Rosokku | View Pelanggan';
        $data['pelanggan'] = $this->Master_model->get_pelanggan($id);
        $data['alamatUtama'] = $this->db->get_where('alamat', ['id_alamat' => $data['pelanggan']['alamat_utama']])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('master/view_pelanggan');
        $this->load->view('template/footer');
    }


    /* 
    ==================================================================================
    MASTER KATEGORI
    ==================================================================================
    */
    public function kategori()
    {
        $data['kategori'] = $this->Master_model->get_kategori();
        $data['title'] = 'Rosokku | Master Kategori';
        $this->load->view('template/header', $data);
        $this->load->view('master/kategori');
        $this->load->view('template/footer');
    }

    public function add_kategori()
    {
        if (!empty($_POST)) {
            $data = [
                'nama'      => $_POST['nama'],
                'harga'     => str_replace(',', '', $_POST['harga']),
            ];
            $this->Master_model->add_kategori($data);
            redirect('master/kategori');
        } else {
            $data['title'] = 'Rosokku | Add Kategori';
            $data['action'] = base_url('master/add_kategori');
            $data['submitLabel'] = 'Tambahkan';
            $data['pageLabel'] = 'Tambah Kategori';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_kategori');
            $this->load->view('template/footer');
        }
    }

    public function edit_kategori($id = NULL)
    {
        if (!empty($_POST) & $id == NULL) {
            $data = [
                'nama'      => $_POST['nama'],
                'harga'     => str_replace(',', '', $_POST['harga']),
            ];
            $this->Master_model->edit_kategori($data, $_POST['id_kategori']);
            redirect('master/kategori');
        } else {
            $data['title'] = 'Rosokku | Edit Kategori';
            $data['kategori'] = $this->Master_model->get_kategori($id);
            $data['action'] = base_url('master/edit_kategori');
            $data['submitLabel'] = 'Simpan perubahan';
            $data['pageLabel'] = 'Edit Kategori';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_kategori');
            $this->load->view('template/footer');
        }
    }

    public function delete_kategori($id = NULL)
    {
        if ($id != NULL) {
            $this->Master_model->delete_kategori($id);
            redirect('master/kategori');
        }
    }

    public function view_kategori($id)
    {
        $data['title'] = 'Rosokku | View Kategori';
        $data['kategori'] = $this->Master_model->get_kategori($id);
        $this->load->view('template/header', $data);
        $this->load->view('master/view_kategori');
        $this->load->view('template/footer');
    }


    /* 
    ==================================================================================
    MASTER KURIR
    ==================================================================================
    */
    public function kurir()
    {
        $data['kurir'] = $this->Master_model->get_kurir();
        $data['title'] = 'Rosokku | Master Kurir';
        $this->load->view('template/header', $data);
        $this->load->view('master/kurir');
        $this->load->view('template/footer');
    }

    public function add_kurir()
    {
        if (!empty($_POST)) {
            $data = [
                'nama_kurir'      => $_POST['nama_kurir'],
                'alamat_kurir'    => $_POST['alamat_kurir'],
                'phone_kurir'     => $_POST['phone_kurir'],
                'email_kurir'     => $_POST['email_kurir'],
                'password_kurir'  => password_hash($_POST['password_kurir'], PASSWORD_DEFAULT),
                'status_kurir'    => 'nonaktif'
            ];
            $this->Master_model->add_kurir($data);
            redirect('master/kurir');
        } else {
            $data['title'] = 'Rosokku | Add Kurir';
            $data['action'] = base_url('master/add_kurir');
            $data['submitLabel'] = 'Tambahkan';
            $data['pageLabel'] = 'Tambah Kurir';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_kurir');
            $this->load->view('template/footer');
        }
    }

    public function edit_kurir($id = NULL)
    {
        if (!empty($_POST) & $id == NULL) {
            $data = [
                'nama_kurir'      => $_POST['nama_kurir'],
                'alamat_kurir'    => $_POST['alamat_kurir'],
                'phone_kurir'     => $_POST['phone_kurir'],
                'email_kurir'     => $_POST['email_kurir']
            ];
            if ($_POST['password_kurir'] != '') {
                $data['password_kurir']  = password_hash($_POST['password_kurir'], PASSWORD_DEFAULT);
            }
            $this->Master_model->edit_kurir($data, $_POST['id_kurir']);
            redirect('master/kurir');
        } else {
            $data['title'] = 'Rosokku | Edit kurir';
            $data['kurir'] = $this->Master_model->get_kurir($id);
            $data['action'] = base_url('master/edit_kurir');
            $data['submitLabel'] = 'Simpan perubahan';
            $data['pageLabel'] = 'Edit Kurir';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_kurir');
            $this->load->view('template/footer');
        }
    }

    public function delete_kurir($id = NULL)
    {
        if ($id != NULL) {
            $this->Master_model->delete_kurir($id);
            redirect('master/kurir');
        }
    }

    public function view_kurir($id)
    {
        $data['title'] = 'Rosokku | View kurir';
        $data['kurir'] = $this->Master_model->get_kurir($id);
        $this->load->view('template/header', $data);
        $this->load->view('master/view_kurir');
        $this->load->view('template/footer');
    }


    /* 
    ==================================================================================
    MASTER JADWAL
    ==================================================================================
    */
    public function jadwal()
    {
        $data['jadwal'] = $this->Master_model->get_jadwal();
        $data['title'] = 'Rosokku | Master Jadwal';
        $this->load->view('template/header', $data);
        $this->load->view('master/jadwal');
        $this->load->view('template/footer');
    }

    public function add_jadwal()
    {
        if (!empty($_POST)) {
            $data = [
                'hari'          => $_POST['hari'],
                'start'         => $_POST['start'],
                'end'           => $_POST['end'],
                'start_date'    => $_POST['start_date'],
                'end_date'      => $_POST['end_date']
            ];
            $this->Master_model->add_jadwal($data);
            redirect('master/jadwal');
        } else {
            $data['title'] = 'Rosokku | Add jadwal';
            $data['action'] = base_url('master/add_jadwal');
            $data['submitLabel'] = 'Tambahkan';
            $data['pageLabel'] = 'Tambah Jadwal';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_jadwal');
            $this->load->view('template/footer');
        }
    }

    public function edit_jadwal($id = NULL)
    {
        if (!empty($_POST) & $id == NULL) {
            $data = [
                'hari'          => $_POST['hari'],
                'start'         => $_POST['start'],
                'end'           => $_POST['end'],
                'start_date'    => $_POST['start_date'],
                'end_date'      => $_POST['end_date']
            ];
            $this->Master_model->edit_jadwal($data, $_POST['id_jadwal']);
            redirect('master/jadwal');
        } else {
            $data['title'] = 'Rosokku | Edit jadwal';
            $data['jadwal'] =  $this->Master_model->get_jadwal($id);
            $data['action'] = base_url('master/edit_jadwal');
            $data['submitLabel'] = 'Simpan perubahan';
            $data['pageLabel'] = 'Edit Jadwal';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_jadwal');
            $this->load->view('template/footer');
        }
    }

    public function view_jadwal($id)
    {
        $data['title'] = 'Rosokku | View jadwal';
        $data['jadwal'] = $this->Master_model->get_jadwal($id);
        $this->load->view('template/header', $data);
        $this->load->view('master/view_jadwal');
        $this->load->view('template/footer');
    }


    /* 
    ==================================================================================
    MASTER START POINT
    ==================================================================================
    */
    public function start_point()
    {
        $data['starts'] = $this->Master_model->get_start_point();
        $data['title'] = 'Rosokku | Master Jadwal';
        $this->load->view('template/header', $data);
        $this->load->view('master/start_point');
        $this->load->view('template/footer');
    }

    public function add_start_point()
    {
        if (!empty($_POST)) {
            $data = [
                'nama_start'            => $_POST['nama_start'],
                'keterangan_start'      => $_POST['keterangan_start'],
                'longitude_start'       => $_POST['longitude_start'],
                'latitude_start'        => $_POST['latitude_start'],
            ];
            $this->Master_model->add_start_point($data);
            redirect('master/start_point');
        } else {
            $data['title'] = 'Rosokku | Add Start Point';
            $data['action'] = base_url('master/add_start_point');
            $data['pageLabel'] = 'Tambah Start Point';
            $data['submitLabel'] = 'Tambahkan';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_start_point');
            $this->load->view('template/footer');
        }
    }

    public function edit_start_point($id = NULL)
    {
        if (!empty($_POST) & $id == NULL) {
            $data = [
                'id_start'              => $_POST['id_start'],
                'nama_start'            => $_POST['nama_start'],
                'keterangan_start'      => $_POST['keterangan_start'],
                'longitude_start'       => $_POST['longitude_start'],
                'latitude_start'        => $_POST['latitude_start'],
            ];
            $this->Master_model->edit_start_point($data);
            redirect('master/start_point');
        } else {
            $data['title'] = 'Rosokku | Edit start point';
            $data['start'] =  $this->Master_model->get_start_point($id);
            $data['action'] = base_url('master/edit_start_point');
            $data['pageLabel'] = 'Edit Start Point';
            $data['submitLabel'] = 'Simpan perubahan';
            $this->load->view('template/header', $data);
            $this->load->view('master/form_start_point');
            $this->load->view('template/footer');
        }
    }

    public function delete_start_point($id = NULL)
    {
        if ($id != NULL) {
            $this->Master_model->delete_start_point($id);
            redirect('master/start_point');
        }
    }
}

/* End of file Master.php */
