<?php $page_title = "Edit Password"?>
<?php include("includes/header.php")?>
<?php include("dataconnection.php")?>
<style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;

  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
<main class="main-content  mt-0">
    <section>
      <div class="page-header">
        <div class="container">
          <div class="row" >
            <div class="col-md-12">
              <?php
              if(isset($_GET['id']))
              {
                $ID = $_GET['id'];
                $admin = getbyid("admin_login",$ID);
                if(mysqli_num_rows($admin) > 0)
                {
                  $data = mysqli_fetch_array($admin);
              ?>    
              <div class=" d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                <div class="card">
                  <div class="card-header">
                    <h4 class="font-weight-bolder">Edit Password</h4>
                  </div>
                  <div class="card-body">
                    <form action = "profilecode.php" method ="POST" >
                      <div class="col-md-6">
                      <input type="hidden" name="admin_id" value="<?php echo $data['ID']?>">
                      <label for=""><strong>Password</strong></label>
                      <input type="password" readonly  class=" ms-6 ms-3" name="opass"  value = "<?php echo $data['Admin_Password']?>" style="border: none"></input>
                      </div>
                      <div class="col-md-12">
                      <label for=""><strong>New Password</strong></label>
                      <input type="password"  class="ms-5 mt-3 " name="npass" id="psw" required style="border: 1px solid;" placeholder="New Password"></input>
                      <div id="message">
                      <p>Password Requirement :</p>  
                      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                      <p id="number" class="invalid">A <b>number</b></p>
                      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                     </div>
                      </div>
                      <div class="col-md-6">
                      <label for=""><strong>Confirm Password</strong></label>
                      <input type="password"  class="ms-4 mt-3" name="cpass" required style="border: 1px solid;" placeholder="Confirm Password"></input>
                      <p></p>
                      </div>
                        <div class="pt-3 col-md-3">
                            <button type="submit" name="savepassbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                            <a href="editprofile.php?id=<?php echo $ID ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
                        </div>
                        <div class="pt-3 col-md-3">
                        <?php
	if(isset($_SESSION['message']))
	{
		$message = $_SESSION['message'];
		echo "<script>alert('$message')</script>";
		unset($_SESSION['message']);
	}
	?>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
                }
                else
                {
                  echo "No Data Found!";
                }
              }
              else
              {
                echo "The Admin_ID Not Found!";
              }
              ?>
            </div>  
          </div>
        </div>
      </div>
    </section>
  </main>
<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>

<script>
var Input = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


document.getElementById("message").style.display = "block";



Input.onkeyup = function() 
{
  var lowerCaseLetters = /[a-z]/g;
  if(Input.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  var upperCaseLetters = /[A-Z]/g;
  if(Input.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  var numbers = /[0-9]/g;
  if(Input.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  if(Input.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>