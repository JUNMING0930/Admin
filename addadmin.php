<?php $page_title = "Add Admin"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="font-weight-bold">Add New Admin</h4>
        </div>
        <div class="card-body">
          <form action="admincode.php" method="POST">
            <div class="row">
              <!-- First Name -->
              <div class="col-md-6 mb-3">
                <label for="fname"><strong>First Name</strong></label>
                <input type="text" id="fname" class="form-control" name="fname" placeholder="Enter First Name" required>
              </div>
              <!-- Last Name -->
              <div class="col-md-6 mb-3">
                <label for="lname"><strong>Last Name</strong></label>
                <input type="text" id="lname" class="form-control" name="lname" placeholder="Enter Last Name" required>
              </div>
              <!-- Email -->
              <div class="col-md-12 mb-3">
                <label for="email"><strong>Email</strong></label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required>
              </div>
              <!-- Password -->
              <div class="col-md-12 mb-3">
                <label for="password"><strong>Password</strong></label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Enter Password" required>
              </div>
              <!-- Confirm Password -->
              <div class="col-md-12 mb-3">
                <label for="cpassword"><strong>Confirm Password</strong></label>
                <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="Enter Confirm Password" required>
              </div>
              <!-- Phone -->
              <div class="col-md-6 mb-3">
                <label for="phone"><strong>Phone</strong></label>
                <input type="tel" id="phone" class="form-control" name="phone" placeholder="Enter Phone Number" required>
              </div>
              <!-- Role -->
              <div class="col-md-6 mb-3">
                <label for="role"><strong>Role</strong></label>
                <select id="role" name="role" required class="form-control">
                  <option value="">---Select Role---</option>
                  <option value="0">Admin</option>
                  <option value="1">Super Admin</option>
                </select>
              </div>
            </div>
            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
              <button type="submit" name="addadminbtn" class="btn btn-success">
                <i class="fa fa-check-circle"></i> Save
              </button>
              <a href="admin.php" class="btn btn-secondary">
                <i class="fa fa-angle-double-left"></i> Return
              </a>
            </div>
            <!-- Feedback Message -->
            <?php
            if (isset($_SESSION['message'])) {
              $message = $_SESSION['message'];
              echo "<div class='alert alert-info mt-3'>$message</div>";
              unset($_SESSION['message']);
            }
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
