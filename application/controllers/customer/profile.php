<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends CI_Controller
{
    // buat contructor
    function __construct()
    {
        parent::__construct();
        $this->load->model('try/users_model');
    }

    public function index()
    {
        $id = $this->session->userdata('user')->ID;
        $data['user'] = $this->users_model->getUserByIDWithUnits($id);
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('customer/profile', $data);
        $this->load->view('templates/footer');
    }
}
