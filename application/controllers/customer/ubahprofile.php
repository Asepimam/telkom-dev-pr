<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ubahprofile extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->user_model->get_user_info(); // Fetch the user's data
        $this->load->view('templates/header');
        $this->load->view('templates/customer/sidebar');
        $this->load->view('customer/ubahprofile', $data);
        $this->load->view('templates/footer');
    }
    public function update_profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->session->userdata('id_user');

            // Data yang akan diperbarui
            $data = array(
                'username' => $this->input->post('username'),
                'nama_depan' => $this->input->post('nama_depan'),
                'nama_belakang' => $this->input->post('nama_belakang'),
                'email' => $this->input->post('email')
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

                    $data['image'] = $image;
                }
            }

            $this->user_model->update_user_profile($user_id, $data);

            // Redirect kembali ke halaman profil
            redirect('admin/profile');
        }
    }
}
