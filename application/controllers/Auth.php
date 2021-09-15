<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /* CONSTRUCT */
    public function __construct()
    {
        // Parent construct
        parent::__construct();
    }

    /* INDEX */
    public function index()
    {
        // Redirect to login page
        redirect('login');
    }

    /* LOGIN PAGE */
    public function login()
    {
        // Check is user already logged in
        if (isset($_SESSION['login']) & isset($_SESSION['user']) & isset($_SESSION['role'])) {
            redirect('dashboard');
            die;
        }
        // Create view
        $data['title'] = 'Rosokku | Login';
        $this->load->view('auth/login', $data);
    }

    /* LOGIN PROSES */
    public function proses_login()
    {
        // Check is user not login yet ?
        if (isset($_SESSION['login']) & isset($_SESSION['user']) & isset($_SESSION['role'])) {
            redirect('dashboard');
            die;
        }

        // Check credential availability status
        if (isset($_POST['username']) & isset($_POST['password'])) {
            // Get post data
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Get user by username
            $user = $this->User_model->get_user_by_username($username);
            // Cek username
            if ($user) {
                // Check password
                if (password_verify($password, $user['password'])) {
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user['id_user'];
                    $_SESSION['role'] = $user['role']; // admin, staff
                    // Redirect afetr logged in
                    redirect('dashboard');
                } else {
                    // Message password error
                    $this->session->set_flashdata('status', '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password salah !</strong> pastikan password anda benar
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ');
                    // Redirect
                    redirect('login');
                }
            } else {
                // Message username error
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Username salah !</strong> pastikan username anda benar
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                // Redirect
                redirect('login');
            }
        } else {
            // Redirect
            redirect('login');
        }
    }

    /* LOGOUT PROSES */
    public function logout()
    {
        // Destroy logged session
        session_destroy();
        // Redirect to login page
        redirect('login');
    }
}

/* End of file Auth.php */
