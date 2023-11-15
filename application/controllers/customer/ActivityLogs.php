<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ActivityLogs extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('customer/activitylogs');
        $this->load->view('templates/footer');
    }
}
