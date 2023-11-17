<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ubahprofile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('try/users_model');
    }

    public function index()
    {
        $idUser = $this->session->userdata('user')->ID;
        $data['user'] = $this->users_model->getUserByIDWithUnits($idUser);
        $this->load->view('templates/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/ubahprofile', $data);
        $this->load->view('templates/footer');
    }
    public function update_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->session->userdata('user')->ID;

            // Data yang akan diperbarui
            $data = array(
                'Nama_Depan' => $this->input->post('nama_depan'),
                'Nama_Belakang' => $this->input->post('nama_belakang'),
            );

            if ($_FILES['image']['name']) { // Periksa apakah ada gambar yang diunggah
                // Konfigurasi upload gambar
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048; // Ukuran maksimal file dalam kilobita

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $upload_data = $this->upload->data();
                    $image = $upload_data['file_name'];

                    $data['Image'] = $image;
                }
            }

            $this->users_model->editUserByID($user_id, $data);

            // Redirect kembali ke halaman profil
            redirect('admin/profile');
        }
    }
}
