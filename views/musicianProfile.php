    <div class="row">
        <!-- Opis i slika -->
        <div class="card col-lg-3" style="width: 18rem;">
            <img id="profPic" src="<?php echo base_url()."".$_SESSION["user"]->ProfilePicture?>" style="width:100%; height:250px;" alt="Profile picture not uploaded!">
            <div class="card-body">
                <div id="profilePicChange"><a href="#" onClick="openPictureUpload()">Change profile picture</a></div>
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
                                echo $string;?>
                                </p>
                                 <a href="#" onClick="changeDescription()"><?php if ($_SESSION['user']->Username==$user->Username) { echo "Change description"; } else if ($_SESSION['user']->TipUser != $user->TipUser) {echo "Request cooperation";}?></a>
            </div>
        </div>
        <!-- Video Snimci -->
        <div class="col-lg-4 col-md-6">
            <iframe id="1Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[0]?>">
            </iframe><br>
            <a href="#" onClick="addYoutubeLinkField(1)">Add music video</a> <br>
            <label id="forLink1"></label>
            <a href="#" onClick="removeYoutubeLink(1)">Remove music video</a>
            <br>
            <br>
            <iframe id="2Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[1]?>">
            </iframe><br>
            <a href="#" onClick="addYoutubeLinkField(2)">Add music video</a> <br>
            <label id="forLink2"></label>
            <a href="#" onClick="removeYoutubeLink(2)">Remove music video</a>
        </div>
        <div class="videos col-lg-4 col-md-8">
            <iframe id="3Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[2]?>">
            </iframe><br>
            <a href="#" onClick="addYoutubeLinkField(3)">Add music video</a> <br>
            <label id="forLink3"></label>
            <a href="#" onClick="removeYoutubeLink(3)">Remove music video</a>
            <br>
            <br>
            <iframe id="4Vid" class="video" width="100%" height="300px"
                src="<?php echo $resources[3]?>">
            </iframe><br>
            <a href="#" onClick="addYoutubeLinkField(4)">Add music video</a> <br>
            <label id="forLink4"></label>
            <a href="#" onClick="removeYoutubeLink(4)">Remove music video</a>
        </div>
    </div>

</div>

</body>
