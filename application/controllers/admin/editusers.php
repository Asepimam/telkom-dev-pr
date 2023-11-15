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
        $data['user'] = $this->users_model->getUsersWithRoles();

        $this->load->view('templates/admin/sidebar');
        $this->load->view('templates/header');
        $this->load->view('admin/edituser', $data);
        $this->load->view('templates/footer');
    }
    public function getUnitData()
    {
        $roles = $this->roles->get_roles();
        echo json_encode($roles);
    }
    public function editUser($id)
    {
        $data = $this->input->post(); // Ambil data dari POST request, sesuaikan dengan kebutuhan

        // Call the model to update the user by ID
        $this->your_model_name->editUserByID($id, $data); // Ganti 'your_model_name' dengan nama model yang sesuai

        // Redirect or return a response as needed
        redirect('your_controller/index');
    }
}
