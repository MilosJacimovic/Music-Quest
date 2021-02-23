<div class="login-container">
        <div class="row">
            <div class="col-6 col-md-3 login-form-1">
                <h3 class="text-white">Sign Up Form</h3>
                <form name="signupform" action="<?php echo site_url('Gost/registrujSe') ?>" method="post">
                    <div class="form-group">
                        <input id="nameInput" type="text" class="form-control" placeholder="Name" name="Name" title="This is the name that other users will see. It doesn't have to be unique." required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="Username" title="This is the name you'll use to log in. It has to be unique." required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="Password" value="" required/>
                    </div>
                     <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="Confirmed" value="" required/>
                    </div>
                    <div class="form-check-inline">
                                              <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="musician" name="optradio" required>Musician
                                              </label>
                                            </div>
                                            <div class="form-check-inline">
                                              <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="organizer" name="optradio" required>Space Publisher
                                              </label>
                                            </div>
                                            <br><br>
                                            <div class="form-group">
                        <input class="btn btn-primary btn-lg" type="submit" value="Register">
                    </div>
                    <?php echo "<p style=\"font-color:red;\">".$message."</p>"?>
                </form>
            </div>
        </div>
    </div>

    </body>

