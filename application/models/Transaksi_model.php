<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    // Get antrian transaksi pending (Request penjemputan)
    public function get_antrian_transaksi()
    {
        // Get data
        $this->db->select('*');
        $this->db->from('transaksi t');
        $this->db->join('pelanggan p', 'p.id_pelanggan = t.id_pelanggan');
        $this->db->where('status', 'pending');
        $this->db->where('tanggal_ambil >=', date('Y-m-d'));
        $data = $this->db->get()->result_array();

        // Add path to image
        $antrian = [];
        foreach ($data as $trans) {
            $trans['foto'] = 'http://api.rosokku.com/assets/img/foto_transaksi/' . $trans['foto'];
            $antrian[] = $trans;
        }
        return $antrian;
    }

    // Confirm antrian transaksi pending
    public function proses_antrian($id)
    {
        if ($id != NULL) {
            // Set data
            $data['status'] = 'confirmed';
            // Update transaksi
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi', $data);
            // Cek status
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> Berhasil dikonfirmasi
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                return true;
            } else {
                $this->session->set_flashdata('status', '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Failed !</strong> Terjadi kesalahan saat mengkonfirmasi
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ');
                return false;
            }
        }
    }

    // Get detail antrian transaksi pending untuk proses penjadwalan
    public function get_opsi_antrian($tanggal)
    {
        // Get data
        $this->db->select('t.tanggal_ambil as tanggal_ambil, DATE_FORMAT(t.tanggal_ambil, "%W") as hari, DATE_FORMAT(t.tanggal_ambil, "%d %M %Y") as tanggal_ambil_formated, COUNT(t.id_transaksi) as jumlah_antrian, k.nama_kurir');
        $this->db->from('transaksi t');
        $this->db->join('kurir k', 'k.id_kurir=t.id_kurir', 'left');
        $this->db->join('rute r', 'r.id_kurir=k.id_kurir', 'left');
        $this->db->where('t.status', 'confirmed');
        $this->db->where('t.id_kurir', NULL);
        $this->db->where('t.tanggal_ambil', $tanggal);
        $this->db->group_by('t.tanggal_ambil');
        $this->db->limit(11); // Limit 11 untuk menyesuaikan dengan limit point mapbox optimization
        return $this->db->get()->row_array();
    }

    // Get transaksi penjadwalan yang belum dijadwalkan (Grup by tanggal)
    public function get_transaksi_not_scheduled()
    {
        // Get data
        $this->db->select('t.tanggal_ambil as tanggal_ambil, DATE_FORMAT(t.tanggal_ambil, "%W") as hari, DATE_FORMAT(t.tanggal_ambil, "%d %M %Y") as tanggal_ambil_formated, COUNT(t.id_transaksi) as jumlah_antrian, k.nama_kurir');
        $this->db->from('transaksi t');
        $this->db->join('kurir k', 'k.id_kurir=t.id_kurir', 'left');
        $this->db->join('rute r', 'r.id_kurir=k.id_kurir', 'left');
        $this->db->where('t.status', 'confirmed');
        $this->db->where('t.id_kurir', NULL);
        $this->db->where('t.tanggal_ambil >=', date('Y-m-d'));
        $this->db->group_by('t.tanggal_ambil');
        $data = $this->db->get()->result_array();

        // Add dff time label
        foreach ($data as $key => $d) {
            $data[$key]['rentang'] = $this->getTimeLabel($d['tanggal_ambil']);
        }
        return $data;
    }

    // Get transaksi penjadwalan yang belum dijadwalkan (Grup by tanggal)
    public function get_transaksi_scheduled()
    {
        // Get data
        $this->db->select('r.id_rute, k.nama_kurir, r.tanggal as tanggal_ambil, DATE_FORMAT(r.tanggal, "%W") as hari, DATE_FORMAT(r.tanggal, "%d %M %Y") as tanggal_ambil_formated, COUNT(dr.id_detail_rute) as jumlah_lokasi');
        $this->db->from('rute r');
        $this->db->join('kurir k', 'k.id_kurir=r.id_kurir', 'left');
        $this->db->join('detail_rute dr', 'dr.id_rute=r.id_rute', 'left');
        $this->db->where('r.tanggal >=', date('Y-m-d'));
        $this->db->where('r.status_rute', 'PENDING');
        $this->db->group_by('r.id_rute');
        $data = $this->db->get()->result_array();

        // Add diff time label
        foreach ($data as $key => $d) {
            $data[$key]['rentang'] = $this->getTimeLabel($d['tanggal_ambil']);
        }
        return $data;
    }

    // Get transaksi penjadwalan yang belum dijadwalkan (Grup by tanggal)
    public function get_transaksi_done()
    {
        // Get data
        $this->db->select('r.id_rute, k.nama_kurir, r.tanggal as tanggal_ambil, DATE_FORMAT(r.tanggal, "%W") as hari, DATE_FORMAT(r.tanggal, "%d %M %Y") as tanggal_ambil_formated, COUNT(dr.id_detail_rute) as jumlah_lokasi');
        $this->db->from('rute r');
        $this->db->join('kurir k', 'k.id_kurir=r.id_kurir', 'left');
        $this->db->join('detail_rute dr', 'dr.id_rute=r.id_rute', 'left');
        $this->db->where('r.tanggal >=', date('Y-m-d'));
        $this->db->where('r.status_rute', 'DONE');
        $this->db->group_by('r.id_rute');
        $data = $this->db->get()->result_array();

        // Add diff time label
        foreach ($data as $key => $d) {
            $data[$key]['rentang'] = $this->getTimeLabel($d['tanggal_ambil']);
        }
        return $data;
    }

    // Get transaksi penjadwalan yang belum dijadwalkan (Grup by tanggal)
    public function get_transaksi_cancel()
    {
        // Get data
        $this->db->select('r.id_rute, k.nama_kurir, r.tanggal as tanggal_ambil, DATE_FORMAT(r.tanggal, "%W") as hari, DATE_FORMAT(r.tanggal, "%d %M %Y") as tanggal_ambil_formated, COUNT(dr.id_detail_rute) as jumlah_lokasi');
        $this->db->from('rute r');
        $this->db->join('kurir k', 'k.id_kurir=r.id_kurir', 'left');
        $this->db->join('detail_rute dr', 'dr.id_rute=r.id_rute', 'left');
        $this->db->where('r.tanggal >=', date('Y-m-d'));
        $this->db->where('r.status_rute', 'CANCEL');
        $this->db->group_by('r.id_rute');
        $data = $this->db->get()->result_array();

        // Add diff time label
        foreach ($data as $key => $d) {
            $data[$key]['rentang'] = $this->getTimeLabel($d['tanggal_ambil']);
        }
        return $data;
    }

    // Get detail rute penugasan
    public function get_detail_rute($id_rute)
    {
        // Get detail rute
        $this->db->select('j.*, k.nama_kurir, r.tanggal as tanggal, DATE_FORMAT(r.tanggal, "%W") as hari, DATE_FORMAT(r.tanggal, "%d %M %Y") as tanggal_ambil_formated, COUNT(t.id_transaksi) as jumlah_lokasi');
        $this->db->from('transaksi t');
        $this->db->join('kurir k', 'k.id_kurir=t.id_kurir', 'left');
        $this->db->join('rute r', 'r.id_kurir=k.id_kurir', 'left');
        $this->db->join('jadwal j', 'j.id_jadwal=t.id_jadwal', 'left');
        $this->db->where('r.id_rute', $id_rute);
        $this->db->where('t.id_kurir !=', NULL);
        $this->db->where('r.tanggal >=', date('Y-m-d'));
        $this->db->where('t.status', 'confirmed');
        $this->db->or_where('t.status', 'done');
        $this->db->group_by('id_rute');

        return $this->db->get()->row_array();
    }

    // Get urutan rute penugasan
    public function get_urutan_rute($id_rute)
    {
        $this->db->select('*, kt.nama as nama_barang, d.urutan as urutan, DATE_FORMAT(t.tanggal_ambil, "%d %M %Y") as tanggal_ambil_formated');
        $this->db->from('transaksi t');
        $this->db->join('pelanggan p', 'p.id_pelanggan=t.id_pelanggan', 'left');
        $this->db->join('kategori kt', 'kt.id_kategori=t.id_kategori', 'left');
        $this->db->join('kurir k', 'k.id_kurir=t.id_kurir', 'left');
        $this->db->join('rute r', 'r.id_kurir=k.id_kurir', 'left');
        $this->db->join('detail_rute d', 'd.id_transaksi=t.id_transaksi', 'left');
        $this->db->where('r.id_rute', $id_rute);
        $this->db->where('t.id_kurir !=', NULL);
        $this->db->where('r.tanggal >=', date('Y-m-d'));
        $this->db->where('t.status', 'confirmed');
        $this->db->or_where('t.status', 'done');
        $this->db->order_by('d.urutan', 'asc');

        return $this->db->get()->result_array();
    }

    // Selesaikan tugas penjemputan
    public function selesaikan_tugas($id_rute)
    {
        // Update data
        $this->db->where('id_rute', $id_rute);
        $this->db->update('rute', [
            'status_rute'    => 'DONE'
        ]);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Tugas penjemputan kurir telah diselesaikan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            $this->session->keep_flashdata('status');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat menyelesaikan penjemputan kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            $this->session->keep_flashdata('status');
            return false;
        }
    }

    // Cancel tugas
    public function cancel_tugas($id_rute)
    {
        // Get detail rute
        $detail_rute = $this->db->get_where('detail_rute', ['id_rute' => $id_rute])->result_array();

        // Start DB Transaction
        $this->db->trans_begin();

        foreach ($detail_rute as $dr) {
            // Update transaksi
            $this->db->where('id_transaksi', $dr['id_transaksi']);
            $this->db->update('transaksi', [
                'id_kurir'      => null,
                'status'        => 'confirmed'
            ]);
        }

        // Delete detail rute
        $this->db->delete('detail_rute', ['id_rute' => $id_rute]);
        // Delete rute
        $this->db->delete('rute', ['id_rute' => $id_rute]);

        // Check status
        if ($this->db->trans_status() === FALSE) {
            // Rollback
            $this->db->trans_rollback();
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat membatalkan penugasan kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        } else {
            // Rollback
            $this->db->trans_commit();
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Penugasan kurir telah di batalkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        }
    }

    // Reschedule tugas
    public function reschedule_tugas($tanggal, $id_rute)
    {
        // Update data
        $this->db->where('id_rute', $id_rute);
        $this->db->update('rute', [
            'tanggal'    => $tanggal
        ]);

        // Cek status
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('status', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Tugas penjemputan kurir telah direschedule
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return true;
        } else {
            $this->session->set_flashdata('status', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed !</strong> Terjadi kesalahan saat me-reschedule penjemputan kurir
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            return false;
        }
    }

    // Get human date different
    public function getTimeLabel($date)
    {
        $time = strtotime($date);
        $currTime = time();
        $timeLabel = $time - $currTime;
        if ($timeLabel < (-3600 * 24)) {
            $timeLabel = "Kadaluarsa";
        } else if ($timeLabel >= (-3600 * 24) & $timeLabel <= 0) {
            $timeLabel = "Hari ini";
        } else if ($timeLabel > 0 & $timeLabel <= (3600 * 24)) {
            $timeLabel = "Besok";
        } else if ($timeLabel > (3600 * 24) & $timeLabel < (3600 * 24 * 7)) {
            $timeLabel = round($timeLabel / (3600 * 24)) . " Hari lagi";
        } else if ($timeLabel > (3600 * 24 * 7) & $timeLabel < (3600 * 24 * 7 * 4)) {
            $timeLabel = round($timeLabel / (3600 * 24 * 7)) . " Minggu lagi";
        } else if ($timeLabel > (3600 * 24 * 7 * 4) & $timeLabel < (3600 * 24 * 7 * 4 * 12)) {
            $timeLabel = round($timeLabel / (3600 * 24 * 7 * 4)) . " Bulan lagi";
        } else {
            $timeLabel = "Lebih dari 1 tahun lagi";
        }
        return $timeLabel;
    }
}

/* End of file Transaksi_model.php */
