
<?php
if(isset($_SESSION['currentUser_id']))
{
  $current_userId = $_SESSION['currentUser_id'];
  $currentProfile = $_SESSION['profile_pic'];
  $currentRole = $_SESSION['userRole'];
}

$activePage = basename($_SERVER['PHP_SELF']);
$folders = explode('/', $_SERVER['REQUEST_URI']);
// print_r($folders);
?>
<!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0);">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Hare <sup>Krishna</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<div class="sidebar-heading">
  Dashboard
</div>

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php if($activePage == 'dashboard.php'){echo 'active';}?>">
  <a class="nav-link" href="/fronted/admin/dashboard.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  CMS
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if(($activePage == 'index.php'|| $activePage == 'add_edit.php') && in_array('pages', $folders)){echo 'active';}?>">
  <a class="nav-link" href="/fronted/admin/pages/index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Pages</span></a>
</li>

<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Banner
</div>

<!-- Home Page Banner -->
<li class="nav-item <?php if(($activePage == 'index.php'|| $activePage == 'add_edit.php') && in_array('banner', $folders)){echo 'active';}?>">
  <a class="nav-link" href="/fronted/admin/banner/index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Home Page Banner</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Settings
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if($activePage == 'site_settings.php' || $activePage == 'general_settings.php' || $activePage == 'social_settings.php'){echo 'activeShow';}?>">
  <a class="nav-link drop-dwon collapsed" href="javascritp:void(0);" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Settings</span>
  </a>
  <div id="collapseTwo" class="collapse <?php if($activePage == 'site_settings.php' || $activePage == 'general_settings.php' || $activePage == 'social_settings.php'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="py-2 collapse-inner rounded dropdown-menu" style="display: block;">
      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
      <a class="collapse-item <?php if($activePage == 'site_settings.php'){echo 'active';}?>" href="/fronted/admin/settings/site_settings.php">Site Settings</a>
      <a class="collapse-item <?php if($activePage == 'general_settings.php'){echo 'active';}?>" href="/fronted/admin/settings/general_settings.php">General Settings</a>
      <a class="collapse-item <?php if($activePage == 'social_settings.php'){echo 'active';}?>" href="/fronted/admin/settings/social_settings.php">Social Settings</a>
    </div>
  </div>
</li>

<!-- Heading -->
<div class="sidebar-heading">
  Resources
</div>

<li class="nav-item <?php if($activePage == 'index.php' && in_array('resources', $folders)){echo 'active';}?>">
  <a class="nav-link" href="/fronted/admin/resources/index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Media</span></a>
</li>



<?php
if($currentRole != 'subadmin'){
  ?>
  <li class="nav-item <?php if($activePage == 'adminlist.php'){echo 'active';}?>">
    <a class="nav-link" href="/fronted/admin/adminlist.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Admin Profile</span></a>
  </li>
  <?php
}
?>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-moon fa-fw change-theme"></i>
              </a>
            </li>
            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
               ADMIN
                </span>
                <img src="/fronted/admin/upload/<?php echo $currentProfile; ?>" height="50" width="50" >
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="javascript:void(0);" id="showProfile" data-target="#profileModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  My Profile
                </a>
                <a class="dropdown-item change-password" data-toggle="modal" data-target="#changePasswordModal" data-id="<?php echo $current_userId; ?>" href="javascript:void(0);">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2"></i>
                  Change Password
                </a>
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="javascript:void(0);" method="POST"> 
          
            <button type="submit" name="logout_btn" id="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>

  <!-- delete model -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure want to delete?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="javascript:void(0);" method="POST"> 
          
            <button type="submit" name="delete_btn" id="delete_btn" class="btn btn-primary">Delete</button>

          </form>


        </div>
      </div>
    </div>
  </div>

  <!-- profile model -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0);" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" value="<?php echo $current_userId; ?>">
          <div class="form-group">
            <label for="first-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="" readonly>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Profile Pic:</label>
            <img src = "" alt="" height="50" width="50" id="profileImage">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- change password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0);" enctype="multipart/form-data" method="post" id="usrchangepassword">
        <input type="hidden" class="form-control" id="hidden_id" name="hidden_id" value="<?php echo $current_userId; ?>">
          <div class="form-group">
            <label for="first-name" class="col-form-label">Old Password</label>
            <input type="password" class="form-control" id="oldpassword" name="oldpassword" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">New Password</label>
            <input type="password" class="form-control password" id="newpassword" name="newpassword"><i class="fa fa-key generate-password" aria-hidden="true"></i>
            <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
