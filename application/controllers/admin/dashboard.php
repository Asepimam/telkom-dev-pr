<?php

class Dashboard extends CI_Controller
{

    public function index()
    {
        $this->load->model('user_model'); // Load the user_model

        $this->load->view('templates/header');

        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }
}
