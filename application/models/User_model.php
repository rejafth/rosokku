<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    /* ADD USER */
    public function add_user($data)
    {
        // Query insert
        $this->db->insert('user', $data);
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan user baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan user baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET USER DATA (ALL/BY ID) */
    public function get_user($id = NULL)
    {
        // Get all user data
        if ($id == NULL) {
            $data = $this->db->get('user')->result_array();
        }
        // Get user data by id
        else {
            $data = $this->db->get_where('user', ['id_user' => $id])->row_array();
        }
        // Return data
        return $data;
    }

    /* GET USER DATA BY USERNAME */
    public function get_user_by_username($username)
    {
        // Query get
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        // Return data
        return $data;
    }

    /* EDIT USER */
    public function edit_user($data, $id)
    {
        // Query edit
        $this->db->where('id_user', $id);
        $query = $this->db->update('user', $data);
        // Cek status
        if ($query) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Perubahan data user berhasil disimpan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal menyimpan perubahan data user
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE USER */
    public function delete_user($id)
    {
        // Query Delete
        $this->db->where('id_user', $id);
        $this->db->delete('user');
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> User telah berhasil dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data user
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    public function reset_password($id)
    {
        // Set data password default
        $data = [
            'password'  => password_hash('12345', PASSWORD_DEFAULT)
        ];
        // Reset password
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
        // Check status
        if ($this->db->affected_rows() > 0) {
            // Success
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mereset password
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        } else {
            // Failed
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat mereset password
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
        }
    }
}

/* End of file User_model.php */
