<?php $page_title = "Edit Password" ?>
<?php include("includes/header.php") ?>
<?php include("dataconnection.php") ?>
<style>
/* Style for the message box */
#message {
  display: none;
  color: #000;
  padding: 10px;
  margin-top: 10px;
}

#message p {
  font-size: 16px;
  margin: 5px 0;
}

/* Valid requirement */
.valid {
  color: green;
}

.valid:before {
  content: "✔ ";
}

/* Invalid requirement */
.invalid {
  color: red;
}

.invalid:before {
  content: "✖ ";
}
</style>

<main class="main-content mt-0">
  <section>
    <div class="page-header">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <?php
            if (isset($_SESSION['AID'])) {
              $ID = $_SESSION['AID'];
              $admin = getbyid("admin_login", $ID);
              if (mysqli_num_rows($admin) > 0) {
                $data = mysqli_fetch_array($admin);
            ?>
                <div class="card shadow-lg">
                  <div class="card-header bg-primary text-white text-center">
                    <h4 class="font-weight-bold">Edit Password</h4>
                  </div>
                  <div class="card-body">
                    <form action="profilecode.php" method="POST">
                      <input type="hidden" name="admin_id" value="<?php echo $data['ID'] ?>">

                      <!-- Current Password -->
                      <div class="mb-3">
                        <label for="opass" class="form-label"><strong>Current Password</strong></label>
                        <input type="password" id="opass" class="form-control" name="opass" value="<?php echo $data['Admin_Password'] ?>" readonly>
                      </div>

                      <!-- New Password -->
                      <div class="mb-3">
                        <label for="psw" class="form-label"><strong>New Password</strong></label>
                        <input type="password" id="psw" class="form-control" name="npass" placeholder="Enter new password" required>
                        <div id="message">
                          <p><strong>Password must contain:</strong></p>
                          <p id="letter" class="invalid">A lowercase letter</p>
                          <p id="capital" class="invalid">An uppercase letter</p>
                          <p id="number" class="invalid">A number</p>
                          <p id="length" class="invalid">At least 8 characters</p>
                        </div>
                      </div>

                      <!-- Confirm Password -->
                      <div class="mb-3">
                        <label for="cpass" class="form-label"><strong>Confirm Password</strong></label>
                        <input type="password" id="cpass" class="form-control" name="cpass" placeholder="Confirm new password" required>
                      </div>

                      <!-- Action Buttons -->
                      <div class="d-flex justify-content-between">
                        <button type="submit" name="savepassbtn" class="btn btn-success">
                          <i class="fa fa-check-circle"></i> Save
                        </button>
                        <a href="editprofile.php" class="btn btn-secondary">
                          <i class="fa fa-angle-double-left"></i> Return
                        </a>
                      </div>

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
            <?php
              } else {
                echo "<div class='alert alert-danger'>No Data Found!</div>";
              }
            } else {
              echo "<div class='alert alert-danger'>Admin ID Not Found!</div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include("includes/footer.php") ?>
<?php include("includes/scripts.php") ?>

<script>
var input = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var messageBox = document.getElementById("message");

// Show message box on focus
input.onfocus = function () {
  messageBox.style.display = "block";
};

// Hide message box on blur
input.onblur = function () {
  messageBox.style.display = "none";
};

// Validate password on input
input.onkeyup = function () {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if (input.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }

  // Validate uppercase letters
  var upperCaseLetters = /[A-Z]/g;
  if (input.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if (input.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if (input.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
};
</script>
