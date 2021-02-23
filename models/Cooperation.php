<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cooperation
 *
 * @author Windows 10
 */
class Cooperation extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addCooperation($userFirst, $userSecond, $datetime, $text, $initiate) {
        $query = $this->db->from("cooperation")->select("MAX(IDCoop) as maks")->get();
        $row = $query->row();
        $maks = $row->maks+1;
        $this->db->set("IDCoop", $maks);
        $this->db->set("IDUserOrg", $userSecond->IDUser);
        $this->db->set("IDUserMus", $userFirst->IDUser);
        $this->db->set("Status", "PENDING");
        $this->db->set("Date", $datetime);
        $this->db->set("IDReply", $initiate);
        $this->db->set("proposalDescription", $text);
        $this->db->insert("cooperation");
    }
    
    public function getById($idCoop) {
        return $this->db->where("IDCoop", $idCoop)->get("cooperation")->row();
    }
    
    public function getAll($iduser) {
        $this->db->where("IDUserOrg", $iduser);
        $this->db->or_where("IDUserMus",$iduser);
        $this->db->from("cooperation");
        return $this->db->get();
    }
    
    public function getOne($musician, $organizer, $status, $lastReply) {
        $this->db->where("IDUserOrg", $organizer);
        $this->db->where("IDUserMus", $musician);
        $this->db->where("Status", $status);
        $this->db->where("IDReply", $lastReply);
        return $this->db->get("cooperation");
    }
    
    public function getOneNoLastReply($musician, $organizer, $status) {
        $this->db->where("IDUserOrg", $organizer);
        $this->db->where("IDUserMus", $musician);
        $this->db->where("Status", $status);
        return $this->db->get("cooperation")->row();
    }
    
    public function answerRequest($desc, $other, $answer) {
        $otherId = $this->db->select("IDUser")->from('user')->where("Name", $other)->get()->row();
        $this->db->where("IDUserOrg", $_SESSION['user']->IDUser);
        $this->db->where("IDUserMus", $otherId->IDUser);
        $this->db->where("IDReply", $otherId->IDUser);
        $result = $this->db->get("cooperation");
        if ($result->row()) {
            $this->db->set("Status", $answer);
            $this->db->set("IDReply", $_SESSION['user']->IDUser);
            $this->db->set("Description", $desc);
            $this->db->where("IDUserOrg", $_SESSION['user']->IDUser);
            $this->db->where("IDUserMus", $otherId->IDUser);
            $this->db->where("IDReply", $otherId->IDUser);
        }
        else {
            $this->db->reset_query();
            $this->db->set("Status", $answer);
            $this->db->set("IDReply", $_SESSION['user']->IDUser);
            $this->db->set("Description", $desc);
            $this->db->where("IDUserOrg", $otherId->IDUser);
            $this->db->where("IDUserMus", $_SESSION['user']->IDUser);
            $this->db->where("IDReply", $otherId->IDUser);
        }
        $this->db->update("cooperation");
    }
    
    public function UpdateStatusByTimeAccepted($idcoop) {
        $this->db->query("UPDATE cooperation SET Status='ENDED' WHERE now()>Date AND IDCoop=".$idcoop);
    }
    
    public function UpdateStatusByTimeRejected($idcoop) {
        $this->db->query("UPDATE cooperation SET Status='DONE' WHERE now()>Date AND IDCoop=".$idcoop);
    }
    
    public function updateRating($whoIsRating, $whoIsRated, $rating) {
        $this->db->where("IDUserMus", $whoIsRating)->or_where("IDUserOrg", $whoIsRating);
        $this->db->where("IDUserMus", $whoIsRated)->or_where("IDUserOrg", $whoIsRating);
        $find = $this->db->get("cooperation")->row();
        $isRated="";
        if ($find->IDUserMus == $whoIsRating) {
            $isRated = "Organizer";
        }
        else {
            $isRated = "Musician";
        }
        $this->db->where("IDUserMus", $whoIsRating)->or_where("IDUserOrg", $whoIsRating);
        $this->db->where("IDUserMus", $whoIsRated)->or_where("IDUserOrg", $whoIsRating);
        if ($find->RatingMusician!=null && $find->RatingOrganizer!=null) {
            $this->db->set("Status", "DONE");
        }
        $this->db->set("Rating".$isRated, $rating);
        $this->db->update("cooperation");
        $this->Users->changeRating($whoIsRated,$rating);
    }
    
    public function getAllForIndex() {
        return $this->db->where("Status", "ACCEPTED")->get("cooperation", 4)->result();
    }
}
