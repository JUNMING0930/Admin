<?php $page_title = "Add Admin"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Add New Admin</h4>
            </div>
                <div class="card-body">
                    <form action="admincode.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><strong>First Name</strong></label>
                            <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Last Name</strong></label>
                            <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Email</strong></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Password</strong></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Confirm Password</strong></label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Enter Confirm Password" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Phone</strong></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-3">
                            <label for=""><strong>Role</strong></label>
                            <select name="role" required class="form-control border border-dark">
                            <option value="">---Select Role---</option>
                            <option value="0">Admin</option>
                            <option value="1">Super Admin</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="addadminbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="admin.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
                        </div>
                        <div class="col-md-3 ">
                        <?php
                        if(isset($_SESSION['message']))
                        {
                          $message = $_SESSION['message'];
                          echo "<script>alert('$message')</script>";
                          unset($_SESSION['message']);
                        }
                        ?>
                        </div>
                        
                </div>
                </form>
        </div>
    </div>
    </div>
</div>        
        <br>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>

