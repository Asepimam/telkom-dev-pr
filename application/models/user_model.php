<?php 

class user_model extends CI_model
{
    
    /**
     * Fungsi get_data
     * Deskripsi: Mengambil seluruh data dari tabel yang ditentukan.
     * Parameter:
     * - $table (string): Nama tabel yang akan diambil datanya.
     * Return: Hasil dari query berupa seluruh data dalam tabel.
     */
    public function get_data($table)
    {
        return $this->db->get($table);
    }
    public function get_edituser()
    {
        $this->db->select('customer.nama_depan, transaksi.*');
        $this->db->from('transaksi');
        $this->db->join('customer', 'transaksi.id_user = customer.id_user', 'left');
        return $this->db->get()->result();
    }
    /**
     * Fungsi get_where
     * Deskripsi: Mengambil data dari tabel yang memenuhi kondisi tertentu (WHERE).
     * Parameter:
     * - $where (array): Kondisi untuk mengambil data.
     * - $table (string): Nama tabel yang akan diambil datanya.
     * Return: Hasil dari query berupa data yang memenuhi kondisi dari tabel.
     * 
     */
    public function get_where($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    
    /**
     * Fungsi insert_data
     * Deskripsi: Menyisipkan data baru ke dalam tabel.
     * Parameter:
     * - $data (array): Data yang akan disisipkan ke dalam tabel.
     * - $table (string): Nama tabel tujuan penyisipan data.
     * 
     */
    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    
    
    /**
     * Fungsi delete_data
     * Deskripsi: Menghapus data dari tabel berdasarkan kondisi tertentu (WHERE).
     * Parameter:
     * - $where (array): Kondisi untuk memilih data yang akan dihapus.
     * - $table (string): Nama tabel yang akan dihapus datanya.
     * 
     */
    
     public function delete_data($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }

      
      /**
       * Fungsi cek_login
       * Deskripsi: Memverifikasi login customer berdasarkan username dan password.
       * Parameter: Tidak ada (menggunakan data dari set_value).
       * Return: Jika login berhasil, fungsi ini mengembalikan data customer dari tabel 'customer'.
       *         Jika login gagal, fungsi ini mengembalikan FALSE.
       * 
       */
      public function cek_login()
    {
        $username   = set_value('username');
        $password   = set_value('password');

        $result = $this->db
                        ->where('username', $username)
                        ->where('password', md5($password))
                        ->limit(1)
                        ->get('customer');
        
        if ($result->num_rows() > 0)
        {
            return $result->row();
        }else{
            return FALSE;
        }
    }
    
    /**
     * Fungsi update_password
     * Deskripsi: Memperbarui password customer berdasarkan kondisi tertentu (WHERE).
     * Parameter:
     * - $where (array): Kondisi untuk memilih data customer yang akan diperbarui passwordnya.
     * - $data (array): Data password baru.
     * - $table (string): Nama tabel yang akan diperbarui data passwordnya.
     * 
     */
    public function update_password($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    // Fungsi untuk mendownload data pembayaran berdasarkan id_rental
    public function get_document_by_id($id_dokumen)
    {
        $query = $this->db->get_where('transaksi',array('id_dokumen' => $id_dokumen));
        return $query->row_array();
    }
    public function get_user_info() {
        $user_id = $this->session->userdata('id_user'); // Assuming you store the user's ID in the session
        return $this->db->get_where('customer', array('id_user' => $user_id))->row_array();
    }

    public function update_user_profile($user_id, $data) {
        $this->db->where('id_user', $user_id);
        $this->db->update('customer', $data);
    }
    public function get_qrcode($id_dokumen)
    {
        $this->db->select('qrcode');
        $this->db->where('id_dokumen', $id_dokumen);
        $query = $this->db->get('transaksi');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->qrcode;
        }
    
        return null;
    }
    
    public function update_qrcode($id_dokumen, $qrcodePath) {
        $data = array('qrcode' => $qrcodePath);
        $this->db->where('id_dokumen', $id_dokumen);
        $this->db->update('transaksi', $data);
    }
    public function update_status($userId, $data)
{
    $this->db->where('id_user', $userId);
    $this->db->update('customer', $data);
}

    
    
    
}

?>