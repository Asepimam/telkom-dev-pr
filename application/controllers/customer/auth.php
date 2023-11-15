<?php

class Auth extends CI_Controller
{

    /**
     * login
     * Deskripsi: Menangani proses login pengguna.
     * Jika data login benar, akan mengalihkan pengguna ke halaman sesuai peran (role) mereka (admin/customer).
     * Jika data login salah, pengguna akan tetap berada di halaman login dengan pesan kesalahan.
     * Revisi : Perubahan kode yaitu menambahkan kode break; pada switch case
     */
    public function login()
    {
        // Memvalidasi form input login
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form login
            $this->load->view('templates/header');
            $this->load->view('auth/auth');
        } else {
            // Jika validasi sukses, cek login dan arahkan ke halaman dashboard sesuai peran pengguna
            $username               = $this->input->post('username');
            $password               = md5($this->input->post('password'));

            $cek = $this->user_model->cek_login($username, $password);

            // Cek apakah akun tersebut tersedia atau tidak
            if ($cek == FALSE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Username atau Password Salah!.

                    </div>');
                redirect('auth/login');
            } else {
                if ($cek->status != 'Aktif') {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Akun tidak aktif! Harap hubungi administrator.
                    </div>');
                    redirect('auth/login');
                }

                $this->session->set_userdata('username', $cek->username);
                $this->session->set_userdata('id_user', $cek->id_user);
                $this->session->set_userdata('role_id', $cek->role_id);
                $this->session->set_userdata('nama_depan', $cek->nama_depan);

                // Cek role id, jika 1 maka akan masuk sebagai admin, jika 2 maka akan masuk sebagai customer
                switch ($cek->role_id) {
                    case 1:
                        redirect('admin/dashboard');
                        break; // break ditambahkan untuk menghentikan proses pengecekan kondisi selanjutnya
                    case 2:
                        redirect('customer/dashboard');
                        break; // break ditambahkan untuk menghentikan proses pengecekan kondisi selanjutnya
                    default:
                        break; // break ditambahkan untuk menghentikan proses pengecekan kondisi selanjutnya / loop
                }
            }
        }
    }

    /**
     * _rules
     * 
     * Deskripsi: Menetapkan aturan validasi untuk data login (username dan password).
     */
    public function _rules()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }

    /**
     * logout
     * 
     * Deskripsi: Menangani proses logout pengguna dan menghancurkan data session.
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    // function handle create new customer/user
    public function register()
    {
        // Validasi input pengguna berdasarkan aturan yang ditentukan dalam fungsi _rules()
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan tampilan form login dengan template header dan footer
            $this->load->view('templates_admin/header');
            $this->load->view('auth/form_register');
            $this->load->view('templates_admin/footer');
        } else {

            // Jika validasi berhasil, ambil input pengguna dan masukkan data ke tabel "customer"
            $nama_depan                   = $this->input->post('nama_depan');
            $nama_belakang                 = $this->input->post('nama_belakang');
            $username               = $this->input->post('username');
            $email                 = $this->input->post('email');
            $unit                 = $this->input->post('unit');
            $password               = md5($this->input->post('password'));
            $role_id                = $this->input->post('role_id');
            $status                = 'Aktif';
            $image                = 'default.jpg';

            $data = array(
                'nama_depan'          => $nama_depan,
                'nama_belakang'      => $nama_belakang,
                'username'        => $username,
                'email'         => $email,
                'unit'          => $unit,
                'password'      => $password,
                'role_id'       => $role_id,
                'status'       => $status,
                'image'       => $image
            );

            // Masukkan data ke tabel "customer" menggunakan model "user_model"
            $this->user_model->insert_data($data, 'customer');

            // Set pesan berhasil menggunakan session flashdata
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil Register Silahkan Login!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            // Alihkan ke halaman login setelah registrasi berhasil
            redirect('auth/login');
        }
    }

    // function rules of register function
    public function _rulesReqister()
    {
        $this->form_validation->set_rules('nama_depan', 'Nama depan', 'required');
        $this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('unit', 'unit', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }
}
