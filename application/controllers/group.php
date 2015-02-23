<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_common");
        $this->load->model("m_post");
    }
    function index()
    {
        $userId = $this->session->userdata("user_id");
        $data['user'] = $this->m_common->getGlobalUserInfo($userId);
        $data['active_link'] = 'timeline';
        $data['groupposts'] = $this->m_post->getPostByGroup($this->session->userdata("department_id"));
        $i = 0;
        foreach ($data['groupposts'] as $post)
        {
            $data['groupposts'][$i++]->comments = $this->m_post->getCommentsByPost($post->id);
        }
        $data['members'] = $this->m_common->getMembers($this->session->userdata("department_id"));
        $data['group'] = $this->m_common->getGroupInfo($this->session->userdata("department_id"));
        $data['requests'] = $this->m_common->getRequest($userId);
        $data['active_link'] = 'group';
        $data['user'] = $this->m_common->getGlobalUserInfo($userId);
        $this->load->view("header",$data);
        $this->load->view("v_group",$data);
        $this->load->view("footer",$data);
    }

    function insertPost()
    {
        if($this->input->post())
        {
            $newPost = array(
                'body' => htmlspecialchars($this->input->post("post")),
                'userId' => $this->session->userdata('user_id'),
                'groupId' => $this->session->userdata("department_id"),
            );
            $this->m_common->insert($newPost, "post");
        }
        redirect(site_url('group'));
    }
    function editPost($postId)
    {
        $postId = mysql_real_escape_string($postId);
        if($this->input->post())
        {
            $newPost = array(
                'body' => htmlspecialchars($this->input->post("post")),
                'userId' => $this->session->userdata('user_id'),
                'groupId' => $this->session->userdata('department_id'),
            );
            $this->m_common->update("post", $newPost, $postId);
        }
        redirect(site_url('group'));
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
        redirect(site_url('group'));
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
        redirect(site_url('group'));
    }
    function deleteComment($commentId)
    {
        $commentId = mysql_real_escape_string($commentId);
        $this->m_common->delete("comment", $commentId);
        redirect(site_url("group"));
    }
}
