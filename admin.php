<?php 
$page_title = "Admin";
include("includes/header.php");
?>
<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="addadmin.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-success float-end mb-3"><i class="fa fa-plus"></i> Add New</a>
                <h4>Admin</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Role</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $admin = getalldata("admin_login");
                       if(mysqli_num_rows($admin) > 0)
                       {
                          foreach ($admin as $items) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $items['ID'];?></td>
                              <td><?php echo $items['Admin_Fname'];?></td>
                              <td><?php echo $items['Admin_Lname'];?></td>
                              <td><?php echo $items['Admin_Email'];?></td>
                              <td><?php echo $items['Admin_Phone'];?></td>
                              <td><?php echo $items['Admin_Role']==0 ? "Admin":"Super Admin";?></td>
                              <?php if($items['ID'] != $_SESSION['AID']) : ?>
                              <td><a href="editadmin.php?id=<?php echo $items['ID'];?>" class="btn btn-primary">Edit</a>
                              <form action="admincode.php" method="POST">
                                <input type="hidden" name="admin_id" value="<?php echo $items['ID']?>"></input>
                                <button type="submit" onclick="return confirm('Are you sure want to delete admin?');" name="deleteadminbtn" class="btn btn-danger">Delete</button>
                              </form>
                              </td>
                              <?php endif;?>
                            </tr>
                            <?php
                          }
                       }
                       else
                       {
                        echo "<strong>No records found !</strong>";
                       }
                    ?>
                      <div class="float-end">
                      <?php
                       if(isset($_SESSION['dmessage']))
                       {
                         $message = $_SESSION['dmessage'];
                         echo "<script>alert('$message')</script>";
                         unset($_SESSION['dmessage']);
                       }
                        ?>
                      </div>  
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
      

      <?php include("includes/footer.php");?>
      <?php include("includes/scripts.php");?>