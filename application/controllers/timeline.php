<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_common");
        $this->load->model("m_network");
        $this->load->model("m_post");
    }
    function index()
    {
        $userId = $this->session->userdata("user_id");
        $data['user'] = $this->m_common->getGlobalUserInfo($userId);
        $data['active_link'] = 'timeline';
        $data['posts'] = $this->m_post->getPostByUser($this->session->userdata("user_id"));
        $i = 0;
        foreach ($data['posts'] as $post)
        {
            $data['posts'][$i++]->comments = $this->m_post->getCommentsByPost($post->id);
        }
        $data['friends'] = $this->m_network->getFriendList($userId);
        $data['requests'] = $this->m_common->getRequest($userId);
        $data['group'] = $this->m_common->getGroupByDepartment($this->session->userdata("department_id"));
        $this->load->view("header",$data);
        $this->load->view("v_timeline",$data);
        $this->load->view("footer",$data);
    }
    function insertPost()
    {
        if($this->input->post())
        {
            $newPost = array(
                'body' => htmlspecialchars($this->input->post("post")),
                'userId' => $this->session->userdata('user_id'),
            );
            $this->m_common->insert($newPost, "post");
        }
        redirect(site_url('timeline'));
    }
    function editPost($postId)
    {
        $postId = mysql_real_escape_string($postId);
        if($this->input->post())
        {
            $newPost = array(
                'body' => htmlspecialchars($this->input->post("post")),
                'userId' => $this->session->userdata('user_id'),
            );
            $this->m_common->update("post", $newPost, $postId);
        }
        redirect(site_url('timeline'));
    }
    function deletePost($postId)
    {
        $postId = mysql_real_escape_string($postId);
        $this->m_common->delete("post", $postId);
        redirect(site_url("timeline"));
    }
    function insertComment($postId)
    {
        $postId = mysql_real_escape_string($postId);
        if($this->input->post())
        {
            $newComment = array(
                'body' => htmlspecialchars($this->input->post("comment")),
                'userId' => $this->session->userdata('user_id'),
                'postId' => $postId,
            );
            $this->m_common->insert($newComment, "comment");
        }
        redirect(site_url('timeline'));
    }
    function editComment($commentId)
    {
        $commentId = mysql_real_escape_string($commentId);
        if($this->input->post())
        {
            $newComment = array(
                'body' => htmlspecialchars($this->input->post("comment")),
                'userId' => $this->session->userdata('user_id'),
            );
            $this->m_common->update("comment", $newComment, $commentId);
        }
        redirect(site_url('timeline'));
    }
    function deleteComment($commentId)
    {
        $commentId = mysql_real_escape_string($commentId);
        $this->m_common->delete("comment", $commentId);
        redirect(site_url("timeline"));
    }
}