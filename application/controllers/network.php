<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Network extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_common");
        $this->load->model("m_network");
    }
    function index()
    {
        $userId = $this->session->userdata("user_id");
        $data['active_link'] = 'network';
        $data['user'] = $this->m_common->getGlobalUserInfo($userId);
        $data['requests'] = $this->m_common->getRequest($userId);
        $data['friends'] = $this->m_network->getFriendList($userId);
        $this->load->view("header",$data);
        $this->load->view("v_network",$data);
        $this->load->view("footer",$data);
    }
    function sendRequest($receiverId)
    {
        $data['user'] = $this->m_common->getGlobalUserInfo($this->session->userdata("user_id"));
        $hasRequest = $this->m_common->checkRequest( $this->session->userdata("user_id"), $receiverId);
        $hasFriendShip = $this->m_common->checkFriendship($this->session->userdata("user_id"), $receiverId);
       // echo $receiverId;
        //var_dump($hasRequest);
        if(!$hasRequest && !$hasFriendShip)
        {
            $newRequest = array(
                'senderId' => $this->session->userdata("user_id"),
                'receiverId' => $receiverId,
                'status' => 'pending',
            );

            $this->m_common->insert($newRequest,'friendrequest');
        }
        redirect(site_url());
    }
    function setRequest()
    {
        if($this->input->get())
        {
            $userId = $this->session->userdata("user_id");
            $senderId = $this->input->get("sender");
            $statusValue = $this->input->get("status");

            $requestAccepted = $this->m_network->setRequest($userId, $senderId, $statusValue);
            if($statusValue == 'accepted' && $requestAccepted) {
                if (!$this->m_network->hasFriendship()) {
                    $newFriendShip = array(
                        'userId' => $senderId,
                        'friendId' => $userId,
                    );
                    $this->m_common->insert($newFriendShip, "friendship");

                    $newFriendShip = array(
                        'friendId' => $senderId,
                        'userId' => $userId,
                    );
                    $this->m_common->insert($newFriendShip, "friendship");
                }
            }
        }
        redirect(site_url("network"));
    }
}
