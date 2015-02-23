<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_common");
        $this->load->model("m_network");
    }
    function index()
    {
        $this->show($this->session->userdata("user_id"));
    }
    function show($userId)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $friendShipObj = $this->m_network->getFriendsId($this->session->userdata("user_id"));
        $data['friendsId'] = array();
        foreach($friendShipObj as $friendShip)
        {
            array_push($data['friendsId'], $friendShip->friendId);
        }
        $data['requests'] = $this->m_common->getRequest($this->session->userdata("user_id"));
        $data['user'] = $this->m_common->getGlobalUserInfo($userId);
        $data['active_link'] = 'profile';
        $data['projects'] = $this->m_common->getProjectByUser($userId);
        $data['careers'] = $this->m_common->getCareerByUser($userId);
        $data['educations'] = $this->m_common->getEducationByUser($userId);
        $data['programs'] = $this->m_common->getAllRows("program");
        $this->load->view("header",$data);
        $this->load->view("v_profile",$data);
        $this->load->view("footer",$data);
    }
    function updateAbout()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $about = array(
                "about" => nl2br(htmlspecialchars($this->input->post("about"))),
            );
            $this->m_common->update("user", $about, $userId);
        }
        redirect(base_url()."profile");
    }
    function updateSkills()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $skills = array(
                "skills" => nl2br(htmlspecialchars($this->input->post("skills"))),
            );
            $this->m_common->update("user", $skills, $userId);
        }
        redirect(base_url()."profile");
    }

    function insertEducation()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $newEducation = array(
                "userId" => $userId,
                "exam" => htmlspecialchars($this->input->post("exam")),
                "department" => htmlspecialchars($this->input->post("department")),
                "institute" => htmlspecialchars($this->input->post("institute")),
                "cgpa" => htmlspecialchars($this->input->post("cgpa")),
                "passingYear" => htmlspecialchars($this->input->post("year")),
            );
            $this->m_common->insert($newEducation, "educational_qualification");
        }
        redirect(base_url()."profile");
    }

    function updateEducation($id)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $newEducation = array(
                "exam" => htmlspecialchars($this->input->post("exam")),
                "department" => htmlspecialchars($this->input->post("department")),
                "institute" => htmlspecialchars($this->input->post("institute")),
                "cgpa" => htmlspecialchars($this->input->post("cgpa")),
                "passingYear" => htmlspecialchars($this->input->post("year")),
            );
            $this->m_common->update("educational_qualification", $newEducation, $id);
        }
        redirect(base_url()."profile");
    }

    function insertProject()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $newProject = array(
                "userId" => $userId,
                "title" => htmlspecialchars($this->input->post("title")),
                "description" => nl2br(htmlspecialchars($this->input->post("description"))),
                "link" => nl2br(htmlspecialchars($this->input->post("link"))),
                "groupMember" => nl2br(htmlspecialchars($this->input->post("members"))),
            );
            $this->m_common->insert($newProject,"project");
        }
        redirect(base_url()."profile");
    }
    function updateProject($projectId)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $updatedProject = array(
                "title" => htmlspecialchars($this->input->post("title")),
                "description" => nl2br(htmlspecialchars($this->input->post("description"))),
                "link" => nl2br(htmlspecialchars($this->input->post("link"))),
                "groupMember" => nl2br(htmlspecialchars($this->input->post("members"))),
            );
            $this->m_common->update("project",$updatedProject, $projectId);
        }
        redirect(base_url()."profile");
    }
    function deleteProject($projectId)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        $this->m_common->delete("project",$projectId);
        redirect(site_url('profile'));
    }

    function insertCareer()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $newCareer = array(
                "userId" => $userId,
                "companyName" => htmlspecialchars($this->input->post("companyName")),
                "designation" => nl2br(htmlspecialchars($this->input->post("designation"))),
                "description" => nl2br(htmlspecialchars($this->input->post("responsibilities"))),
                "duration" => nl2br(htmlspecialchars($this->input->post("duration"))),
                "status" => nl2br(htmlspecialchars($this->input->post("status"))),
            );
            $this->m_common->insert($newCareer,"career");
        }
        redirect(base_url()."profile");
    }
    function deleteCareer($careerId)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        $this->m_common->delete("career",$careerId);
        redirect(site_url('profile'));
    }

    function updateCareer($careerId)
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $updatedCareer = array(
                "companyName" => htmlspecialchars($this->input->post("companyName")),
                "designation" => nl2br(htmlspecialchars($this->input->post("designation"))),
                "description" => nl2br(htmlspecialchars($this->input->post("responsibilities"))),
                "duration" => nl2br(htmlspecialchars($this->input->post("duration"))),
                "status" => nl2br(htmlspecialchars($this->input->post("status"))),
            );
            $this->m_common->update("career",$updatedCareer,$careerId);
        }
        redirect(base_url()."profile");
    }

    function updateInfo()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");
        if($this->input->post())
        {
            $newInfo = array(
                "firstName" => htmlspecialchars($this->input->post("firstName")),
                "lastName" => htmlspecialchars($this->input->post("lastName")),
                "fatherName" => htmlspecialchars($this->input->post("fatherName")),
                "motherName" => htmlspecialchars($this->input->post("motherName")),
                "email" => htmlspecialchars($this->input->post("email")),
                "phone" => htmlspecialchars($this->input->post("phone")),
                "gender" => htmlspecialchars($this->input->post("gender")),
                "birthday" => $this->input->post("dob"),
                "country" => htmlspecialchars($this->input->post("country")),
                "religion" => htmlspecialchars($this->input->post("religion")),
                "maritalStatus" => htmlspecialchars($this->input->post("maritalStatus")),
                "address" => htmlspecialchars($this->input->post("address")),
            );
            $this->m_common->update("user", $newInfo, $userId);
        }
        redirect(base_url()."profile");
    }
    function updatePhoto()
    {
        if(!$this->session->userdata("user_id")){redirect(base_url());}

        $userId = $this->session->userdata("user_id");

        $logoPath = "";
        $data = array();
        $config['upload_path'] = './public/images/users';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $userId;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '10048';
        $config['max_width']  = '10024';
        $config['max_height']  = '10024';

        $this->load->library('upload', $config);

        if($_FILES)
        {

            if ( ! $this->upload->do_upload("photo"))
            {
                $error = array('error' => $this->upload->display_errors());
                $data['uploadError'] = TRUE;
                //var_dump($error);
                //echo 'there was error';
                //$this->load->view('upload_form', $error);
            }
            else
            {
                //echo "uploaded successfull!";
                $upload_data = $this->upload->data();
                //var_dump($upload_data);
                $logoPath = "public/images/users/" . $upload_data['file_name'];
                $newPhoto = array(
                    "photo" => $logoPath
                );
                $this->m_common->update("user", $newPhoto, $userId);
            }

            //echo "inserted successfully";
        }
        redirect(base_url("profile"));

    }
}
