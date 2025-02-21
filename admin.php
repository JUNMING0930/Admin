<?php 
$page_title = "Admin";
include("includes/header.php");
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Admin Management</h4>
                    <a href="addadmin.php" class="btn btn-success"><i class="fa fa-plus"></i> Add New Admin</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $admin = getalldata("admin_login");
                               if(mysqli_num_rows($admin) > 0) {
                                  foreach ($admin as $items) {
                                    $Admin_Decrypted_Fname = decryption($items['Admin_Fname'], $Encryption_key);
                                    $Admin_Decrypted_Lname = decryption($items['Admin_Lname'], $Encryption_key);
                                    $Admin_Decrypted_Email = decryption($items['Admin_Email'], $Encryption_key);
                                    $Admin_Decrypted_Phone = decryption($items['Admin_Phone'], $Encryption_key);
                                    ?>
                                    <tr>
                                        <td><?php echo $items['ID'];?></td>
                                        <td><?php echo $Admin_Decrypted_Fname;?></td>
                                        <td><?php echo $Admin_Decrypted_Lname;?></td>
                                        <td><?php echo $Admin_Decrypted_Email;?></td>
                                        <td><?php echo $Admin_Decrypted_Phone;?></td>
                                        <td><?php echo $items['Admin_Role'] == 0 ? "Admin" : "Super Admin";?></td>
                                        <td>
                                            <?php if($items['ID'] != $_SESSION['AID']) : ?>
                                                <form action="editadmin.php" method="POST" class="d-inline-block">
                                                    <input type="hidden" name="admin_id" value="<?php echo $items['ID']?>">
                                                    <button type="submit" name="updateadminbtn" class="btn btn-info btn-sm">Edit</button>
                                                </form>
                                                <form action="admincode.php" method="POST" class="d-inline-block">
                                                    <input type="hidden" name="admin_id" value="<?php echo $items['ID']?>">
                                                    <button type="submit" onclick="return confirm('Are you sure want to delete admin?');" name="deleteadminbtn" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <?php
                                  }
                               } else {
                                  echo "<tr><td colspan='7' class='text-center'><strong>No records found!</strong></td></tr>";
                               }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
                        if(isset($_SESSION['message']))
                        {
                            $message = $_SESSION['message'];
                            echo "<script>alert('$message')</script>";
                            unset($_SESSION['message']);
                        }
                        ?>
    <?php include("includes/footer.php"); ?>
    <?php include("includes/scripts.php"); ?>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    .card-header {
        border-radius: 15px 15px 0 0;
    }
    .btn {
        border-radius: 5px;
    }
    .table {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .table th, .table td {
        padding: 12px;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-sm {
        padding: 5px 10px;
    }
    .bg-gradient-dark {
        background: linear-gradient(180deg, #2a2a2a, #434343);
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .text-center {
        text-align: center;
    }
</style>
