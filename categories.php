<?php $page_title = "Categories"?>
<?php include("includes/header.php");?>
<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="addcategory.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-success float-end mb-3"><i class="fa fa-plus"></i> Add New</a>
                <h4>Categories</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $category = getalldata("category");
                       if(mysqli_num_rows($category) > 0)
                       {
                          foreach ($category as $items) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $items['ID'];?></td>
                              <td><?php echo $items['Cate_Name'];?></td>
                              <td><?php echo $items['Cate_Status'] == '1'? "Enable":"Disable" ?></td>
                              <td><a href="editcategory.php?id=<?php echo $items['ID'];?>" class="btn btn-primary">Edit</a>
                              <?php if($_SESSION['Role'] == 1) : ?>
                              <form action="categorycode.php" method="POST">
                                <input type="hidden" name="category_id" value="<?php echo $items['ID']?>"></input>
                                <button type="submit" name="deletecategorybtn" onclick="return confirm('Are you sure to delete this category?');" class="btn btn-danger">Delete</button>
                              </form>
                              <?php endif;?>
                              </td>
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