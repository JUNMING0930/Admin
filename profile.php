<?php $page_title = "Profile Setting"?>
<?php include('includes/header.php')?>
<?php include('dataconnection.php')?>

<body class="g-sidenav-show bg-gray-200">
  <div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid px-2 px-md-4">
      
      <!-- Header Section -->
      <div class="page-header min-height-100 border-radius-xl mt-4">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>

      <!-- Profile Card -->
      <div class="card card-body mx-3 mx-md-4 mt-n6 shadow-lg">
        <div class="row gx-4 mb-2">
          <?php
          if (isset($_SESSION['AID'])) {
            $Admin_ID = $_SESSION['AID'];
            $Admin = getbyid("admin_login", $Admin_ID);
            if (mysqli_num_rows($Admin) > 0) {
              $data = mysqli_fetch_array($Admin);
              $Admin_Decrypted_Email = decryption($data['Admin_Email'], $Encryption_key);
              $Admin_Decrypted_Phone = decryption($data['Admin_Phone'], $Encryption_key);
              $Admin_Decrypted_Fname = decryption($data['Admin_Fname'], $Encryption_key);
              $Admin_Decrypted_Lname = decryption($data['Admin_Lname'], $Encryption_key);
            }
          }
          ?>

          <!-- Admin Information -->
          <div class="col-auto my-auto text-center">
            <h5 class="mt-3">
              <?php echo $Admin_Decrypted_Fname . " " . $Admin_Decrypted_Lname; ?>
            </h5>
            <p class="text-muted mb-0">
              <?php echo $Admin_Decrypted_Email; ?>
            </p>
          </div>
        </div>

        <!-- Profile Details -->
        <div class="row mt-4">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card border-0 shadow-sm">
              <div class="card-header bg-gradient-primary text-white text-center">
                <h6 class="mb-0">Profile Details</h6>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>First Name:</strong>
                    <span><?php echo $Admin_Decrypted_Fname; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Last Name:</strong>
                    <span><?php echo $Admin_Decrypted_Lname; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Phone:</strong>
                    <span><?php echo $Admin_Decrypted_Phone; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Email:</strong>
                    <span><?php echo $Admin_Decrypted_Email; ?></span>
                  </li>
                </ul>
              </div>
              <div class="card-footer text-center">
                <a href="editprofile.php" class="btn btn-primary btn-sm">
                  <i class="fa fa-edit"></i> Edit Profile
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Alert Message -->
        <?php
        if (isset($_SESSION['message'])) {
          $message = $_SESSION['message'];
          echo "<script>alert('$message')</script>";
          unset($_SESSION['message']);
        }
        ?>
      </div>
    </div>
  </div>

  <?php 
  include('includes/footer.php');
  include('includes/scripts.php');
  ?>

  <!-- Additional CSS for Styling -->
  <style>
    .card {
      border-radius: 15px;
    }
    .card-header {
      border-radius: 15px 15px 0 0;
    }
    .list-group-item {
      font-size: 16px;
      padding: 10px 20px;
    }
    .btn {
      border-radius: 5px;
    }
    .text-muted {
      font-size: 14px;
      color: #6c757d;
    }
  </style>
</body>
