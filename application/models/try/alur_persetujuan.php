<?php
class Alur_persetujuan extends CI_Model
{
    public function insert($data)
    {
        $this->db->insert('alur_persetujuan', $data);
    }
    public function getAlurByUnitRole($role_id)
    {
        $this->db->where('role_id', $role_id);
        $query = $this->db->get('alur_persetujuan');
        return $query->row();
    }
    // get all
    public function getAll()
    {
        return $this->db->get('alur_persetujuan')->result();
    }
}
