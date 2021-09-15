<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    /* CONSTRUCT */
    public function __construct()
    {
        parent::__construct();

        // Check is user already logged in
        if (!isset($_SESSION['login']) & !isset($_SESSION['user']) & !isset($_SESSION['role'])) {
            redirect('login');
            die;
        }

        // Check logged in user role is admin or not
        if ($_SESSION['role'] != 'Admin') {
            echo $this->load->view('denied', true, true);
            die;
        }

        // Set user data constant
        $user = $this->db->get_where('user', ['id_user' => $_SESSION['user']])->row_array();
        define('USER', $user);
    }

    /* INDEX */
    public function index()
    {
        // Set view data
        $data['user']  = $this->User_model->get_user();
        $data['title'] = 'Rosokku | Kelola user';
        // Create view
        $this->load->view('template/header', $data);
        $this->load->view('user/index');
        $this->load->view('template/footer');
    }

    /* ADD USER PAGE */
    public function add()
    {
        // Set view data
        $data['user'] = $this->session->flashdata('user');
        $data['titlePage']  = 'Tambah User';
        $data['action'] = base_url('user/proses_add');
        $data['title'] = 'Rosokku | Add user';
        // Create view
        $this->load->view('template/header', $data);
        $this->load->view('user/form');
        $this->load->view('template/footer');
    }

    /* PROSES ADD USER */
    public function proses_add()
    {
        // Check availability data POST
        if (!empty($_POST)) {
            // Get data
            $data = [
                'nama'          => $_POST['nama'],
                'email'         => $_POST['email'],
                'phone'         => $_POST['phone'],
                'username'      => $_POST['username'],
                'password'      => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role'          => $_POST['role']
            ];
            // Query check email
            $cekEmail = $this->db->get_where('user', ['email' => $data['email']]);
            // Check email
            if ($cekEmail->num_rows() == 0) {
                // Query check username
                $cekUsername = $this->db->get_where('user', ['username' => $data['username']]);
                // Check username
                if ($cekUsername->num_rows() == 0) {
                    // Add user
                    $this->User_model->add_user($data);
                    redirect('user');
                } else {
                    // Error username already taken
                    $this->session->set_flashdata('status', '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Failed !</strong> Username sudah digunakan
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ');
                    $this->session->set_flashdata('user', $data);
                    redirect('user/add');
                }
            } else {
                // Error email already taken
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed !</strong> Email sudah digunakan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                $this->session->set_flashdata('user', $data);
                redirect('user/add');
            }
        }
    }

    /* VIEW DETAIL USER */
    public function view($id)
    {
        // Set view data
        $data['user']  = $this->User_model->get_user($id);
        $data['title'] = 'Rosokku | View user';
        // Create view
        $this->load->view('template/header', $data);
        $this->load->view('user/view');
        $this->load->view('template/footer');
    }

    /* EDIT USER PAGE */
    public function edit($id)
    {
        // Set view data
        $data['titlePage']  = 'Edit User';
        $data['action'] = base_url('user/proses_edit');
        $data['user']  = $this->User_model->get_user($id);
        $data['title'] = 'Rosokku | View user';
        // Create view
        $this->load->view('template/header', $data);
        $this->load->view('user/form');
        $this->load->view('template/footer');
    }

    /* EDIT PROCESS */
    public function proses_edit()
    {
        // Check availability POST data
        if (!empty($_POST)) {
            // Get data POST
            $data = [
                'id_user'       => $_POST['id_user'],
                'nama'          => $_POST['nama'],
                'email'         => $_POST['email'],
                'phone'         => $_POST['phone'],
                'username'      => $_POST['username'],
                'role'          => $_POST['role']
            ];
            // Get detail user
            $user = $this->db->get_where('user', ['id_user' => $data['id_user']])->row_array();
            // Get user's email
            $email = $user['email'];
            // Check is email still same with before or not
            if ($data['email'] != $email) {
                // Query Check availability email
                $cekEmail = $this->db->get_where('user', ['email' => $data['email']]);
                // Check availability email
                if ($cekEmail->num_rows() == 0) {
                    $statusEmail = true;
                } else {
                    $statusEmail = false;
                }
            } else {
                $statusEmail = true;
            }

            // Get user's username
            $username = $user['username'];
            // Check is username still same with before or not
            if ($data['username'] != $username) {
                // Query check availability username
                $cekUsername = $this->db->get_where('user', ['username' => $data['username']]);
                // Check availability username
                if ($cekUsername->num_rows() == 0) {
                    $statusUsername = true;
                } else {
                    $statusUsername = false;
                }
            } else {
                $statusUsername = true;
            }

            // Edit Process
            if ($statusEmail == true & $statusUsername == true) {
                $this->User_model->edit_user($data, $data['id_user']);
                redirect('user');
            }
            // Error email already taken
            else if ($statusEmail == false & $statusUsername == true) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Email sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                redirect('user/edit/' . $data['id_user']);
            }
            // Error username already taken
            else if ($statusEmail == true & $statusUsername == false) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Username sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                redirect('user/edit/' . $data['id_user']);
            }
            // Error email and username already taken
            else if ($statusEmail == false & $statusUsername == false) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Username dan Email sudah digunakan !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                redirect('user/edit/' . $data['id_user']);
            }
        }
    }

    /* DELETE PROCESS */
    public function delete($id)
    {
        // Delete user
        $this->User_model->delete_user($id);
        redirect('user');
    }

    /* RESET PASSWORD */
    public function resetPassword($id)
    {
        // Reset password user
        $this->User_model->reset_password($id);
        redirect('user');
    }
}

/* End of file User.php */
