<?php
/**
 * Created by PhpStorm.
 * User: Al- Imran Ahmed
 * Date: 1/12/2015
 * Time: 7:17 PM
 */

class M_network extends CI_Model{

    function setRequest($receiver, $sender, $status)
    {
        $this->db->where("receiverId", $receiver);
        $this->db->where("senderId", $sender);
        $this->db->update("friendrequest", array("status"=>$status));
        return $this->db->affected_rows();
    }
    function getFriendList($userId)
    {
        $this->db->select("user.*");
        $this->db->from("friendship");
        $this->db->where("friendship.userId",$userId);
        $this->db->join("user","user.id=friendship.friendId");
        return $this->db->get()->result();
    }
    function getFriendsId($userId)
    {
        $this->db->select('friendId');
        $this->db->from("friendship");
        $this->db->where("friendship.userId",$userId);
        return $this->db->get()->result();
    }
    function hasFriendship($userId, $friendId)
    {
        $this->db->select();
        $this->db->from("friendship");
        $this->db->where("friendship.userId", $userId);
        $this->db->where("friendship.friendId", $friendId);
        return $this->db->get()->row();
    }
}