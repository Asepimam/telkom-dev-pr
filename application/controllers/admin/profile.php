<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->user_model->get_user_info(); // Fetch the user's data
        $this->load->view('templates/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }
}
