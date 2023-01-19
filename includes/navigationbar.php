<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center">
          <span class="nav-link text-body font-weight-bold px-0 bg-gray-100">
          <i class="fa fa-user me-sm-1"></i> 
            <?php
              if(isset($_GET['id']))
              {
                $Admin = getbyid("admin_login",$_SESSION['AID']);
                if(mysqli_num_rows($Admin)>0)
                {
                  $data = mysqli_fetch_array($Admin);
                  echo $data['Admin_Email'];
                }
              }
            ?>
          </span>
          </button>
        </li>
        <li class="nav-item dropdown px-3 d-flex align-items-center">
          <a href="#" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <button type="submit" name=profilesettingbtn class="dropdown-item border-radius-md">
                <div class="d-flex py-1" onclick="parent.location='profile.php?id=<?php echo $_SESSION['AID']?>'" >
                  <div class="d-inline-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <a class="font-weight-bold" href="profile.php?id=<?php echo $_SESSION['AID']?>">Profile Setting</a> 
                    </h6>
                  </div>
                </div>
                </button>
              
            </li>
            
            <li class="mb-2">
              <form action="logout.php" method="POST">
              <button type="submit" name=logout class="dropdown-item border-radius-md">
                <div class="d-flex py-1" onclick="return confirm('Are you sure to log out?')">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal">
                      <span class="font-weight-bold">Log Out</span> 
                    </h6>
                  </div>
                </div>
                </button>
              </form> 
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



