<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gost
 *
 * @author Windows 10
 */
class Gost extends CI_Controller {
    private $whichOnes=0;
    private $added=0;
    
    public function __construct() {
        parent::__construct();
        $this->load->model("Cooperation");
        $this->load->model("DemoVideos");
        $this->load->model("LocationPictures");
        $this->load->model("Organizer");
        $this->load->model("Users");
    }
    
    public function remapToCooperation($musName, $musOrg) {
        $musName=str_replace("%20", " ", $musName);
        $userMus = $this->Users->getUserByName($musName);
        $userOrg = $this->Users->getUserByName($musOrg);
        $coop = $this->Cooperation->getOneNoLastReply($userMus->IDUser, $userOrg->IDUser, "ACCEPTED");
        $message=null;
        $user=null;
        $page="cooperationPage.php";
        $resources = array();
        $resources[0]=$userMus->Name;
        $resources[1]=$userOrg->Name;
        $resources[2]=$userMus->ProfilePicture;
        $resources[3]=$userOrg->ProfilePicture;
        $resources[4]=$coop->Date;
        $resources[5]=$coop->Description;
        $videos = $this->DemoVideos->getUserYoutubeLink($userMus->IDUser);
        $pictures = $this->LocationPictures->getUserPictures($userOrg->IDUser);
        for ($i=0; $i<4; $i++) {
            $resources[6+$i]=$videos[$i];
        }
        for ($i=0; $i<4; $i++) {
            $resources[10+$i]=$pictures[$i];
        }
        $resources[14]=$userMus->Username;
        $resources[15]=$userOrg->Username;
        $this->load->view("templates/headerGost.php", ["currentPage"=>"cooperationStylesheet.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$resources]);
        $this->load->view($page, ["currentPage"=>"cooperationStylesheet.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$resources]);
        $this->load->view("templates/footer.php");
    }
    
    public function remapToMusician($param) {
        $user = $this->Users->getOne($param);
        $result = $this->DemoVideos->getUserYoutubeLink($user->IDUser);
        $message=null;
        $page = "otherMusicianPage.php";
        $this->load->view("templates/headerGost.php", ["currentPage"=>"musicianPage.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$result]);
        $this->load->view($page, ["currentPage"=>"musicianPage.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$result]);
        $this->load->view("templates/footer.php");
    }
    
    public function remapToOrganizer($param) {
        $user = $this->Users->getOne($param);
        $result = $this->LocationPictures->getUserPictures($user->IDUser);
        $message=null;
        $page = "otherOrganizerPage.php";
        $this->load->view("templates/headerGost.php", ["currentPage"=>"musicianPage.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$result]);
        $this->load->view($page, ["currentPage"=>"musicianPage.css", "message"=>$message, "controller"=>"Gost", "user"=>$user, "resources"=>$result]);
        $this->load->view("templates/footer.php");
    }
    
    public function searchUsers() {
        $name = $_GET['search'];
        $result = $this->Users->searchDB($name);
        $stringToReturn="";
        $type;
        foreach ($result->result() as $row) {
            if ($row->TipUser==0) {
                $type="Musician";
            }
            else {
                $type="Organizer";
            }
            $stringToReturn.= "<div class=\"col-lg-3 col-md-4 col-sm-6\">
                <div class=\"card\">
                    <a href=\"".base_url()."index.php/Gost/remapTo".$type."/".$row->Username."\"><img src=".base_url()."".$row->ProfilePicture." class=\"card-img-top\" alt=\"Profile picture not uploaded!\"></a>
                    <div class=\"card-body\">
                        <h5 class=\"card-title text-center\">".$row->Name."</h5>
                    </div>
                </div>
            </div>";
        }
        echo $stringToReturn;
    }
    
    public function changeWhichOnes() {
        $this->whichOnes=$_GET['which'];
        $stringToReturn="";
        $result = $this->Users->getAllUsers($this->whichOnes,16);
        $type;
        $i=0;
        foreach ($result->result() as $row) {
            if ($row->TipUser==0) {
                $type="Musician";
            }
            else {
                $type="Organizer";
            }
            $stringToReturn.= "<div class=\"col-lg-3 col-md-4 col-sm-6\">
                <div class=\"card\">
                    <a href=\"".base_url()."index.php/Gost/remapTo".$type."/".$row->Username."\"><img src=".base_url()."".$row->ProfilePicture." class=\"card-img-top\" alt=\"Profile picture not uploaded!\"></a>
                    <div class=\"card-body\" id=".$i.">
                        <h5 class=\"card-title text-center\">".$row->Name."</h5>
                    </div>
                </div>
            </div>";
            $i++;
        }
        echo $stringToReturn;
    }
    
    public function printPage($page, $cssFile, $message=null) {
        $controller="Gost";
        $result=null;
        $this->load->view("templates/headerGost.php", ["currentPage"=>$cssFile, "message"=>$message, "controller"=>$controller, "resources"=>$result]);
        $this->load->view($page);
        $this->load->view("templates/footer.php");
    }
    
    public function index() {
        $currentPage="homepageStylesheet.css";
        $this->printPage("index.php", $currentPage);
    }
    
    public function registracija($message=null) {
        $currentPage="loginStylesheet.css";
        $this->printPage("signUpPage.php", $currentPage, $message);
    }
    
    public function login($message=null) {
        $currentPage="loginStylesheet.css";
        $this->printPage("loginPage.php", $currentPage, $message);
    }
    
    public function registrujSe() {
        $name=$this->input->post("Name");
        $user=$this->input->post("Username");
        $pass=$this->input->post("Password");
        $radioVal = $_POST["optradio"];
        $confirmed=$this->input->post("Confirmed");
        $tip=0;
        $active=1;
        $tipUser;
        if($radioVal == "musician" && $pass==$confirmed) {
           $tipUser=0;
           $this->Users->newUser($name, $user, $pass, $tip, $tipUser, $active);
           redirect("Gost/index");
        }
        else if ($radioVal == "organizer" && $pass==$confirmed) {
            $tipUser=1;
            $this->Users->newUser($name, $user, $pass, $tip, $tipUser, $active);
            redirect("Gost/index");
        }
        else {
            $this->registracija("Lozinka neispravno potvrdjena");
        }
    }
    
    //metoda koja se poziva klikom na submit forme za logovanje
    public function ulogujSe(){
        $this->form_validation->set_rules("username", "Korisnicko_ime", "required");
        $this->form_validation->set_rules("password", "Lozinka", "required");
        $this->form_validation->set_message("required","Polje {field} je ostalo prazno.");
        if ($this->form_validation->run()) {
            if (!$this->Users->dohvatiUsera($this->input->post('username'))) {
                $this->login("Neispravno korisnicko ime!");
            } else if (!$this->Users->ispravanPassword($this->input->post('password'))) {
                $this->login("Neispravna lozinka!");
            } else {
                $user=$this->Users->getUser();
                $this->session->set_userdata('user',$user);
                if($user->Tip == 0){
                    redirect("User/index");
                } else if ($user->Tip == 1) {
                    redirect("Moderator/index");
                }
                else {
                    redirect("Admin/index");
                }
            }
        } else {
            $this->login();
        }
    }
    
    public function getCoops() {
        $result = $this->Cooperation->getAllForIndex();
        $fillString="";
        $fillString.="<ol class=\"carousel-indicators\">";
        for ($i=0; $i<count($result); $i++) {
            if ($i==0) {
                $fillString.="<li data-target=\"#carouselExampleIndicators\" data-slide-to=".$i." class=\"active\"></li>";
            }
            else {
                $fillString.="<li data-target=\"#carouselExampleIndicators\" data-slide-to=".$i."></li>";
            }
        }
        $fillString.="</ol><div class=\"carousel-inner\">";
        for ($i=0; $i<count($result); $i++) {
            $userMus = $this->Users->dohvatiCelogUseraSaId($result[$i]->IDUserMus);
            $userOrg = $this->Users->dohvatiCelogUseraSaId($result[$i]->IDUserOrg);
            if ($i==0) {
                $fillString.="<div class=\"carousel-item active\">
                    <a href=\"".site_url()."/Gost/remapToCooperation/".$userMus->Name."/".$userOrg->Name."\">
                    <img class=\"d-block w-100\" src=".base_url().$userMus->ProfilePicture." alt=\"First slide\"></a>
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>".$userMus->Name."</h3>
                        <h5>@".$userOrg->Name."</h5>
                    </div>
                </div>";
            }
            else {
                $fillString.="<div class=\"carousel-item\">
                    <a href=\"".site_url()."/Gost/remapToCooperation/".$userMus->Name."/".$userOrg->Name."\">
                    <img class=\"d-block w-100\" src=".base_url().$userMus->ProfilePicture." alt=\"First slide\"></a>
                    <div class=\"carousel-caption d-none d-md-block\">
                        <h3>".$userMus->Name."</h3>
                        <h5>@".$userOrg->Name."</h5>
                    </div>
                </div>";
            }
        }
        $fillString.="</div>";
        $fillString.="<a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\">
                <span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Previous</span>
            </a>
            <a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\">
                <span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span>
                <span class=\"sr-only\">Next</span>
            </a>";
        echo $fillString;
    }
}
