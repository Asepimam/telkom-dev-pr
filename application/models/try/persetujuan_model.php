<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persetujuan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function get_dokumen_menunggu_persetujuan_Id($id)
    {
        // Ambil dokumen yang menunggu persetujuan
        $query = $this->db->where('Status', 'Pengajuan Baru')
            ->where('Role_Tujuan_ID', $id)
            ->join('pengguna', 'pengguna.ID = dokumen.Pengaju_ID')
            ->get('dokumen');
        return $query->result();
    }

    public function approve_dokumen($dokumen_id)
    {
        // Ubah status dokumen menjadi "Disetujui"
        $data = array('Status' => 'Disetujui');
        $this->db->where('ID_Doc', $dokumen_id)
            ->update('dokumen', $data);

        // Catat log aktivitas
        $log_data = array(
            'Aktivitas' => 'Persetujuan dokumen disetujui: ID ' . $dokumen_id,
            'Pengguna_ID' => $this->session->userdata('user_id') // Gantilah sesuai dengan metode autentikasi yang sesuai
        );
        $this->db->insert('log_aktivitas', $log_data);
    }
}
