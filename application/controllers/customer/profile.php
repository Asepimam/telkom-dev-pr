<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends CI_Controller
{
    public function index()
    {
        $this->load->model('try/users_model');
        $data['user'] = $this->users_model->getUserByID($this->session->userdata('user_id'));
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('customer/profile', $data);
        $this->load->view('templates/footer');
    }
}
