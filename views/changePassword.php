<!-- Forma -->
        <div class="login-container">
            <div class="row">
                <div class="col-6 col-md-3 login-form-1">
                    <h3 class="text-white">Password Form</h3>
                    <form name="changePw" method="POST" action="<?php echo site_url("$controller/updatePassword")?>">
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password" name="newPass" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm New Password" value="" required />
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-lg" type="submit" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Potrebna JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</body>