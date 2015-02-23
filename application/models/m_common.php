<?php

class M_common extends CI_Model
{
    function checkCredentials($email, $password)
    {
        $this->db->select();
        $this->db->from("user");
        $this->db->where("user.email",$email);
        $this->db->where("user.password",$password);

        return $this->db->get()->row();
    }
    function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    function update($table, $data, $id)
    {
        $this->db->where("id",$id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    function delete($table, $id)
    {
        $this->db->where("id",$id)->delete($table);
        return $this->db->affected_rows();
    }
    function getGlobalUserInfo($id)
    {
        $this->db->select("user.*, program.name as program, department.name as department");
        $this->db->from("user");
        $this->db->where("user.id",$id);
        $this->db->join("program","user.program = program.id");
        $this->db->join("department","user.department_id = department.id");
        return $this->db->get()->row();
    }
    function getGroupInfo($departmentId)
    {
        $this->db->select('group.*');
        $this->db->from("group");
        $this->db->where("group.department", $departmentId);
        $this->db->join("department",'department.id = group.department');
        return $this->db->get()->row();
    }
    function getProjectByUser($userId)
    {
        $this->db->select()->from("project")->where("userId",$userId);
        return $this->db->get()->result();
    }
    function getCareerByUser($userId)
    {
        $this->db->select()->from("career")->where("userId",$userId);
        return $this->db->get()->result();
    }
    function getEducationByUser($userId)
    {
        $this->db->select()->from("educational_qualification")->where("userId",$userId);
        return $this->db->get()->result();
    }
    function getAllRows($table)
    {
        $this->db->select()->from($table);
        return $this->db->get()->result();
    }

    function search($searchText)
    {
        $this->db->select();
        $this->db->from("user");
        $this->db->like("user.firstName",$searchText);
        $this->db->or_like("user.lastName", $searchText);
        $this->db->or_like("user.universityId", $searchText);
        $this->db->or_like("user.maritalStatus", $searchText);
        $this->db->or_like("user.phone", $searchText);
        $this->db->or_like("user.religion", $searchText);
        $this->db->or_like("user.country", $searchText);
        return $this->db->get()->result();
    }

    function checkRequest($senderId, $receiverId)
    {
        $this->db->select();
        $this->db->from("friendrequest");
        $this->db->where("senderId", $senderId);
        $this->db->where("receiverId", $receiverId);
        return $this->db->get()->result();
    }
    function checkFriendship($userId, $friendId)
    {
        $this->db->select();
        $this->db->from("friendship");
        $this->db->where("userId", $userId);
        $this->db->where("friendId", $friendId);
        return $this->db->get()->result();
    }

    function getMembers($departmentId)
    {
        $this->db->select();
        $this->db->from("user");
        $this->db->where("department_id", $departmentId);
        return $this->db->get()->result();
    }
    function getRequest($id)
    {
        $this->db->select("friendrequest.id as request_id, user.*");
        $this->db->from("friendrequest");
        $this->db->where("friendrequest.receiverId", $id);
        $this->db->where("friendrequest.status", 'pending');
        $this->db->join("user","friendrequest.senderId=user.id" );
        return $this->db->get()->result();
    }
    function getGroupByDepartment($departmentId)
    {
        $this->db->select();
        $this->db->from("group");
        $this->db->where("group.department", $departmentId);
        return $this->db->get()->row();
    }
}