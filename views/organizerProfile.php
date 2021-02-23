            <div class="row">
                <!-- Opis i slika -->
                <div class="card col-lg-3" style="width: 18rem;">
                    <img id="profPic" src="<?php echo base_url()."".$_SESSION["user"]->ProfilePicture?>" class="card-img-top" style="width:100%; height:250px;" alt="Profile picture not uploaded!">
                    <div class="card-body">
                        <div id="profilePicChange"><a href="#" onClick="openPictureUpload()">Change profile picture</a></div>
                        <h3 class="card-title"><?php echo $user->Name?></h3>
                        <p class="card-text"id="desc"><?php echo $user->Description?></p>
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
                    <img id="1Pic" class="photos" src="<?php echo base_url()."".$resources[0]?>"><br>
                    <a href="#" onClick="addPictureField(1)">Add photo</a> <br>
                    <label id="forLink1"></label>
                    <a href="#" onClick="removePicture(1)">Remove photo</a>
                    <br>
                    <br>
                    <img id="2Pic" class="photos" src="<?php echo base_url()."".$resources[1]?>"><br>
                    <a href="#" onClick="addPictureField(2)">Add photo</a> <br>
                    <label id="forLink2"></label>
                    <a href="#" onClick="removePicture(2)">Remove photo</a>
                </div>
                <div class="col-lg-4 col-md-8">
                    <img id="3Pic" class="photos" src="<?php echo base_url()."".$resources[2]?>"><br>
                    <a href="#" onClick="addPictureField(3)">Add photo</a> <br>
                    <label id="forLink3"></label>
                    <a href="#" onClick="removePicture(3)">Remove photo</a>
                    <br>
                    <br>
                    <img id="4Pic" class="photos" src="<?php echo base_url()."".$resources[3]?>"><br>
                    <a href="#" onClick="addPictureField(4)">Add photo</a> <br>
                    <label id="forLink4"></label>
                    <a href="#" onClick="removePicture(4)">Remove photo</a>
                </div>
            </div>
	</div>
    </body>