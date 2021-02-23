<div class="login-container">
            <div class="row">
                <div class="col-6 col-md-3 login-form-1">
                    <h3 class="text-white">Login Form</h3>
                    <form name="loginform" action="<?php echo site_url('Gost/ulogujSe') ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="username" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" value=""  required/>
                        </div>
                        <?php echo "<br><p style=\"font-color:red;\">".$message."</p>" ?>
                        <div class="form-group">
                            <input class="btn btn-primary btn-lg" type="submit" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>

	</body>

