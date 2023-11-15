<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Timeline extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model Log_Aktivitas_model.php
        $this->load->model('try/log_aktivitas_model');
    }

    public function index()
    {
        // Tampilkan halaman timeline
        $data['log_aktivitas'] = $this->log_aktivitas_model->get_log_aktivitas();
        $this->load->view('timeline', $data);
    }
}
