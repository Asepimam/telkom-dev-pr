<?php


class dokumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('try/documents_model');
        $this->load->model('try/roles');
        $this->load->view('templates/header');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/footer');
    }
    public function index()
    {
        $userId = $this->session->userdata('user')->ID;
        // Menggunakan model untuk mengambil data transaksi dengan JOIN ke tabel customer
        $data['dokumens'] = $this->documents_model->get_document_with_pengguna_and_tujuan();

        // Muat tampilan dokumen dengan template header dan footer


        $this->load->view('admin/editdokumen', $data);
    }

    public function delete_document($document_id)
    {
        $this->documents_model->delete_document_by_id($document_id);
        echo "Dokumen dengan ID $document_id telah dihapus.";
        redirect('customer/dokumen');
    }

    public function upload()
    {
        $data['roles'] = $this->roles->get_roles();
        $this->load->view('customer/transaksi', $data);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $to = $this->input->post('to');
            $subject = $this->input->post('subject');



            $data = array(
                'Pengaju_ID' => $this->session->userdata('user')->ID,
                'Role_Tujuan_ID' => $to,
                'Deskripsi' => $subject,
            );

            // Upload Dokumen
            $config['upload_path'] = './assets/upload/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png'; // Batasan jenis file
            $config['max_size'] = 10240; // Batasan ukuran file (10MB)

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('dokumen')) {
                $upload_data = $this->upload->data();
                $data['document'] = $upload_data['file_name'];


                $this->documents_model->insert_document(
                    $data
                );


                redirect('customer/dokumen/upload');
            } else {

                $error = $this->upload->display_errors();


                $this->session->set_flashdata(
                    'message',
                    // buat menjadi sebuah alert message yang muncul di atas
                    // '<div class="alert alert-danger" role="alert">' . $error . '</div>'
                );
            }
        }
    }
}
