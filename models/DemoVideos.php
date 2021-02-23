<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DemoVideos
 *
 * @author Windows 10
 */
class DemoVideos extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getUserYoutubeLink($iduser) {
        $array=array();
        for ($which=1; $which<5; $which++) {
            $result = $this->db->select("YoutubeLink".$which." as link")->from("demovideos")->where("IDUserMus",$iduser)->get();
            $array[$which-1]=$result->row()->link;  
        }
        return $array;
    }
    
    public function addYoutubeLinkToDB($iduser, $link,$which) {
        $this->db->set("YoutubeLink".$which,$link);
        $this->db->where("IDUserMus",$iduser);
        $this->db->update("demovideos");
    }
    
    public function removeUserLink($iduser, $which) {
        $this->db->set("YoutubeLink".$which, null)->where("IDUserMus",$iduser)->update("demovideos");
    }
}
