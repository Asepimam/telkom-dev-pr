<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function get_roles()
    {
        $query = $this->db->get('roles');
        return $query->result();
    }
    public function get_roles_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('roles');
        return $query->row();
    }
}
