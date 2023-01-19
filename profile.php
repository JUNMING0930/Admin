<?php $page_title = "Profile Setting"?>
<?php include('includes/header.php')?>
<?php include('dataconnection.php')?>

<body class="g-sidenav-show bg-gray-200">
  <div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
              <?php
              if(isset($_GET['id']))
              {
                $Admin_ID = $_GET['id'];
                $Admin = getbyid("admin_login",$Admin_ID);
                if(mysqli_num_rows($Admin)>0)
                {
                  $data = mysqli_fetch_array($Admin);
                }
              }
               ?>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
              <?php
                echo $data['Admin_Fname']. " " . $data['Admin_Lname'];
             ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
              <?php
                echo $data['Admin_Email'];
              ?>              
              </p>
            </div>
          </div>
        </div>
                <div class="card-body p-3">
                  <hr class="horizontal gray-light ">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">First Name:</strong> &nbsp; 
                    <?php
                      echo $data['Admin_Fname'];
                    ?>  
                    </li>
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Last Name:</strong> &nbsp; 
                    <?php
                      echo $data['Admin_Lname'];
                    ?> 
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Phone:</strong> &nbsp; 
                    <?php
                      echo $data['Admin_Phone'];
                    ?> 
                    </li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; 
                    <?php
                      echo $data['Admin_Email'];
                    ?> 
                    </li>
                  </ul>
                      <div class="col-md-4 ">
                      <a href="editprofile.php?id=<?php echo $_SESSION['AID'] ?>">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile">&nbsp Edit Profile</i>
                      </a>
                    </div>
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>