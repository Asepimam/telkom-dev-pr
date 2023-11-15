<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function submit_dokumen($data)
    {
        // Simpan data ke tabel Dokumen
        $this->db->insert('dokumen', $data);
    }
    public function get_dokumen()
    {
        $query = $this->db->get('dokumen');
        return $query->result();
    }
    public function get_document_with_pengguna_and_tujuan()
    {
        $this->db->select('*');
        $this->db->from('dokumen');
        $this->db->join('pengguna', 'pengguna.ID = dokumen.Pengaju_ID');
        $this->db->join('roles', 'roles.ID = dokumen.Role_Tujuan_ID');
        $query = $this->db->get();
        return $query->result();
    }
    public function delete_document_by_id($document_id)
    {
        $this->db->where('ID_Doc', $document_id);
        $this->db->delete('dokumen');

        return $this->db->affected_rows();
    }
    public function insert_document($data)
    {
        $this->db->insert('dokumen', $data);
    }

    public function get_document_by_pengguna($pengguna_id)
    {
        $this->db->select('*');
        $this->db->from('dokumen');
        $this->db->join('pengguna', 'pengguna.ID = dokumen.Pengaju_ID');
        $this->db->join('roles', 'roles.ID = dokumen.Role_Tujuan_ID');
        $this->db->where('dokumen.Pengaju_ID', $pengguna_id);
        $query = $this->db->get();
        return $query->result();
    }
}
