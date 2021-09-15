<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan_model extends CI_Model
{
    /* GET ANTRIAN REQUEST SALDO PELANGGAN */
    public function get_requestSaldo($id = NULL)
    {
        // Query get
        $this->db->select('*, DATE_FORMAT(r.tanggal, "%d-%m-%Y") as tanggal_formated');
        $this->db->from('request_saldo r');
        $this->db->join('pelanggan p', 'p.id_pelanggan = r.id_pelanggan');
        $this->db->where('r.status', 'pending');
        // Get detail
        if ($id != NULL) {
            $this->db->where('r.id_request_saldo', $id);
            $data = $this->db->get()->row_array();
        }
        // Get all
        else {
            $data = $this->db->get()->result_array();
        }
        // Return data
        return $data;
    }

    /* GET DATA KEUANGAN */
    public function get_keuangan($id = NULL, $tipe = NULL)
    {
        // Get all data keuangan
        if ($id == NULL & $tipe == NULL) {
            $this->db->order_by('tanggal', 'desc');
            $data = $this->db->get('keuangan')->result_array();
        }
        // Get all data keuangan spesified by tipe (IN/OUT)
        else if ($id == NULL & $tipe != NULL) {
            $this->db->where('tipe', $tipe);
            $this->db->order_by('tanggal', 'desc');
            $data = $this->db->get('keuangan')->result_array();
        }
        // Get data keuangan by id
        else if ($id != NULL) {
            $this->db->order_by('tanggal', 'desc');
            $data = $this->db->get_where('keuangan', ['id_keuangan' => $id])->row_array();
        }
        // Return data
        return $data;
    }

    /* INSERT DATA KEUANGAN */
    public function add_keuangan($data)
    {
        // Query insert
        $this->db->insert('keuangan', $data);
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menambahkan catatan keuangan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal menambahkan catatan keuangan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* GET SUMMARY KEUANGAN BY TIPE (IN/OUT) */
    public function get_summary($tipe)
    {
        // Query get
        $this->db->select('SUM(nominal) as total');
        $this->db->where('tipe', $tipe);
        $data = $this->db->get('keuangan')->row_array();
        // return data
        return $data['total'];
    }

    /* DLETE DATA KEUANGAN */
    public function delete_keuangan($id)
    {
        // Query delete
        $this->db->where('id_keuangan', $id);
        $this->db->delete('keuangan');
        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil menghapus catatan keuangan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal menghapus catatan keuangan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* EDIT DATA KEUANGAN */
    public function edit_keuangan($data, $id)
    {
        // Query update
        $this->db->where('id_keuangan', $id);
        $query = $this->db->update('keuangan', $data);
        // Cek status
        if ($query) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Berhasil mengedit catatan keuangan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Gagal mengedit catatan keuangan !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    /* PROSES PENCAIRAN SALDO */
    public function pencairan_saldo($keuangan, $id_request)
    {
        // Query insert data keuangan
        $this->db->insert('keuangan', $keuangan);
        // Cek status insert
        if ($this->db->affected_rows() > 0) {
            // Get inserted keuangan id
            $id_keuangan = $this->db->insert_id();
            // Query update data request saldo
            $this->db->where('id_request_saldo', $id_request);
            $this->db->update('request_saldo', ['id_keuangan' => $id_keuangan, 'status' => 'paid']);
            // Cek status
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Request saldo berhasil diproses !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                return true;
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed !</strong> Request saldo gagal diproses !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                return false;
            }
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Request saldo gagal diproses !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }
}

/* End of file Keuangan_model.php */
