<?php 
$page_title = "Edit Profile";
?>
<?php include("includes/header.php") ?>
<?php include("dataconnection.php") ?>

<main class="main-content mt-0">
    <section>
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <?php
                        if (isset($_SESSION['AID'])) {
                            $ID = $_SESSION['AID'];
                            $admin = getbyid("admin_login", $ID);
                            if (mysqli_num_rows($admin) > 0) {
                                $data = mysqli_fetch_array($admin);
                                $Admin_Decrypted_Email = decryption($data['Admin_Email'], $Encryption_key);
                                $Admin_Decrypted_Phone = decryption($data['Admin_Phone'], $Encryption_key);
                                $Admin_Decrypted_Fname = decryption($data['Admin_Fname'], $Encryption_key);
                                $Admin_Decrypted_Lname = decryption($data['Admin_Lname'], $Encryption_key);
                        ?>
                                <div class="card shadow-lg">
                                    <div class="card-header bg-gradient-primary text-white text-center">
                                        <h4 class="font-weight-bold">Edit Your Profile</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="profilecode.php" method="POST">
                                            <input type="hidden" name="admin_id" value="<?php echo $data['ID'] ?>">

                                            <div class="mb-3">
                                                <label for="fname" class="form-label"><strong>First Name</strong></label>
                                                <input type="text" id="fname" class="form-control" name="fname" value="<?php echo $Admin_Decrypted_Fname ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="lname" class="form-label"><strong>Last Name</strong></label>
                                                <input type="text" id="lname" class="form-control" name="lname" value="<?php echo $Admin_Decrypted_Lname ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label"><strong>Email</strong></label>
                                                <input type="text" id="email" class="form-control-plaintext" readonly name="email" value="<?php echo $Admin_Decrypted_Email ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="pass" class="form-label"><strong>Password</strong></label>
                                                <input type="password" id="pass" class="form-control-plaintext" readonly name="pass" value="<?php echo $data['Admin_Password'] ?>">
                                                <a href="editpass.php" class="btn btn-link p-0 mt-2"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Password</a>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label"><strong>Phone</strong></label>
                                                <input type="text" id="phone" class="form-control" name="phone" value="<?php echo $Admin_Decrypted_Phone ?>" required>
                                            </div>

                                            <div class="d-flex justify-content-between pt-3">
                                                <button type="submit" name="updateprofilebtn" class="btn btn-success">
                                                    <i class="fa fa-check-circle"></i> Save
                                                </button>
                                                <a href="profile.php" class="btn btn-secondary">
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
                            echo "<div class='alert alert-danger'>The Admin_ID Not Found!</div>";
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
