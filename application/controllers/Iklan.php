<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Iklan extends CI_Controller
{

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


    public function index()
    {
        $data['iklan'] = $this->Iklan_model->get_iklan();
        $data['title'] = 'Iklan | List iklan';
        $this->load->view('template/header', $data);
        $this->load->view('iklan/index');
        $this->load->view('template/footer');
    }

    public function add_iklan()
    {
        if (!empty($_POST)) {
            $data = [
                'label_iklan'       => $_POST['label_iklan'],
                'link_iklan'        => $_POST['link_iklan'],
                'target_usia'       => $_POST['target_usia']
            ];
            if (!empty($_FILES)) {
                if ($_FILES['image_iklan']['size'] != 0) {
                    $data['image_iklan'] = $this->Upload_model->upload('image_iklan', './assets/img/thumb-iklan/', 'THUMB_', 'thumbiklan');
                }
            }
            $status = $this->Iklan_model->add_iklan($data);
            redirect('iklan');
        } else {
            $data['title'] = 'Rosokku | Add Iklan';
            $data['action'] = base_url('iklan/add_iklan');
            $data['submitLabel'] = 'Tambahkan';
            $data['pageLabel'] = 'Tambah iklan';
            $this->load->view('template/header', $data);
            $this->load->view('iklan/form_iklan');
            $this->load->view('template/footer');
        }
    }

    public function edit_iklan($id = null)
    {
        if (!empty($_POST)) {
            // Get iklan
            $iklan = $this->Iklan_model->get_iklan($_POST['id_iklan']);

            // Set data iklan
            $data = [
                'label_iklan'       => $_POST['label_iklan'],
                'link_iklan'        => $_POST['link_iklan'],
                'target_usia'       => $_POST['target_usia']
            ];

            // Cek upload
            if (!empty($_FILES)) {
                if ($_FILES['image_iklan']['size'] != 0) {
                    $data['image_iklan'] = $this->Upload_model->upload('image_iklan', './assets/img/thumb-iklan/', 'THUMB_', 'thumbiklan');
                    if ($data['image_iklan'] != NULL) {
                        if (file_exists('./assets/img/thumb-iklan/' . $iklan['image_iklan'])) {
                            unlink('./assets/img/thumb-iklan/' . $iklan['image_iklan']);
                        }
                    }
                }
            }

            // Redirect
            $status = $this->Iklan_model->edit_iklan($data, $_POST['id_iklan']);
            redirect('iklan');
        } else {
            $data['title'] = 'Rosokku | Edit Iklan';
            $data['action'] = base_url('iklan/edit_iklan');
            $data['iklan'] = $this->Iklan_model->get_iklan($id);
            $data['submitLabel'] = 'Simpan';
            $data['pageLabel'] = 'Edit iklan';
            $this->load->view('template/header', $data);
            $this->load->view('iklan/form_iklan');
            $this->load->view('template/footer');
        }
    }

    public function delete_iklan($id)
    {
        $status = $this->Iklan_model->delete_iklan($id);
        redirect('iklan');
    }
}

/* End of file Iklan.php */
