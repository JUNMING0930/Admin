<?php $page_title = "Edit Category"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $category = getbyid("category",$id);

            if(mysqli_num_rows($category) > 0)
            {
                $data = mysqli_fetch_array($category);
            ?>
                <div class="card ">
                    <div class="card-header">
                    <h4>Edit Categories</h4>
                    </div>
                        <div class="card-body">
                            <form action="categorycode.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="category_id" value="<?php echo $data['ID']?>">
                                    <label for=""><strong>Name</strong></label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['Cate_Name']?>"placeholder="Enter Category Name" required style="border: 1px solid;">
                                </div>
                                <div class="col-md-12">
                                    <label for=""><strong>Description</strong></label>
                                    <textarea rows="3" class="form-control" name="description" placeholder="Enter Category Description" style="border: 1px solid;"> <?php echo $data['Cate_Description']?></textarea>
                                </div>
                                <div class="col-md-6">
                                <label for=""><strong>Status</strong></label>
                                    <input type="checkbox" <?php echo $data['Cate_Status'] ? "checked":"" ?> name="status">
                                </div>
                            </div>
                                <div class="col-md-3 mt-3">
                                <button type="submit" name="updatecategorybtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
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