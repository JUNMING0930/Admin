<?php $page_title = "Add Category"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Add New Categories</h4>
            </div>
                <div class="card-body">
                    <form action="categorycode.php" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><strong>Name</strong></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Category Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Description</strong></label>
                            <textarea rows="3" class="form-control" name="description" placeholder="Enter Category Description" style="border: 1px solid;"></textarea>
                        </div>
                        <div class="col-md-6">
                          <label for=""><strong>Status</strong></label>
                            <input type="checkbox"  name="status">
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="addcategorybtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="categories.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
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
    </div>
    </div>
</div>        
        <br>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>