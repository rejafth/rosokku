<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Cek login
        if (!isset($_SESSION['login']) & !isset($_SESSION['user']) & !isset($_SESSION['role'])) {
            redirect('login');
            die;
        }

        // Define userdata
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();
        define('USER', $user);
    }

    public function index()
    {
        // Get logged user data
        $data['user'] = $this->User_model->get_user($_SESSION['user']);
        // Create view
        $data['title'] = 'Rosokku | Settings';
        $this->load->view('template/header', $data);
        $this->load->view('settings/index');
        $this->load->view('template/footer');
    }

    public function edit_profile()
    {
        if (!empty($_POST)) {
            $data = [
                'id_user'       => $_POST['id_user'],
                'nama'          => $_POST['nama'],
                'email'         => $_POST['email'],
                'phone'         => $_POST['phone'],
                'username'      => $_POST['username']
            ];

            // Get data user
            $user = $this->User_model->get_user($data['id_user']);

            // Cek Email
            $email = $user['email'];
            if ($data['email'] != $email) {
                $cekEmail = $this->db->get_where('user', ['email' => $data['email']]);
                if ($cekEmail->num_rows() == 0) {
                    $statusEmail = true;
                } else {
                    $statusEmail = false;
                }
            } else {
                $statusEmail = true;
            }

            // Check username
            $username = $user['username'];
            if ($data['username'] != $username) {
                $cekUsername = $this->db->get_where('user', ['username' => $data['username']]);
                if ($cekUsername->num_rows() == 0) {
                    $statusUsername = true;
                } else {
                    $statusUsername = false;
                }
            } else {
                $statusUsername = true;
            }

            // Proses edit
            if ($statusEmail == true & $statusUsername == true) {
                // Query edit
                $this->User_model->edit_user($data, $data['id_user']);
            }
            // Validasi error
            else if ($statusEmail == false & $statusUsername == true) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Email sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
            // Validasi error
            else if ($statusEmail == true & $statusUsername == false) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Username sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
            // Validasi error
            else if ($statusEmail == false & $statusUsername == false) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Username dan Email sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
            // Redirect
            redirect('settings');
        }
    }

    public function edit_password($id)
    {
        // Get data user
        $user = $this->User_model->get_user($id);

        // Cek password lama
        if (password_verify($_POST['password_old'], $user['password'])) {

            // Proses edit password
            $data = [
                'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            $this->db->where('id_user', $id);
            $this->db->update('user', $data);

            // Cek status insert
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Berhasil mengedit password
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed !</strong> Terjadi kesalahan saat mengedit password
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
            }
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Password lama anda salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
        redirect('settings');
    }
}

/* End of file Settings.php */
