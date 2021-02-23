<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author Windows 10
 */
class Users extends CI_Model {
    private $user;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function dohvatiUsera($username){
        $result=$this->db->where('Username',$username)->get('user');
        $user=$result->row();
        if ($user!=NULL) {
            $this->user==null; $this->user= $user;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function dohvatiUseraSaID($iduser){
        $result=$this->db->where('IDUser',$iduser)->get('user');
        $user=$result->row();
        if ($user!=NULL) {
            $this->user==null; $this->user= $user;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function dohvatiCelogUseraSaId($iduser) {
        $result=$this->db->where('IDUser',$iduser)->get('user');
        return $result->row();
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function promoteUserToMod($param) {
        $this->db->set("Tip",1);
        $this->db->where("Username",$param)->update("user");
    }
    
    public function promoteUserToAdmin($param) {
        $this->db->set("Tip",2);
        $this->db->where("Username", $param)->update("user");
    }
    
    public function demoteUserFromAdmin($param) {
        $this->db->set("Tip",1);
        $this->db->where("Username", $param)->update("user");
    }
    
    public function demoteUserToMod($param) {
        $this->db->set("Tip",1);
        $this->db->where("Username",$param)->update("user");
    }
    
    public function demoteUserFromMod($param) {
        $this->db->set("Tip",0);
        $this->db->where("Username", $param)->update("user");
    }
    
    public function deleteUserAccount($param) {
        $this->db->set("Tip",-1);
        $this->db->where("Username", $param)->update("user");
    }
    
    public function ispravanPassword($pass){
        if ($this->user->Password == $pass) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function newUser($name, $user, $pass, $tip, $tipUser, $active) {
        $query = $this->db->from("user")->select("MAX(IDUser) as maks")->get();
        $row = $query->row();
        $maks = $row->maks+1;
        $this->db->set("IDUser", $maks);
        $this->db->set("Username", $user);
        $this->db->set("Password", $pass);
        $this->db->set("Name",$name);
        $this->db->set("Tip", $tip);
        $this->db->set("TipUser", $tipUser);
        $this->db->set("Active", $active);
        $this->db->insert("user");
        if ($tipUser == "Musician") {
            $this->db->query("INSERT INTO `musician`(`IDUserMus`) VALUES (".$maks.")");
            $this->db->query("INSERT INTO `demovideos`(`IDUserMus`) VALUES (".$maks.")");
        }
        else {
            $this->db->query("INSERT INTO `organizer`(`IDUserOrg`) VALUES (".$maks.")");
            $this->db->query("INSERT INTO `locationpictures`(`IDUserOrg`) VALUES (".$maks.")");
        }
    }
    
    public function checkConfirmed($confPass) {
        if ($user->Password == $confPass) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    public function getOne($username) {
        $query = $this->db->from("user")->where("Username", $username)->get();
        return $query->row();
    }
    
    public function updateUserDescription($username, $newDesc) {
        $this->db->set("Description", $newDesc);
        $this->db->where("Username",$username);
        $this->db->update("user");
    }
    
    public function getUserDescription($username) {
        $result=$this->db->where("Username",$username)->from("user")->select("Description")->get();
        return $result->row();
    }
    
    public function savePicPath($username, $file) {
        $this->db->set("ProfilePicture",$file)->where("Username",$username)->update("user");
        $this->dohvatiUsera($username);
    }
    
    public function getUserProfilePicture($username) {
        $this->db->where("Username",$username)->from("user")->select("ProfilePicture")->get();
        return $result->row();
    }
    
    public function updatePass($iduser, $newPass) {
        $this->db->set("Password", $newPass)->where("IDUser", $iduser)->update('user');
    }

    public function getAllUsers($tip, $howMany=null) {
        $result=$this->db->where("TipUser", $tip)->get('user',$howMany);
        return $result;
    }
    
    public function searchDB($name) {
        $result = $this->db->like("Name", $name)->get('user');
        return $result;
    }
    
    public function getUserByName($name) {
        $result=$this->db->where('Name',$name)->get('user');
        return $result->row();
    }
    
    public function changeRating($who, $rating) {
        $user = $this->db->where("IDUser", $who)->from("user")->get()->row();
        $totalrating=$user->TotalRating;
        $totalvotes=$user->TotalVotes;
        $totalrating2=$totalrating+$rating;
        $totalvotes2=$totalvotes+1;
        $this->db->set("TotalVotes", $totalvotes2);
        $this->db->set("TotalRating", $totalrating2);
        $this->db->where("IDUser", $who)->update("user");
    }
    
}