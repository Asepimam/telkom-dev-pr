<?php
class editusers extends CI_Controller
{
    // buat contruncter 
    public function __construct()
    {
        parent::__construct();
        // Load the user_model
        $this->load->model('try/users_model'); // Load the user_model
        $this->load->model('try/roles');
    }

    public function index()
    {
        $data['user'] = $this->users_model->getall();

        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/header');
        $this->load->view('admin/users', $data);
        $this->load->view('templates/footer');
    }
    public function getUnitData()
    {
        $roles = $this->roles->get_roles();
        echo json_encode($roles);
    }
    public function editUser($id)
    {
        $data = array(
            'Nama_Depan' => $this->input->post('namadepan'),
            'Nama_Belakang' => $this->input->post('namabelakang'),
            'Email' => $this->input->post('email'),
            'User_Type' => $this->input->post('usertype'),
            'Role_ID' => $this->input->post('role'),
            'Username' => $this->input->post('nama'),
            'activate' => $this->input->post('activate'),
            'Unit_ID' => $this->input->post('unit')
        );


        // Call the model to update the user by ID
        $this->users_model->editUserByID($id, $data); // Ganti 'your_model_name' dengan nama model yang sesuai

        // Redirect or return a response as needed
        redirect('admin/editusers');
    }
    public function getuseredit($id)
    {
        $data['user'] = $this->users_model->get_user_with_roles_units_by_id($id);
        $data['roles'] = $this->roles->get_roles();
        $data['units'] = $this->users_model->get_units();
        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/header');
        $this->load->view('admin/edituser', $data);
    }
}
