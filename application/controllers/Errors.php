<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Errors extends CI_Controller
{
    public function offline()
    {
        $data['title'] = 'Offline';
        $this->load->view('offline', $data);
    }

    public function error_404()
    {
        $data['title'] = 'Page not found';
        $this->load->view('template/header', $data);
        $this->load->view('404');
        $this->load->view('template/footer');
    }
}

/* End of file Error.php */
