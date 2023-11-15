<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approved extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('try/persetujuan_model');
    }

    public function index()
    {
        $this->load->view('templates/header');

        $this->load->view('templates/footer');
        $this->load->view('templates/customer/sidebar');
        // Tampilkan halaman persetujuan dokumen
        $roleId = $this->session->userdata('user')->Role_ID;
        $data['dokumens'] = $this->persetujuan_model->get_dokumen_menunggu_persetujuan_Id($roleId);
        $this->load->view('form_persetujuan', $data);
    }

    public function approved_document($dokumen_id)
    {
        // Lakukan persetujuan dokumen
        $this->persetujuan_model->approve_dokumen($dokumen_id);

        // Redirect ke halaman persetujuan dengan pesan sukses
        redirect('persetujuan');
    }
}
