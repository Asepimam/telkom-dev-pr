<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persetujuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model Persetujuan_model.php
        $this->load->model('try/persetujuan_model');
    }

    public function index()
    {
        // Tampilkan halaman persetujuan dokumen
        $data['dokumen'] = $this->persetujuan_model->get_dokumen_menunggu_persetujuan();
        $this->load->view('form_persetujuan', $data);
    }

    public function approve($dokumen_id)
    {
        // Lakukan persetujuan dokumen
        $this->persetujuan_model->approve_dokumen($dokumen_id);

        // Redirect ke halaman persetujuan dengan pesan sukses
        redirect('persetujuan');
    }
}
