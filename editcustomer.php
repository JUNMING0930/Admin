<?php $page_title = "Edit Customer"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Edit Customer</h4>
            </div>
                <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $Customer_ID = $_GET['id'];
                            $Customer = "SELECT * FROM user WHERE ID = '$Customer_ID'";
                            $Customer_run = mysqli_query($userconnection,$Customer);
                            if(mysqli_num_rows($Customer_run) > 0)
                            {
                            $data = mysqli_fetch_array($Customer_run);
                    ?>
                    <form action="customercode.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" value="<?php echo $data['ID']?>" name="customer_id">
                            <label for=""><strong>First Name</strong></label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $data['User_First_Name']?>" placeholder="Enter First Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Last Name</strong></label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $data['User_Last_Name']?>" placeholder="Enter Last Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Email</strong></label>
                            <input type="text" class="form-control" name="email" value="<?php echo $data['User_Email']?>" placeholder="Enter Email" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Password</strong></label>
                            <input type="text" class="form-control" name="password" value="<?php echo $data['User_Password']?>" placeholder="Enter Password" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Gender</strong></label>
                            <select name="gender" required class="form-control border border-dark" >
                                <option value="">---Select Gender---</option>
                                <?php
                                    if($data['User_Gender'] == "Male")
                                    {
                                        ?>
                                        <option value="<?php echo $data['User_Gender']?>" <?php echo $data['User_Gender'] == "Male" ? "selected":"" ?>>Male</option>
                                        <option value="Female">Female</option>
                                        <?php
                                    }
                                    else if($data['User_Gender'] == "Female")
                                    {
                                        ?>
                                        <option value="Male">Male</option>
                                        <option value="<?php echo $data['User_Gender']?>" <?php echo $data['User_Gender'] == "Female" ? "selected":"" ?>>Female</option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="row-md-6">
                          <label for=""><strong>Status</strong></label>
                            <input type="checkbox"  <?php echo $data['User_Status'] ? "checked":"" ?> name="status">
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="updatecustomerbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="customer.php?id=<?php echo $_SESSION['ID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
                        </div>
                        <div class="col-md-3 ">
                        <?php
                        if(isset($_SESSION['message']))
                        {
                            $message = $_SESSION['message'];
                            echo "<strong>$message</strong>";
                            unset($_SESSION['message']);
                        }
                        ?>
                        </div>
                        <?php
                            }
                        
                        }
                        ?>
                </div>
                </form>
        </div>
    </div>
    </div>
</div>        
        <br>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>