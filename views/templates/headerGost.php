<html>
    <head>
        <title>MusicQuest</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!-- Bootstrap link -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- CSS -->
        <style><?php include "$currentPage"?>></style>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script language="Javascript">
            var change=0;
            var filterWhich=0;
            function changeDescription(num=1) {
                var base = "<?php echo base_url()?>index.php";
                if (change===0) {
                    change=1;
                    if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                    else {
                        xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                    }
                    xmlhttp.open("GET", base+"/User/getDescription",false);
                    xmlhttp.onreadystatechange=function() {   
                        if (xmlhttp.readyState===4 && xmlhttp.status===200) {     
                            document.getElementById("desc").innerHTML ="<div class=\"form-group\">\
                            <label for=\"exampleFormControlTextarea1\"></label>\
                            <textarea class=\"form-control\" id=\"descText\" rows=\"3\">"+document.getElementById("desc").innerHTML +"</textarea>\
                          </div><br><input type=\"submit\" name=\"confirm\" onClick=\"changeDescription()\" value=\"Confirm\"><input type=\"submit\" onClick=\"changeDescription(0)\" name=\"cancel\" value=\"Cancel\">"; 
                        }  
                    };
                    xmlhttp.send();
                }
                else {
                    change=0;
                    if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                    else {
                        xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                    }
                    if (num==1) {
                        xmlhttp.open("GET", base+"/User/updateDescription?newDesc="+document.getElementById("descText").value, true);
                        xmlhttp.send();
                    }
                    document.getElementById("desc").innerHTML = document.getElementById("descText").value;
                }
            }
            function openPictureUpload() {
                var base = "<?php echo base_url()?>index.php";
                document.getElementById("profilePicChange").innerHTML = "<form action=\"<?php echo site_url()."/$controller/openPicUpload"?>\" method=\"post\" enctype=\"multipart/form-data\">\
                                                                                Select image to upload:\
                                                                                <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">\
                                                                                <input type=\"submit\" value=\"Upload Image\" name=\"submitProfile\">\
                                                                            </form>";
           }
           function addYoutubeLinkField(numWhich) {
               document.getElementById("forLink"+numWhich).innerHTML = "<form action=\"<?php echo site_url()."/$controller/addYoutubeLink"?>\" method=\"post\" enctype=\"multipart/form-data\">\
                                                                                Add youtube link:&nbsp;\
                                                                                <input type=\"text\" name=\"youtubeLink\" placeholder=\"Youtube link\"><br><br>\
                                                                                <input type=\"submit\" value=\"Submit\" name=\"submitLink\"\">\
                                                                                <input type=\"hidden\" name=\"whichWindow\" value="+numWhich+">\
                                                                            </form>";
           }
           function addPictureField(numWhich) {
                var base = "<?php echo base_url()?>index.php"; 
                document.getElementById("forLink"+numWhich).innerHTML = "<form action=\"<?php echo site_url()."/$controller/openPicUpload2"?>\" method=\"post\" enctype=\"multipart/form-data\">\
                                                                            Select image to upload:\
                                                                            <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">\
                                                                            <input type=\"submit\" value=\"Upload Image\" name=\"submitProfile\">\
                                                                            <input type=\"hidden\" name=\"whichWindow\" value="+numWhich+">\
                                                                        </form>";
            }
            function removeYoutubeLink(numWhich) {
                var base = "<?php echo base_url()?>index.php"; 
                if (window.XMLHttpRequest) {
                    xmlhttp=new XMLHttpRequest();
                }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/removeLink?which="+numWhich, true);
                xmlhttp.onreadystatechange=function() {   
                    if (xmlhttp.readyState===4 && xmlhttp.status===200) {     
                        document.getElementById(numWhich+"Vid").src=null;
                    }  
                };
                xmlhttp.send();
            }
            function removePicture(numWhich) {
                var base = "<?php echo base_url()?>index.php"; 
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/removePictureCont?which="+numWhich, true);
                xmlhttp.onreadystatechange=function() {   
                    if (xmlhttp.readyState===4 && xmlhttp.status===200) {     
                        document.getElementById(numWhich+"Pic").src=null;
                    }  
                };
                xmlhttp.send();
            }
            function whichChecked(whichOne) {
                filterWhich=whichOne;
                var base = "<?php echo base_url()?>index.php"; 
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/changeWhichOnes?which="+whichOne,true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
                        if (document.getElementById("rowToFill")==null)
                            return;
                        document.getElementById("rowToFill").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.send();
                if (window.XMLHttpRequest) {
                        xmlhttp2=new XMLHttpRequest();
                    }
                else {
                    xmlhttp2=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp2.open("GET", base+"/<?php echo $controller?>/getCoops",true);
                xmlhttp2.onreadystatechange = function() {
                    if (xmlhttp2.readyState==4 && xmlhttp2.status==200){ // OK status
                        if (document.getElementById("carouselExampleIndicators")==null)
                            return;
                        document.getElementById("carouselExampleIndicators").innerHTML=xmlhttp2.responseText;
                    }
                }
                xmlhttp2.send();
            }
            function searching() {
                var base = "<?php echo base_url()?>index.php"; 
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/searchUsers?search="+document.getElementById("searchSpace").value,true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
                        document.getElementById("rowToFill").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.send();
            }
            function acceptRequest(whichReq) {
                var base = "<?php echo base_url()?>index.php"; 
                var reply = prompt("Write a short description you would like to be shown for this event:");
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/acceptR?desc="+reply+"&other="+document.getElementById("label"+whichReq).innerHTML,true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
                        document.getElementById("textPart"+whichReq).innerHTML = "You have accepted this cooperation!";
                    }
                }
                xmlhttp.send();
            }
            function rejectRequest(whichReq) {
                var base = "<?php echo base_url()?>index.php"; 
                var reply = prompt("Write a reason why you don't want to do this:");
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/rejectR?desc="+reply+"&other="+document.getElementById("label"+whichReq).innerHTML,true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
                        document.getElementById("textPart"+whichReq).innerHTML = "You have rejected this offer!";
                    }
                }
                xmlhttp.send();
            }
            function rateOther(whichReq) {
                var base = "<?php echo base_url()?>index.php";
                var rating = document.getElementById("text"+whichReq).value;
                if (parseInt(rating,10)>5) {
                    alert("Grade cant be higher than 5!");
                    return;
                }
                var whoIsRated = document.getElementById("username"+whichReq).innerHTML;
                if (window.XMLHttpRequest) {
                        xmlhttp=new XMLHttpRequest();
                    }
                else {
                    xmlhttp=new ActiveXObject("Microsoft.HMLHTTP");
                }
                xmlhttp.open("GET", base+"/<?php echo $controller?>/rateUser?rating="+rating+"&who="+whoIsRated,true);
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ // OK status
                        document.getElementById("divToFill"+whichReq).innerHTML = "Great! Now continue using our site for more successful partnerships!";
                    }
                }
                xmlhttp.send();
            }
        </script>
    </head>
    <body style="background-image:url(<?php echo base_url()."images/Background2.png"?>)" onLoad="whichChecked(0)">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="<?php echo base_url()."index.php/".$controller."/index";?>"><i class="fas fa-compact-disc"></i><?php echo "MusicQuest"; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchSpace">
                <a href="#rowToFill"><button class="btn btn-outline-primary my-2 my-sm-0" type="button" onClick="searching()"><i class="fas fa-search"></i></button></a>
                </form>
            </li>
        </ul>
        <ul class="navbar-nav">
              <?php if (isset($_SESSION["user"])) { 
                  $myUsername = $_SESSION['user']->Username;
                  echo "<li id=\"nabvar-username\" class=\"nav-item dropdown\">
                            <a class=\"nav-link dropdown-toggle\" href=\"#\" i=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".$_SESSION["user"]->Username."</a>
                        <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdown\">
                            <a class=\"dropdown-item\" href=".site_url("$controller/profile").">View Profile</a>
                            <a class=\"dropdown-item\" href=".site_url("$controller/changePasswordOpenPage").">Change Password</a>
                            <a class=\"dropdown-item\" href=".site_url("$controller/openNotificationsPage").">Coop Requests <span class=\"badge badge-danger\">3</span>
                            <a class=\"dropdown-item\" href=".site_url("User/logOut").">Log Out</a>
                        </div>
                </li>"; }
                else {
                    echo "<li class=\"nav-item\">
			        <a class=\"nav-link\" href=".site_url("Gost/login").">Login <i class=\"fas fa-user\"></i></a>
			      </li>
			      <li class=\"nav-item\">
			        <a class=\"nav-link\" href=".site_url("Gost/registracija").">Register <i class=\"fas fa-user-plus\"></i></a>
			      </li>";
                    }?>
        </ul>
        </div>
    </nav>

