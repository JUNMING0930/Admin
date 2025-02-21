<?php
              if(isset($_SESSION['AID']))
              {
                $Admin = getbyid("admin_login", $_SESSION['AID']);
                if(mysqli_num_rows($Admin) > 0)
                {
                  $data = mysqli_fetch_array($Admin);
                  $Encryption_key = 'Multimedia'; 
                  $iv = '1234567891234567';
                  function decryption($data, $key)
                  {
                      $decryption_key = base64_encode($key);
                      list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
                      return openssl_decrypt($encrypted_data, 'aes-256-cbc', $decryption_key, 0, $iv);
                  }
                  $Admin_Email = decryption($data['Admin_Email'], $Encryption_key);
                }
              }
            ?>
            <script>
            /* Navbar Background and Shadow */
.navbar-main {
  background-color: #343a40 !important;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

/* Navbar Brand Style */
.navbar-brand {
  font-size: 1.25rem;
  font-weight: bold;
  color: #ffffff;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Dropdown Menu Customization */
.dropdown-menu {
  background-color: #343a40 !important;
  border-radius: 10px;
}

.dropdown-item {
  color: #ffffff !important;
  padding: 12px 20px;
  font-size: 1rem;
  transition: background-color 0.3s ease;
}

.dropdown-item:hover {
  background-color: #495057 !important;
  border-radius: 8px;
}

/* Navbar Text Color */
.nav-link {
  color: #ffffff !important;
  font-size: 1.05rem;
}

.nav-link:hover {
  color: #ccc !important;
}

/* Icon Style */
.fa {
  color: #ffffff;
  font-size: 1.2rem;
}

/* Responsive Design: Ensure the navbar works on smaller screens */
@media (max-width: 767px) {
  .navbar-nav {
    text-align: center;
  }
  .navbar-nav .nav-item {
    margin: 10px 0;
  }
}
</script>
<nav class="navbar navbar-main navbar-expand-lg shadow-lg border-radius-xl bg-dark" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <a href="index.php" class="navbar-brand text-white">Admin Dashboard</a>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <a href="profile.php" class="text-white"><?php echo $Admin_Email?></a>
      </div>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item d-flex align-items-center">
          <span class="nav-link text-white font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i> 
          </span>
        </li>
        <li class="nav-item dropdown px-3 d-flex align-items-center">
          <a href="#" class="nav-link text-white p-0" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-cog me-sm-1"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-dark px-2 py-3" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item text-white border-radius-md" href="editprofile.php">Update Profile</a>
            <a class="dropdown-item text-white border-radius-md" href="logout.php" onclick="return confirm('Are you sure you want to log out?');">Log Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>