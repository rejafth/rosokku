<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    /*
    ==================================================================================
     MASTER PELANGGAN                                                                  
    ==================================================================================
    */

    /* ADD PELANGGAN */
    public function add_pelanggan($data)
    {
        // Query Insert
        $this->db->insert('pelanggan', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan pelanggan baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan pelanggan baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT PELANGGAN */
    public function edit_pelanggan($data, $id)
    {
        // Query edit
        $this->db->where('id_pelanggan', $id);
        $this->db->update('pelanggan', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit pelanggan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Tidak ada perubahan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE PELANGGAN */
    public function delete_pelanggan($id)
    {
        // Query Delete
        $this->db->where('id_pelanggan', $id);
        $this->db->delete('pelanggan');

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data pelanggan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data pelanggan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET PELANGGAN */
    public function get_pelanggan($id = NULL)
    {
        // Get all data pelanggan
        if ($id == NULL) {
            // Get all data
            $this->db->select('*, p.id_pelanggan as id_pelanggan');
            $this->db->from('pelanggan p');
            // $this->db->join('alamat a', 'a.id_pelanggan = p.id_pelanggan', 'left');
            $data = $this->db->get()->result_array();
        }
        // Get data pelanggan by id
        else {
            // Get data by ID
            $this->db->select('*, p.id_pelanggan as id_pelanggan');
            $this->db->from('pelanggan p');
            // $this->db->join('alamat a', 'a.id_pelanggan = p.id_pelanggan', 'left');
            $this->db->where('p.id_pelanggan', $id);
            $data = $this->db->get()->row_array();
        }
        return $data;
    }


    /*
    ==================================================================================
     MASTER KATEGORI
    ==================================================================================
    */

    /* ADD KATEGORI */
    public function add_kategori($data)
    {
        // Query Insert
        $this->db->insert('kategori', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan kategori baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan kategori baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT KATEGORI */
    public function edit_kategori($data, $id)
    {
        // Query Edit
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit data kategori
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Tidak ada perubahan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE KATEGORI */
    public function delete_kategori($id)
    {
        // Query Delete
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data kategori
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data kategori
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET KATEGORI */
    public function get_kategori($id = NULL)
    {
        // Get all data kategori
        if ($id == NULL) {
            $data = $this->db->get('kategori')->result_array();
        }
        // Get data kategori by id
        else {
            $data = $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
        }
        // Return data
        return $data;
    }


    /*
    ==================================================================================
     MASTER KURIR
    ==================================================================================
    */

    /* ADD KURIR */
    public function add_kurir($data)
    {
        // Query insert
        $this->db->insert('kurir', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan kurir baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan kurir baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT KURIR */
    public function edit_kurir($data, $id)
    {
        // Query Edit
        $this->db->where('id_kurir', $id);
        $this->db->update('kurir', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit data kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Tidak ada perubahan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE KURIR */
    public function delete_kurir($id)
    {
        // Query Delete
        $this->db->where('id_kurir', $id);
        $this->db->delete('kurir');

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET KURIR */
    public function get_kurir($id = NULL)
    {
        // Get all data kurir
        if ($id == NULL) {
            $data = $this->db->get('kurir')->result_array();
        }
        // Get data kurir by id
        else {
            $data = $this->db->get_where('kurir', ['id_kurir' => $id])->row_array();
        }
        // Return data
        return $data;
    }


    /*
    ==================================================================================
     MASTER JADWAL
    ==================================================================================
    */

    /* ADD JADWAL */
    public function add_jadwal($data)
    {
        // Query insert
        $this->db->insert('jadwal', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan jadwal baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan jadwal baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT JADWAL */
    public function edit_jadwal($data, $id)
    {
        // Query Edit
        $this->db->where('id_jadwal', $id);
        $this->db->update('jadwal', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit data jadwal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Tidak ada perubahan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE JADWAL */
    public function delete_jadwal($id)
    {
        // Query Delete
        $this->db->where('id_jadwal', $id);
        $this->db->delete('jadwal');

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data jadwal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data jadwal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET JADWAL */
    public function get_jadwal($id = NULL)
    {
        // Get all data jadwal
        if ($id == NULL) {
            $data = $this->db->get('jadwal')->result_array();
        }
        // Get data jadwal by ID
        else {
            $data = $this->db->get_where('jadwal', ['id_jadwal' => $id])->row_array();
        }
        // Return data
        return $data;
    }


    /*
    ==================================================================================
     MASTER START POINTS
    ==================================================================================
    */

    /* ADD START POINT */
    public function add_start_point($data)
    {
        // Query Insert
        $this->db->insert('start_point', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan start point baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menambahkan start point baru
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT START POINT */
    public function edit_start_point($data)
    {
        // Query Edit
        $this->db->where('id_start', $data['id_start']);
        $this->db->update('start_point', $data);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit start data point
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning !</strong> Tidak ada perubahan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* DELETE JADWAL */
    public function delete_start_point($id)
    {
        // Query Delete
        $this->db->where('id_start', $id);
        $this->db->delete('start_point');

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus data start point
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menghapus data start point
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET START POINT */
    public function get_start_point($id = NULL)
    {
        // Get all data start point
        if ($id == NULL) {
            $data = $this->db->get('start_point')->result_array();
        }
        // Get data start point by ID
        else {
            $data = $this->db->get_where('start_point', ['id_start' => $id])->row_array();
        }
        // Return data
        return $data;
    }
}

/* End of file Master_model.php */
