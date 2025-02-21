<script>
/* Change the background color of the whole page */
body {
    background-color: #f4f6f9;  /* Light gray background */
}

/* Change the background color of the navbar */
.navbar {
    background-color: #1d1d1d; /* Dark background for the navbar */
}

/* Change the background color of the sidebar */
#sidenav-main {
    background-color: #333;  /* Darker background for the sidebar */
}

/* Cards background color */
.card {
    background-color: #ffffff;  /* White background for cards */
}

/* Card header background colors */
.bg-gradient-dark {
    background: linear-gradient(180deg, #212121, #424242); /* Dark gradient for the card headers */
}

.bg-gradient-primary {
    background: linear-gradient(180deg, #2196F3, #1976D2); /* Blue gradient for card headers */
}

.bg-gradient-success {
    background: linear-gradient(180deg, #4CAF50, #388E3C); /* Green gradient for card headers */
}

.bg-gradient-info {
    background: linear-gradient(180deg, #00BCD4, #0097A7); /* Teal gradient for card headers */
}
</script>
<?php $page_title = "Welcome"?>
<?php include('includes/header.php')?>

<div class="row">
  <div class="col-lg-7 position-relative z-index-2">
    <div class="card card-plain mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex flex-column h-100">
              <h2 class="font-weight-bolder mb-0">Welcome to BIRKENSTOCK Admin Panel</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Categories Card -->
      <div class="col-lg-5 col-sm-5">
        <div class="card mb-2 shadow-sm">
          <div class="card-header p-3 pt-2 bg-gradient-dark text-white">
            <div class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">category</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Categories</p>
              <?php
                $Cate = getalldata("category");
                if($Total_Cate_Row = mysqli_num_rows($Cate)) {
                  echo "<h4 class='mb-0'>{$Total_Cate_Row}</h4>";
                } else {
                  echo "<h4 class='mb-0'>0</h4>";
                }
              ?>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>

        <!-- Users Card -->
        <div class="card mb-2 shadow-sm">
          <div class="card-header p-3 pt-2 bg-gradient-primary text-white">
            <div class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Users</p>
              <?php
                $User = "SELECT * FROM user";
                $User_Run = mysqli_query($userconnection,$User);
                if($Total_User_Row = mysqli_num_rows($User_Run)) {
                  echo "<h4 class='mb-0'>{$Total_User_Row}</h4>";
                } else {
                  echo "<h4 class='mb-0'>0</h4>";
                }
              ?>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>

      <!-- Products and Orders Cards -->
      <div class="col-lg-5 col-sm-5">
        <!-- Products Card -->
        <div class="card mb-2 shadow-sm">
          <div class="card-header p-3 pt-2 bg-gradient-success text-white">
            <div class="icon icon-lg icon-shape bg-gradient-success shadow text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">local_mall</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Products</p>
              <?php
                $Pro = getalldata("product");
                if($Total_Pro_Row = mysqli_num_rows($Pro)) {
                  echo "<h4 class='mb-0'>{$Total_Pro_Row}</h4>";
                } else {
                  echo "<h4 class='mb-0'>0</h4>";
                }
              ?>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>

        <!-- Orders Card -->
        <div class="card shadow-sm">
          <div class="card-header p-3 pt-2 bg-gradient-info text-white">
            <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">receipt</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Orders</p>
              <?php
                $Order = "SELECT * FROM orders ORDER BY id DESC";
                $Order_Run = mysqli_query($userconnection,$Order);
                if($Total_Order_Row = mysqli_num_rows($Order_Run)) {
                  echo "<h4 class='mb-0'>{$Total_Order_Row}</h4>";
                } else {
                  echo "<h4 class='mb-0'>0</h4>";
                }
              ?>
            </div>
          </div>
          <hr class="horizontal my-0 dark">
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-10">
        <div class="card mb-4"></div>
      </div>
    </div>
  </div>
</div>

<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>
