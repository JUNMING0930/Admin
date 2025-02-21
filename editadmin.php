<?php $page_title = "Edit Admin"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php
        if(isset($_POST['admin_id']) || isset($_SESSION['admin_id']))
        {
            if(isset($_POST['admin_id']))
            {
                $id = $_POST['admin_id'];
            }
            else
            {
                $id = $_SESSION['admin_id'];
                unset($_SESSION['admin_id']);
            }
            $admin = getbyid("admin_login",$id);

            if(mysqli_num_rows($admin) > 0)
            {
                $data = mysqli_fetch_array($admin);
                $Admin_Decrypted_Fname = decryption($data['Admin_Fname'], $Encryption_key);
                $Admin_Decrypted_Lname = decryption($data['Admin_Lname'], $Encryption_key);
                $Admin_Decrypted_Email = decryption($data['Admin_Email'], $Encryption_key);
                $Admin_Decrypted_Phone = decryption($data['Admin_Phone'], $Encryption_key);
            ?>
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
            <h4 class="font-weight-bold">Edit Admin</h4>
            </div>
                <div class="card-body">
                    <form action="admincode.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="admin_id" value="<?php echo $data['ID'] ?>">
                            <label for="fname"><strong>First Name</strong></label>
                            <input type="text" id="fname" class="form-control" name="fname" value="<?php echo $Admin_Decrypted_Fname?>" placeholder="Enter First Name" required >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname"><strong>Last Name</strong></label>
                            <input type="text" id="lname" class="form-control" name="lname" value="<?php echo $Admin_Decrypted_Lname?>" placeholder="Enter Last Name" required >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email"><strong>Email</strong></label>
                            <input type="text" id="email" readonly style="border:none;" class="form-control" name="email" value="<?php echo $Admin_Decrypted_Email?>" placeholder="Enter Email" required >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="password"><strong>Password</strong></label>
                            <input type="password" id="password" readonly style="border:none;" class="form-control" name="password" value="<?php echo $data['Admin_Password']?>" placeholder="Enter Password" required >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone"><strong>Phone</strong></label>
                            <input type="text" id="phone" class="form-control" name="phone" value="<?php echo $Admin_Decrypted_Phone?>" placeholder="Enter Phone Number" required >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="role"><strong>Role</strong></label>
                            <select name="role" required class="form-control">
                            <option value="">---Select Role---</option>
                            <?php
                            if($data['Admin_Role'] == 0)
                            {
                                ?>
                                <option value="0" selected>Admin</option>
                                <option value="1">Super Admin</option>
                                <?php
                            }
                            else
                            {
                                ?>
                                <option value="0">Admin</option>
                                <option value="1" selected>Super Admin</option>
                                <?php
                            }
                            ?>
                            
                            </select>
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="updateadminbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="admin.php" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
                        </div>
                        <div class="col-md-3 mt-3">
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
            <?php
            }
            else
            {
                echo "Category not found";
            }
        }
        else
        {
            echo "ID IS MISSING FROM URL!";
        }
            ?>
        </div>
    </div>
</div>        
        <br>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>