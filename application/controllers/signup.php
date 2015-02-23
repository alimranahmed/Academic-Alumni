<?php
class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("m_common");
    }
    function index()
    {
        $data = array();
        if($this->input->post())
        {
            $validationRules = array(
                array('field'=>'first_name', 'label'=>'First Name', 'rules'=>'required'),
                array('field'=>'last_name', 'label'=>'Last Name', 'rules'=>'required'),
                array('field'=>'email', 'label'=>'Email', 'rules'=>'trim|valid_email|required|is_unique[user.email]'),
                array('field'=>'password', 'label'=>'Password', 'rules'=>'required|min_length[5]'),
                array("field"=>"password_conf", 'label'=>'Confirmation password', 'rules'=>'required|matches[password]'),
            );
            $this->form_validation->set_rules($validationRules);

            //When validation error
            if($this->form_validation->run())
            {
                $newUser = array(
                    "firstName" => $this->input->post("first_name"),
                    "lastName" => $this->input->post("last_name"),
                    "email" => $this->input->post("email"),
                    "batch_id" => $this->input->post("batch_id"),
                    "department_id" => $this->input->post("department_id"),
                    "student_id" => $this->input->post("student_id"),
                    "program" => $this->input->post("program"),
                    "password" => md5($this->input->post("password")),
                    "status" => 1,
                    "role" => "user",
                );
                $this->m_common->insert($newUser, "user");
                $data["registerSuccess"] = "Congratulation! You have registered successfully!";
            }
            else{
                $data["validationErrors"] = validation_errors();
            }

            $this->load->view("v_login",$data);
        }
        else
        {
            redirect(base_url());
        }
    }
}