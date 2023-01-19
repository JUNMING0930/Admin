<?php 
$page_title = "Edit Profile";
?>
<?php include("includes/header.php")?>
<?php include("dataconnection.php")?>
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
                    <h4 class="font-weight-bolder">Edit Your Profile</h4>
                  </div>
                  <div class="card-body">
                    <form action = "profilecode.php" method ="POST" >
                      <div class="col-md-3">
                      <input type="hidden" name="admin_id" value="<?php echo $data['ID']?>">
                      <label for=""><strong>First Name</strong></label>
                      <input type="text" class="form-control" name="fname" value = "<?php echo $data['Admin_Fname']?>" required style="border: 1px solid;">
                      </div>
                      <div class="col-md-3">
                      <label for=""><strong>Last Name</strong></label>
                      <input type="text" class="form-control" name="lname" value = "<?php echo $data['Admin_Lname']?>" required style="border: 1px solid;">
                      </div>
                      <div class="col-md-6">
                      <label for=""><strong>Email</strong></label>
                      <input type="text" class="ms-3 mt-3" readonly name="email" value = "<?php echo $data['Admin_Email']?>"style="border: none">
                      </div>
                      <div class="col-md-6">
                      <label for=""><strong>Password</strong></label>
                      <input type="password" readonly  class="ms-3"name="pass" value = "<?php echo $data['Admin_Password']?>" style="border: none"></input>
                      <a href="editpass.php?id=<?php echo $ID ?>" class="btn mt-3" style="font-weight:bold;">Edit<i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <div class="col-md-6">
                      <label for=""><strong>Phone</strong></label>
                      <input type="text" class="form-control" name="phone" value = "<?php echo $data['Admin_Phone']?>" required style="border: 1px solid;">
                      </div>
                        <div class="pt-3 col-md-3">
                            <button type="submit" name="updateprofilebtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                            <a href="profile.php?id=<?php echo $_SESSION['AID']?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
                        </div>
                        
                        <?php
                        if(isset($_SESSION['message']))
                        {
                          $message = $_SESSION['message'];
                          echo "<script>alert('$message')</script>";
                          unset($_SESSION['message']);
                        }
                        ?>
                        
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