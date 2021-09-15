<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
    /* CONSTRUCT */
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

        /* Define constant of MAPBOX API KEY */
        define('MAPKEY', "pk.eyJ1IjoiaW1hbW5jIiwiYSI6ImNrZmo5ZHl3MDA4MjgycnF1Mng2OWNyazIifQ.BwzgOyXOLCqaVjGp-OEZIw");
    }

    /* 
    ==================================================================================
    PENJADWALAN
    ==================================================================================
    */
    public function index()
    {
        // Set data hari
        $data['hari'] = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];
        // Get transaksi belum dijadwalkan
        $data['antrian'] = $this->Transaksi_model->get_transaksi_not_scheduled();
        // Get transaksi terjadwalkan
        $data['schedule'] = $this->Transaksi_model->get_transaksi_scheduled();
        // Get transaksi selesai (Telah dijemput kurir)
        $data['done'] = $this->Transaksi_model->get_transaksi_done();
        // Get transaksi di cancel (Canceled)
        $data['cancel'] = $this->Transaksi_model->get_transaksi_cancel();
        // Get start point
        $data['starts'] = $this->Master_model->get_start_point();
        // Get kurir
        $data['kurir'] = $this->db->get('kurir')->result_array();
        // Create view
        $data['title'] = 'Rosokku | Penjadwalan';
        $this->load->view('template/header', $data);
        $this->load->view('schedule/index');
        $this->load->view('template/footer');
    }

    public function get_opsi_antrian($tanggal)
    {
        $data = $this->Transaksi_model->get_opsi_antrian($tanggal);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function view_maps($id)
    {
        $data['transaksi'] = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
        $data['title'] = 'Rosokku | Lihat lokasi';
        $this->load->view('template/header', $data);
        $this->load->view('schedule/view_maps');
        $this->load->view('template/footer');
    }

    public function view_rute($id_rute)
    {
        // Get GeoJSON
        $transaksi = $this->Transaksi_model->get_urutan_rute($id_rute);

        // 1. Set coordinates
        $start = $this->Master_model->get_start_point($transaksi[0]['id_start']);
        $source = $start['longitude_start'] . ',' . $start['latitude_start'];
        $coordinates = $source . ';';
        foreach ($transaksi as $key => $trans) {
            $coordinates .= $trans['longitude_transaksi'] . "," . $trans['latitude_transaksi'] . ";";
        }
        $coordinates = substr($coordinates, 0, -1);

        // 2. Create url
        $access_key = MAPKEY;
        $baseUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/";
        $baseUrl .= $coordinates;
        $baseUrl .= "?source=first&geometries=geojson&roundtrip=true&destination=last&access_token=$access_key";

        // 3. Optimize route
        $rute = $this->http_get($baseUrl);
        $rute = json_decode($rute, true);
        $rute = json_encode($rute['trips'][0]['geometry']);

        // Page construct
        $data['rute'] = $rute;
        $data['center'] = explode(',', explode(';', $coordinates)[0]);
        $data['transaksi'] = $this->Transaksi_model->get_urutan_rute($id_rute);
        $data['title'] = 'Rosokku | Lihat rute';
        $this->load->view('template/header', $data);
        $this->load->view('schedule/view_rute');
        $this->load->view('template/footer');
    }

    public function selesaikan_tugas($id_rute)
    {
        // Proses
        $this->Transaksi_model->selesaikan_tugas($id_rute);
        redirect('schedule?tab=done');
    }

    public function cancel_tugas($id_rute)
    {
        // Proses
        $this->Transaksi_model->cancel_tugas($id_rute);
        redirect('schedule?tab=pending');
    }

    public function reschedule_tugas()
    {
        // Get data
        $id_rute = $_POST['id_rute'];
        $tanggal = $_POST['tanggal'];
        // Proses
        $this->Transaksi_model->reschedule_tugas($tanggal, $id_rute);
        redirect('schedule?tab=scheduled');
    }

    public function view_jadwal($id_rute)
    {
        // Set data hari
        $data['hari'] = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];
        // Get detail rute
        $data['jadwal'] = $this->Transaksi_model->get_detail_rute($id_rute);
        // Get urutan penjemputan rute
        $data['transaksi'] = $this->Transaksi_model->get_urutan_rute($id_rute);
        // Create view
        $data['title'] = 'Rosokku | View Penjadwalan';
        $this->load->view('template/header', $data);
        $this->load->view('schedule/view_jadwal');
        $this->load->view('template/footer');
    }

    public function proses_penjadwalan()
    {
        /* =================================================================================
        1. Set data yang dibutuhkan
        ================================================================================= */
        $tanggal = $_POST['tanggal_ambil']; // Tanggal ambil
        $kurir = $_POST['id_kurir']; // Kurir
        $start = $this->Master_model->get_start_point($_POST['id_start']); // Data start point
        $source = $start['longitude_start'] . ',' . $start['latitude_start']; // Start point coordinate
        // Get transaksi
        $this->db->limit(11); // Limit 11 transaksi
        $transaksi = $this->db->get_where('transaksi', ['tanggal_ambil' => $tanggal, 'id_kurir' => NULL, 'status' => 'confirmed'])->result_array();

        /* =================================================================================
        2. Membagi transaksi ke masing-masing kurir yang dipilih
        ================================================================================= */
        $temp = 0;
        $pembagian = [];
        foreach ($transaksi as $key => $trans) {
            $pembagian[] = [
                'id_kurir'          => $kurir[$temp],
                'id_transaksi'      => $trans['id_transaksi'],
                'coordinate'        => $trans['longitude_transaksi'] . ',' . $trans['latitude_transaksi']
            ];
            if ($temp < count($kurir) - 1) {
                $temp++;
            } else {
                $temp = 0;
            }
        }

        /* =================================================================================
        3. Membuat data penugasan
        ================================================================================= */
        // Membuat wadah penugasan kurir
        $penugasan = [];
        foreach ($kurir as $kur) {
            $penugasan[] = [
                'id_kurir'      => $kur,
                'transaksi'     => []
            ];
        }
        // Merangkai data pembagian ke wadah penugasan kurir
        foreach ($pembagian as $bagian) {
            foreach ($penugasan as $key => $tugas) {
                if ($bagian['id_kurir'] == $tugas['id_kurir']) {
                    $penugasan[$key]['transaksi'][] = [
                        'id_transaksi'      => $bagian['id_transaksi'],
                        'coordinate'        => $bagian['coordinate']
                    ];
                }
            }
        }

        /* =================================================================================
        4. Update id_kurir dan id_start pada tabel transaksi
        ================================================================================= */
        $statusTransaksi = 0;
        foreach ($pembagian as $bagian) {
            $this->db->where('id_transaksi', $bagian['id_transaksi']);
            $this->db->update('transaksi', [
                'id_start'      => $_POST['id_start'],
                'id_kurir'      => $bagian['id_kurir']
            ]);
            // Cek status
            if ($this->db->affected_rows() > 0) {
                $statusTransaksi++;
            }
        }

        /* =================================================================================
        5. Generate rute, detail rute
        ================================================================================= */
        if ($statusTransaksi == count($pembagian)) {

            foreach ($penugasan as $tugas) {

                if (count($tugas['transaksi']) > 0) {

                    // 1. Buat rute
                    $data_rute = [
                        'id_kurir'      => $tugas['id_kurir'],
                        'id_start'      => $_POST['id_start'],
                        'tanggal'       => $tanggal,
                        'status_rute'   => 'PENDING'
                    ];
                    $this->db->insert('rute', $data_rute);
                    $id_rute = $this->db->insert_id();

                    // Cek status pembuatan rute
                    if ($this->db->affected_rows() > 0) {

                        // 2. Set coordinates
                        $coordinates = $source . ';';
                        foreach ($tugas['transaksi'] as $trans) {
                            $coordinates .= $trans['coordinate'] . ";";
                        }
                        $coordinates = substr($coordinates, 0, -1);

                        // 3. Create url
                        $access_key = MAPKEY;
                        $baseUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/";
                        $baseUrl .= $coordinates;
                        $baseUrl .= "?source=first&roundtrip=true&access_token=$access_key";

                        // 4. Optimize route
                        $rute = $this->http_get($baseUrl);
                        $rute = json_decode($rute, true);
                        $rute = $rute['waypoints'];

                        // 5. Buat detail rute
                        $statusDetailRute = 0;
                        foreach ($tugas['transaksi'] as $key => $trans) {
                            $detail_rute = [
                                'id_transaksi' => $trans['id_transaksi'],
                                'id_rute'      => $id_rute,
                                'urutan'       => $rute[$key + 1]['waypoint_index']
                            ];
                            $this->db->insert('detail_rute', $detail_rute);
                            // Cek status
                            if ($this->db->affected_rows() > 0) {
                                $statusDetailRute++;
                            }
                        }

                        // Cek status generate detail rute
                        if ($statusDetailRute == count($tugas['transaksi'])) {
                            $this->session->set_flashdata('status', '
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Penjadwalan berhasil !</strong> kurir sudah ditugaskan untuk melakukan penjemputan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ');
                        } else {
                            $this->session->set_flashdata('status', '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Penjadwalan gagal !</strong> terjadi kesalahan saat proses penjadwalan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            ');
                        }
                        $this->session->keep_flashdata('status');
                    }
                }
            }
        }
    }

    private function http_get($url)
    {
        // persiapkan curl
        $ch = curl_init();

        // set url 
        curl_setopt($ch, CURLOPT_URL, $url);

        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string 
        $output = curl_exec($ch);

        // tutup curl 
        curl_close($ch);

        // mengembalikan hasil curl
        return $output;
    }
}

/* End of file Schedule.php */
