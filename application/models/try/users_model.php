<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load database
        $this->load->database();
    }
    public function getUsersWithRoles()
    {
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->join('roles', 'roles.ID = pengguna.Role_ID');
        $query = $this->db->get();
        return $query->result();
    }
    public function getUsers()
    {
        // ambil semua user kecuali admin
        $this->db->where('User_Type !=', 'Admin');
        $query = $this->db->get('pengguna');
        return $query->result();
    }

    public function register_user($data)
    {
        // Simpan data pengguna baru ke tabel Pengguna
        $this->db->insert('pengguna', $data);
    }

    public function set_user_role($user_id, $role_id)
    {
        // Atur roles pengguna oleh admin
        $data = array('Role_ID' => $role_id);
        $this->db->where('ID', $user_id)
            ->update('pengguna', $data);
    }

    public function authenticate($username, $password)
    {
        // Pilih baris dengan username yang sesuai
        $query = $this->db->get_where('pengguna', ['Username' => $username]);

        // Jika ada baris dengan username yang sesuai
        if ($query->num_rows() > 0) {
            $user = $query->row();

            // Verifikasi password menggunakan password_verify
            if (password_verify($password, $user->Password)) {
                return $user;
            }
        }

        // Username atau password salah
        return null;
    }

    public function getUserByID($id)
    {
        $this->db->where('ID', $id);
        $query = $this->db->get('pengguna');
        return $query->row();
    }

    public function editUserByID($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('pengguna', $data);
    }
}
