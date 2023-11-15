<?php


class dashboard extends CI_Controller
{

    public function index()
    {
        // Muat tampilan dashboard dengan template header dan footer
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('customer/dashboard');
        $this->load->view('templates/footer');
    }
}
