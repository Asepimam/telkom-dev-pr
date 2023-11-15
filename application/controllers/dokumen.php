<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model Dokumen_model.php dan Roles_model.php
        $this->load->model('Dokumen_model');
        $this->load->model('Roles_model');
    }

    public function submit_form()
    {
        // Ambil data formulir dari POST
        $data = array(
            'Judul' => $this->input->post('judul'),
            'Deskripsi' => $this->input->post('deskripsi'),
            'Pengaju_ID' => $this->session->userdata('user_id'),
            'Role_Tujuan_ID' => $this->input->post('role_tujuan_id'), // Ambil ID role tujuan dari formulir
            'Tanggal_Pengajuan' => date('Y-m-d'),
            'Status' => 'Pengajuan Baru'
        );

        // Simpan data ke database menggunakan model
        $this->Dokumen_model->submit_dokumen($data);

        // Redirect ke halaman pengajuan dengan pesan sukses
        redirect('dokumen');
    }

    public function form_pengajuan()
    {
        // Ambil daftar roles dari model Roles_model.php
        $data['roles'] = $this->Roles_model->get_roles();

        // Tampilkan formulir pengajuan dengan daftar roles
        $this->load->view('form_pengajuan', $data);
    }
}
