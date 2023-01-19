<?php $page_title = "Add Customer"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Add New Customer</h4>
            </div>
                <div class="card-body">
                    <form action="customercode.php" method="POST">
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
                            <input type="text" class="form-control" name="password" placeholder="Enter Password" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Gender</strong></label>
                            <select name="gender" required class="form-control border border-dark" >
                                <option value="">---Select Gender---</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="row-md-6">
                          <label for=""><strong>Status</strong></label>
                            <input type="checkbox"  name="status">
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="addcustomerbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
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
                        
                </div>
                </form>
        </div>
    </div>
    </div>
</div>        
        <br>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>