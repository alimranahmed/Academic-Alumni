<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("m_common");
    }

    function index()
    {
        //If user is not already logged in
        if(!$this->session->userdata("user_id"))
        {
            $data['departments'] = $this->m_common->getAllRows('department');
            $data['programs'] = $this->m_common->getAllRows('program');
            $this->load->view("v_login", $data);
        }
        else
        {
            redirect(site_url("home"));
        }
    }
    function login()
    {
        //When login credentials are submitted
        if($this->input->post())
        {
            //Check login form if no data is inputed
            $validationRules = array(
                array("field" => "email","rules" => "trim|required"),
                array("field" => "password","rules" => "required"),
            );

            $this->form_validation->set_rules($validationRules);

            $email = $this->input->post("email");
            $password = md5($this->input->post("password"));

            $user = $this->m_common->checkCredentials($email, $password);

            //var_dump($user);
            //when login button pressed without inputting field
            if(!$this->form_validation->run())
            {
                $data["loginErrors"] = "Login fields must be filled up";
                $this->load->view("v_login",$data);
            }
            // when username and password matched and active
            else if($user && $user->status == "1")
            {
                $this->session->set_userdata("user_id", $user->id);
                $this->session->set_userdata("user_role", $user->role);
                $this->session->set_userdata("department_id", $user->department_id);
                redirect(base_url());//Load the dashboard for the user
            }
            else//when username and password is not matched
            {
                $data["loginErrors"] = "Sorry, we cannot recognize you";
                $this->load->view("v_login",$data);
            }
        }
        else
        {
            redirect(base_url());
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */