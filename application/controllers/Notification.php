<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    /* 
    ==================================================================================
    CONSTRUCT
    ==================================================================================
    */
    public function index()
    {
        redirect('notification/load_notif');
    }

    public function load_notif()
    {
        // Get new request pengambilan
        $new_request = $this->db->get_where('transaksi', ['status' => 'pending'])->result_array();

        // Get new pencairan
        $new_pencairan = $this->db->get_where('request_saldo', ['status' => 'pending'])->result_array();

        // Set response data
        $response = [
            'new_request'       => count($new_request),
            'new_pencairan'     => count($new_pencairan),
            'total'             => count($new_request) + count($new_pencairan)
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

/* End of file Notification.php */
