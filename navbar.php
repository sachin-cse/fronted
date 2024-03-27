<!-- logout code  -->
<?php

if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the desired page after logout
    header("Location: index.php");
    exit();
}
?>
<!-- logout code end -->

<script>
function logoutConfirmation() {
    var response = confirm('Are you sure you want to log out?');
        if (response) {
            document.getElementById('logoutForm').submit();
        }

    }
</script>
<?php
$base_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>


<nav class="navbar sticky-top navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="./logo/iskcon_logo.jpg" alt="logo"></img></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item <?php if($page=='dashboard') {echo 'active';} ?>">
                    <a class="nav-link <?php if($page=='dashboard') {echo 'active';} ?>" aria-current="page"
                        href="dashboard.php">Home</a>
                </li>

                <li class="nav-item dropdown <?php if($page=='about') {echo 'active';} ?>">
                    <a class="nav-link dropdown-toggle sd_submenu <?php if($page=='about') {echo 'active';} ?>" href="#"
                        id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About Us
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item" href="isckon.php">What Is Isckon?</a></li>
                        <li><a class="dropdown-item" href="founder.php">Founder Acharya</a></li>
                        <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>

                <li class="nav-item <?php if($page=='contact') {echo 'active';} ?>">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>

                <li class="nav-item dropdown <?php if($page=='links') {echo 'active';} ?>">
                    <a class="nav-link  dropdown-toggle sd_submenu  <?php if($page=='links') {echo 'active';} ?>" href="#" id="linksDropdown a" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Links
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="linksDropdown">
                        <li><a class="dropdown-item" href="event-calendar.php">Event Calendar</a></li>
                        <li><a class="dropdown-item" href="learn-about AC.php">Learn About Srila Prabhupada</a></li>
                    </ul>
                </li>

                 <li class="nav-item dropdown <?php if($page=='Resources') {echo 'active';} ?>">
                    <a class="nav-link  dropdown-toggle sd_submenu  <?php if($page=='Resources') {echo 'active';} ?>" href="#" id="linksDropdown a" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Resources
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="linksDropdown">
                        <li><a class="dropdown-item" href="bhakti.php">Bhakti Music</a></li>
                        <li><a class="dropdown-item" href="granth.php">Granth</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                   <li class="profile-img">
                    <?php if (isset($profile_pic)): ?>
                      <img src="upload/<?php echo $profile_pic; ?>" alt="Profile Picture" class="img-fluid">
                    <?php else: ?>
                        <img src="./upload/no_image.jpg" alt="Profile Picture" class="img-fluid">
                    <?php endif; ?>
                    </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle sd_submenu <?php if($page=='dashboard') {echo 'active';} ?>" href="#"
                        id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php 
            echo "Welcome, " . $username;
            ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <!-- toggle button -->
                        <!-- <li>
              <div class="form-check form-switch mx-3 my-2">
                <input class="form-check-input" type="checkbox" id="themeSwitch"  onclick="toggleTheme()">
                <label class="form-check-label" for="themeSwitch">Change Theme</label>
              </div>
            </li> -->
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">View
                                Profile</a></li>
                        <li><a class="dropdown-item" href="#" onclick="logoutConfirmation();">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="logoutForm" method="post" style="display: none;">
    <input type="hidden" name="logout" value="1">
</form>