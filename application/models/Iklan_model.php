<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Iklan_model extends CI_Model
{
    /* GET IKLAN */
    public function get_iklan($id = NULL)
    {
        // Get all data iklan
        if ($id == NULL) {
            $data = $this->db->get('iklan')->result_array();
        }
        // Get data iklan by id
        else {
            $this->db->where('id_iklan', $id);
            $data = $this->db->get('iklan')->row_array();
        }
        // Return data
        return $data;
    }

    /* ADD DATA IKLAN */
    public function add_iklan($data)
    {
        // Query Insert
        $this->db->insert('iklan', $data);
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan iklan baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan iklan baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT IKLAN */
    public function edit_iklan($data, $id)
    {
        // Query Edit
        $this->db->where('id_iklan', $id);
        $edit = $this->db->update('iklan', $data);
        // Cek status
        if ($edit) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit iklan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Gagal mengedit data iklan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE IKLAN */
    public function delete_iklan($id)
    {
        // Query Delete
        $this->db->where('id_iklan', $id);
        $this->db->delete('iklan');
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data iklan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data iklan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }
}

/* End of file Iklan_model.php */
