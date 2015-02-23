<?php
/**
 * Created by PhpStorm.
 * User: Al- Imran Ahmed
 * Date: 1/14/2015
 * Time: 10:25 PM
 */

class M_post extends CI_Model{
    function getPostByUser($userId)
    {
        $this->db->select('post.*, user.firstName, user.lastName, user.photo');
        $this->db->where("post.userId", $userId);
        $this->db->from("post");
        $this->db->join("user", "post.userId = user.id");
        $this->db->order_by('post.time','DESC');
        return $this->db->get()->result();
    }
    function getPostByGroup($groupId)
    {
        $this->db->select('post.*, group.name as groupName, user.firstName, user.lastName, user.photo');
        $this->db->where("post.groupId", $groupId);
        $this->db->from("post");
        $this->db->join("user", "post.userId = user.id");
        $this->db->join("group", "post.groupId = group.id");
        $this->db->order_by('post.time','DESC');
        return $this->db->get()->result();
    }
    function getCommentsByPost($postId)
    {
        $this->db->select('comment.*, user.firstName, user.lastName, user.photo');
        $this->db->from("comment");
        $this->db->where("postId",$postId);
        $this->db->join("user", "comment.userId = user.id");
        $this->db->order_by('comment.time','ASC');
        return $this->db->get()->result();
    }

    function getAllFriends($userId)
    {
        $this->db->select();
        $this->db->from("friendship");
        $this->db->where("userId", $userId);
        return $this->db->get()->result();
    }

    function getAllPosts($userId, $allFriends)
    {
        $this->db->select("post.*,user.firstName,user.lastName,user.photo");
        $this->db->from("post");
        $this->db->where('userId', $userId);
        foreach($allFriends as $friend)
        {
            $this->db->or_where('userId', $friend->friendId);
        }
        $this->db->order_by("time","DESC");
        $this->db->join("user", "user.id = post.userId");
        return $this->db->get()->result();
    }
} 