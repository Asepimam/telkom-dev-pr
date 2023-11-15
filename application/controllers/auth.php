<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model Pengguna_model.php
        $this->load->model('try/users_model');
        $this->load->view('templates/header');
        $this->load->view('auth/auth');
    }

    public function register()
    {

        $data = array(
            'Nama_Depan' => $this->input->post('nama_depan'),
            'Nama_Belakang' => $this->input->post('nama_belakang'),
            'Email' => $this->input->post('email'),
            'Password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'Username' => $this->input->post('username'),
            // ... tambahkan kolom lainnya sesuai kebutuhan
        );


        // Simpan pengguna baru ke database menggunakan model
        $this->users_model->register_user($data);

        // Redirect ke halaman login dengan pesan sukses
        redirect('auth/login');
    }

    public function login()
    {
        $this->load->library('form_validation');

        // Set aturan validasi sesuai kebutuhan Anda
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login
            $this->load->view('templates/header');
            $this->load->view('auth/auth');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->users_model->authenticate($username, $password);

            if ($user !== null) {

                $this->session->set_userdata('user', $user);

                if ($user->User_Type === 'Admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('customer/dashboard');
                }
            } else {
                // Verifikasi gagal, gunakan flashdata untuk memberitahu user bahwa username atau password salah
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username atau Password Salah!.</div>');
                redirect('auth/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('auth/login');
    }
}
