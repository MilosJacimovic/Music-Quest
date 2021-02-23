    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#"><i class="fas fa-compact-disc"></i><?php echo "MusicQuest"; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </li>
        </ul>

        <ul class="navbar-nav">
              <li id="navbar-username" class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $user->username; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="loggedInMusicianPage.html">View Profile</a>
                  <a class="dropdown-item" href="changePassword.html">Change Password</a>
                  <a class="dropdown-item" href="notifications.html">Coop Requests <span class="badge badge-danger">3</span>
                  <a class="dropdown-item" href="HomePage.html">Log Out</a>
                </div>
              </li>
            </ul>
        </div>
    </nav>

