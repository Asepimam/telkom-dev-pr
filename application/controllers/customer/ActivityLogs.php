<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ActivityLogs extends CI_Controller
{
    // buat contucter
    public function __construct()
    {
        parent::__construct();
        $this->load->model('try/log_aktivitas_model');
    }
    // public function index()
    // {
    //     $this->load->view('templates/header');
    //     $this->load->view('templates/customer/sidebar');
    //     $this->load->view('templates/footer');
    // }
    public function get_logs_aktivitas($id)
    {
        $data['logs'] = $this->log_aktivitas_model->get_log_aktivitas($id);
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('templates/footer');
        $this->load->view('customer/activitylogs', $data);
    }
}
