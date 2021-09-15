<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    /* ADD PENJUALAN */
    public function add_penjualan($data)
    {
        // Get kategori
        $kategori = $this->Master_model->get_kategori($data['id_kategori']);

        // Cek apakah penjualan melebihi stock atau tidak
        if ($kategori['stock'] >= $data['berat']) {

            // Create string label keterangan penjualan
            $keterangan = "Penjualan " . $kategori['nama'] . " seberat " . $data['berat'] . " Kg kepada " . $data['pembeli'];

            // Create data catatan keuangan
            $data_keuangan = [
                'tipe'              => 'in',
                'keterangan'        => $keterangan,
                'nominal'           => str_replace(',', '', $data['nominal']),
                'tanggal'           => $data['tanggal'],
                'kategori'          => 'penjualan'
            ];
            // Query insert keuangan
            $this->db->insert('keuangan', $data_keuangan);

            // Create data edit stock
            $stock = $kategori['stock'] - $data['berat'];
            $data_stock = [
                'stock'        => $stock
            ];
            // Query update kategori
            $this->db->where('id_kategori', $data['id_kategori']);
            $this->db->update('kategori', $data_stock);

            // Generate sell success response
            $this->session->set_flashdata('status', "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success !</strong> Berhasil menambahkan penjualan barang <a href=" . base_url('keuangan') . ">Lihat pemasukan keuangan</a>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            ");
            return true;
        } else {
            // Generate fail response (Stock tidak mencukupi)
            $berat = $data['berat'];
            $this->session->set_flashdata('status', "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Failed !</strong> Stock barang tidak mencukupi untuk penjualan seberat $berat Kg
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
            ");
            $this->session->set_flashdata('data', $data);
            return false;
        }
    }
}

/* End of file Penjualan_model.php */
