<?php
class Search extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("m_network");
        $this->load->model("m_common");
        $userId = $this->session->userdata('user_id');
        if($userId == NULL)
        {
            redirect(site_url());
        }
    }
    function index()
    {
        $userId = $this->session->userdata("user_id");
        if($this->input->get())
        {
            $data['active_link'] = 'search';
            $friendShipObj = $this->m_network->getFriendsId($userId);
            $data['friendsId'] = array();
            foreach($friendShipObj as $friendShip)
            {
                array_push($data['friendsId'], $friendShip->friendId);
            }
            $data['user'] = $this->m_common->getGlobalUserInfo($userId);
            $searchText = $this->input->get("search");
            $data['requests'] = $this->m_common->getRequest($userId);
            $data['searchResults'] = $this->m_common->search($searchText);
            $this->load->view("header",$data);
            $this->load->view("v_search",$data);
            $this->load->view("footer",$data);
        }
        else
        {
            redirect(site_url());
        }

    }
}