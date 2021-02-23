
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocationPictures
 *
 * @author Windows 10
 */
class LocationPictures extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getUserPictures($iduser) {
        $array=array();
        for ($which=1; $which<5; $which++) {
            $result = $this->db->select("pathToPicture".$which." as pic")->from("locationpictures")->where("IDUserOrg",$iduser)->get();
            $array[$which-1]=$result->row()->pic; 
        }
        return $array;
    }
    
    public function savePicPath2($iduser, $file, $which) {
        $this->db->set("pathToPicture".$which,$file)->where("IDUserOrg",$iduser)->update("locationpictures");
        $this->Users->dohvatiUseraSaID($iduser);
    }
    
    public function removeUserPicture($iduser, $which) {
        $this->db->set("pathToPicture".$which, null)->where("IDUserOrg",$iduser)->update("locationpictures");
    }
}
