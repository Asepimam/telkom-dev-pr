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

    public function get_log_aktivitas()
    {
        // Ambil data log aktivitas
        $query = $this->db->order_by('Waktu', 'DESC')
            ->get('log_aktivitas');
        return $query->result();
    }
}
