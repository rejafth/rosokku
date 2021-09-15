<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    /* GET DATA GRAFIK KEUANGAN */
    public function grafik_keuangan()
    {
        // Get outcome (Group By Bulan & Tahun)
        $this->db->select('SUM(nominal) as total, DATE_FORMAT(tanggal, "%b") as bulan, DATE_FORMAT(tanggal, "%Y%m") as bulantahun');
        $this->db->from('keuangan');
        $this->db->group_by('bulantahun');
        $this->db->where('tanggal <= NOW()');
        $this->db->where('tipe', 'out');
        $this->db->order_by('bulantahun', 'desc');
        $this->db->limit(6);
        $out = $this->db->get()->result_array();

        // Get income (Group By Bulan & Tahun)
        $this->db->select('SUM(nominal) as total, DATE_FORMAT(tanggal, "%b") as bulan, DATE_FORMAT(tanggal, "%Y%m") as bulantahun');
        $this->db->from('keuangan');
        $this->db->group_by('bulantahun');
        $this->db->where('tanggal <= NOW()');
        $this->db->where('tipe', 'in');
        $this->db->order_by('bulantahun', 'desc');
        $this->db->limit(6);
        $in = $this->db->get()->result_array();

        // Prepare data
        $income = '';
        $outcome = '';
        $bulan = '';

        // Set counter loop
        if (count($in) > count($out)) {
            $counter = $in;
        } else if (count($in) < count($out)) {
            $counter = $out;
        } else {
            $counter = $in;
        }

        // Loop data kemudian isi data
        for ($i = count($counter) - 1; $i >= 0; $i--) {
            $income .= (isset($in[$i]['total'])) ? round($in[$i]['total']) . ',' : '0,';
            $outcome .= (isset($out[$i]['total'])) ? round($out[$i]['total']) . ',' : '0,';
            $bulan .= '"' . $counter[$i]['bulan'] . '",';
        }

        // Return data
        $data = [
            'income'     => substr($income, 0, -1),
            'outcome'    => substr($outcome, 0, -1),
            'bulan'      => substr($bulan, 0, -1)
        ];
        return $data;
    }

    /* GET GRAFIK STOCK */
    public function grafik_stock()
    {
        // Get kategori
        $kategori = $this->db->get('kategori')->result_array();
        // Set data
        $label = '';
        $value = '';
        // Loop data dan isi data
        foreach ($kategori as $key => $kat) {
            $label .= '"' . $kat['nama'] . '",';
            $value .= $kat['stock'] . ',';
        }
        // Return data
        $data = [
            'label'     => $label,
            'value'     => $value
        ];
        return $data;
    }

    /* GET PERINGKAT FREKUENSI PENJEMPUTAN KURIR */
    public function peringkat_kurir()
    {
        $this->db->select('k.nama_kurir, IFNULL(COUNT(r.id_rute), 0) as frekuensi');
        $this->db->from('kurir k');
        $this->db->join('rute r', 'r.id_kurir = k.id_kurir', 'left');
        $this->db->group_by('k.id_kurir');
        $this->db->order_by('frekuensi', 'desc');
        $data = $this->db->get()->result_array();
        return $data;
    }
}

/* End of file Report_model.php */
