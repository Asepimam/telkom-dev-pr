<?php
class editdokumen extends CI_Controller
{

    public function index()
    {
        $this->load->model('user_model'); // Load the user_model

        // Ambil data customer dari tabel "customer" menggunakan model "user_model"
        $data['customer'] = $this->user_model->get_data('customer')->result();

        // Muat tampilan editdokumen dengan template header, sidebar, dan footer
        $this->load->view('templates_admin/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/editdokumen', $data);
        $this->load->view('templates_admin/footer');
    }


    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function delete_customer($id)
    {
        $where = array('id_user' => $id);

        // Hapus data customer dari tabel "customer" menggunakan model "user_model"
        $this->user_model->delete_data($where, 'customer');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data Customer Berhasil Dihapus!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('admin/qrcode');
    }
}
