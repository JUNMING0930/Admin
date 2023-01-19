<?php $page_title = "Add Product"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Add New Products</h4>
            </div>
                <div class="card-body">
                    <form action="productcode.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class = "col-md-12 mb-3">
                            <label for=""><strong>Categories</strong></label>
                            <?php
                                $category = "SELECT * FROM category WHERE Cate_Status = 1 ";
                                $category_run = mysqli_query($dataconnection,$category);
                                if(mysqli_num_rows($category_run)>0)
                                {
                                    ?>
                                        <select name="category_id" required class="form-control border border-dark">
                                            <option value="">---Select Categories---</option>
                                            <?php
                                                foreach($category_run as $data)
                                                {
                                                    ?>
                                                        <option value="<?php echo $data['ID']?>"> <?php echo $data['Cate_Name']?></option>
                                                    <?php    
                                                }
                                                ?>        
                                        </select>
                                 <?php             
                                }
                                else
                                {
                                    
                                    echo "No Categories Available";
                                }
                            ?>

                        </div>    
                        <div class="col-md-6">
                            <label for=""><strong>Name</strong></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-12">
                            <label for=""><strong>Description</strong></label>
                            <textarea wrap="hard" class="form-control" name="description" placeholder="Enter Product Description" style="border: 1px solid;"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Price</strong></label>
                            <input type="text" class="form-control" name="price" placeholder="Enter Product Price" required style="border: 1px solid;">
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Image</strong></label>
                            <input type="file" class="form-control" name="image" style="border: 1px solid;">
                        </div>
                        <div class="col-md-6 mt-5">
                          <label for=""><strong>Status</strong></label>
                            <input type="checkbox"  name="status">
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="addproductbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="products.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
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