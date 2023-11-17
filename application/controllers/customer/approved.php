<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approved extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('try/alur_persetujuan');
        $this->load->model('try/documents_model');
        $this->load->model('try/persetujuan_model');
    }

    public function index()
    {
        $this->load->view('templates/header');

        $this->load->view('templates/footer');
        $this->load->view('templates/customer/sidebar');
        $user_role = $this->session->userdata('user')->Role_ID;
        $alurs = $this->alur_persetujuan->getAll();
        $matchingAlurIds = array();
        foreach ($alurs as $alur) {
            $jsonString = $alur->distribusi;
            $dataArray = json_decode($jsonString, true);
            $rolesArray = $dataArray['roles'];
            foreach ($rolesArray as $nilai) {
                if ($user_role == $nilai) {
                    $matchingAlurIds[] = $alur->id;
                    break;
                }
            }
        };
        $documents = array();
        foreach ($matchingAlurIds as $id) {
            $documents = array_merge($documents, $this->documents_model->getDocumetBytujuan_id($id));
        }
        $data['documents'] = $documents;
        $this->load->view('customer/document-approve', $data);


        // Lakukan sesuatu dengan $documents, misalnya kirim ke view
    }

    public function approved_document($dokumen_id)
    {
        $this->load->view('templates/header');
        $this->load->view('templates/footer');
        $this->load->view('templates/customer/sidebar');

        $data['dokumen'] = $this->documents_model->get_document_by_id($dokumen_id);
        $this->load->view('customer/form_approve', $data);
        // // Lakukan persetujuan dokumen
        //
    }
    public function approved_document_id()
    {
        $dokumen_id = $this->input->post('id');
        $data = array(
            'Dokumen_ID' => $this->input->post('id'),
            'Pemberi_Persetujuan_ID' => $this->session->userdata('user')->Role_ID,
            'Status' => $this->input->post('status'),
            'Catatan' => $this->input->post('catatan'),
        );
        $log_data = array(
            'dokumen_id' => $this->input->post('id'),
            'Aktivitas' => 'Persetujuan dokumen disetujui',
            'Pengguna_ID' => $this->session->userdata('user')->ID,
            'role_review' => $this->session->userdata('user')->Role_ID // Gantilah sesuai dengan metode autentikasi yang sesuai
        );
        $this->persetujuan_model->approve_dokumen($dokumen_id);
        $this->persetujuan_model->approve_log_persetujuan($data, $log_data);

        // // Redirect ke halaman persetujuan dengan pesan sukses
        redirect('customer/approved');
    }
}
