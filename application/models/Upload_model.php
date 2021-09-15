<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    // Upload file
    public function upload($inputfile, $path, $prefix = 'IMG_', $alias)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = strtoupper(uniqid($prefix));
        $config['overwrite']            = false;
        $config['max_size']             = 5120;

        $this->load->library('upload', $config, $alias);
        $this->$alias->initialize($config);

        if ($this->$alias->do_upload($inputfile)) {
            $uploaddata = $this->$alias->data();
            return $uploaddata['file_name'];
        }

        return null;
    }
}

/* End of file Upload_model.php */
