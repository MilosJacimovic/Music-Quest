    <div class="row">
        <!-- Opis i slika -->
        <div class="card col-lg-3" style="width: 18rem;">
            <img id="profPic" src="<?php echo base_url()."".$user->ProfilePicture?>" style="width:100%; height:250px;" alt="Profile picture not uploaded!">
            <div class="card-body">
                <h3 class="card-title"><?php echo $user->Name?></h3>
                <p class="card-text" id="desc"><?php echo $user->Description?></p>
                                User rating: <br>
                                <?php 
                                $percentage=null;
                                if ($user->TotalRating!=0) {
                                    $percentage = $user->TotalRating / $user->TotalVotes;
                                }
                                $string="";
                                if ($percentage==null) {
                                    $percentage=0;
                                }
                                for ($i=0; $i<5; $i++) {
                                    if ($i<$percentage) {
                                        $string.="<span class=\"fa fa-star checked\"></span>";
                                    }
                                    else {
                                        $string.="<span class=\"fa fa-star\"></span>";
                                    }
                                }
                                $string.="<br>".$percentage."/5";
                                echo $string;?> <br>
                                <?php if ($controller!="Gost") { if ($_SESSION["user"]->TipUser != $user->TipUser) { echo "<a href=\"".site_url("$controller/requestCooperation/".$user->Username)."\">Request cooperation</a>"; }}?>
                                <br><br>
                                <?php 
                                if ($controller!="Gost") {
                                    if ($_SESSION['user']->Username!=$user->Username) {
                                        if ($_SESSION['user']->Tip == 2) {
                                            if ($user->Tip==2) {
                                                echo "<a href=\"".site_url("$controller/demoteToModerator/".$user->Username)."\">Demote to moderator</a>";
                                            }
                                            else if ($user->Tip==1) {
                                                echo "<a href=\"".site_url("$controller/promoteToAdmin/".$user->Username)."\">Promote to administrator</a><br><a href=\"".site_url("$controller/demoteToUser/".$user->Username)."\">Demote to user</a>";
                                            }
                                            else if ($user->Tip==0) {
                                                echo "<a href=\"".site_url("$controller/promoteToModerator/".$user->Username)."\">Promote to moderator</a>";
                                            }
                                        }
                                        else if ($_SESSION['user']->Tip==1) {
                                            if ($user->Tip==0) {
                                                echo "<a href=\"".site_url("$controller/promoteToModerator/".$user->Username)."\">Promote to moderator</a><br><a href=\"".site_url("$controller/deleteAccount/".$user->Username)."\">Delete this user</a>";
                                            }
                                            else if ($user->Tip==1) {
                                                echo "<a href=\"".site_url("$controller/demoteToUser/".$user->Username)."\">Demote to user</a><br>";
                                            }
                                        }
                                    }
                                }
                                ?>
            </div>
        </div>
        <!-- Video Snimci -->
        <div class="col-lg-4 col-md-6">
            <iframe id="1Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[0]?>">
            </iframe><br>
            <br>
            <br>
            <iframe id="2Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[1]?>">
            </iframe><br>
        </div>
        <div class="videos col-lg-4 col-md-8">
            <iframe id="3Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[2]?>">
            </iframe><br>
            <br>
            <br>
            <iframe id="4Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[3]?>">
            </iframe><br>
        </div>
    </div>

</div>

</body>
