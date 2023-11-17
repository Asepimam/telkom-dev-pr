<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_Aktivitas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function get_log_aktivitas($id)
    {
        // Ambil data log aktivitas
        $query = $this->db->order_by('Waktu', 'DESC')
            ->join('pengguna', 'pengguna.ID = log_aktivitas.Pengguna_ID')
            ->join('roles', 'roles.ID_Role = log_aktivitas.role_review')
            ->where('log_aktivitas.dokumen_id', $id)
            ->get('log_aktivitas');
        return $query->result();
    }
}
