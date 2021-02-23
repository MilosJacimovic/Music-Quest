        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-7">
                    <h2><?php echo $resources[0];?></h2> <br>
                    <a href="<?php echo site_url()."/$controller/remapToMusician/$resources[13]";?>">
                            <img src="<?php echo base_url().$resources[2];?>">
                    </a>
                </div>
                <div class="col-lg-5 text-center">
                    <h2>This event will be held on:</h2>
                    <h1><?php echo $resources[4];?></h1>
                    <h6><?php echo $resources[5];?></h6>
                    <br><br>
                </div>
                <div class="col-lg-3 col-md-7">
                    <h2><?php echo $resources[1];?></h2> <br>
                    <a href="<?php echo site_url()."/$controller/remapToOrganizer/$resources[14]";?>">
                            <img src="<?php echo base_url().$resources[3];?>">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <iframe class="video"
                    src="<?php echo $resources[6];?>">
                    </iframe>
                </div>
                <div class="col-lg-3 col-md-6">
                    <iframe class="video"
                    src="<?php echo $resources[7];?>">
                    </iframe>
                </div>
                <div class="col-lg-3 col-md-6">
                    <img src="<?php echo base_url().$resources[10];?>"  alt="Picture not uploaded!">
                </div>
                <div class="col-lg-3 col-md-6">
                    <img src="<?php echo base_url().$resources[11];?>" alt="Picture not uploaded!">
                </div>
                <div class="col-lg-3 col-md-6">
                    <iframe class="video"
                    src="<?php echo $resources[8];?>">
                    </iframe>
                </div>
                <div class="col-lg-3 col-md-6">
                    <iframe class="video"
                    src="<?php echo $resources[9];?>">
                    </iframe>
                </div>
                <div class="col-lg-3 col-md-6">
                    <img src="<?php echo base_url().$resources[12];?>" alt="Picture not uploaded!">
                </div>
                <div class="col-lg-3 col-md-6">
                    <img src="<?php echo base_url().$resources[13];?>" alt="Picture not uploaded!">
                </div>
            </div>
        </div>
