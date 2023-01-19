<?php $page_title = "Products"?>
<?php include("includes/header.php");?>

<div class="container">
    <div class="row">
        <div class="col-lg-9 mb-lg-0">
            <div class="card z-index-2">
                <div class="card-header">
                <a href="addproduct.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-success float-end mb-3"><i class="fa fa-plus"></i> Add New</a>
                    <h4>Products</h4>
                </div>
                <div class="card-body">
                    <div class = "table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET['name']))
                                    {
                                        $Name = $_GET['name'];
                                        if(isset($_GET['cate']))
                                        {
                                            $Cate = $_GET['cate'];
                                            if(isset($_GET['status']))
                                            {
                                                $Status = $_GET['status'];
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name LIKE '$Name%' AND category.Cate_Name LIKE '$Cate%' AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                            else
                                            {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name LIKE '$Name%' AND category.Cate_Name LIKE '$Cate%'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                        }
                                        else if(isset($_GET['status']))
                                        {
                                                $Status = $_GET['status'];
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name LIKE '$Name%' AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                        }
                                        else
                                        {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name LIKE '$Name%'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                        }
                                    }
                                    else
                                    {
                                        if(isset($_GET['cate']))
                                        {
                                            $Cate = $_GET['cate'];
                                            if(isset($_GET['status']))
                                            {
                                                $Status = $_GET['status'];
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND category.Cate_Name LIKE '$Cate%' AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                            else
                                            {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND category.Cate_Name LIKE '$Cate%'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                        }
                                        else if(isset($_GET['status']))
                                        {
                                                $Status = $_GET['status'];
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                        }
                                        else 
                                        {
                                            $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID";
                                            $product_run = mysqli_query($dataconnection,$product);
                                            
                                        }
                                    }
                                    if(mysqli_num_rows($product_run) > 0)
                                    {
                                                foreach($product_run as $items)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $items['Pro_Name'];?></td>
                                                        <td><?php echo $items['Cname'];?></td>
                                                        <td>RM <?php echo $items['Pro_Price'];?></td>
                                                        <td><image src = "../Admin/uploads/products/<?php echo $items['Pro_Image'];?>" width = "100px" height = "150px" /></td>
                                                        <td><?php echo $items['Pro_Status'] == '1'? "Enable":"Disable" ?></td>
                                                        <td><a href="editproduct.php?id=<?php echo $items['ID'];?>" class="btn btn-primary">Edit</a>
                                                        <?php if($_SESSION['Role'] == 1) : ?>
                                                        <form action="productcode.php" method="POST">
                                                            <input type="hidden" name="product_id" value="<?php echo $items['ID']?>"></input>
                                                            <button type="submit" name="deleteproductbtn" onclick="return confirm('Are you sure want to delete this product?');" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        <?php endif;?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                    }
                                    else
                                    {
                                                echo "No Product Available";
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
        <div class="col-lg-3">
            <div class="card z-index-2">
                <div class="card-header">
                    <h4>Filter</h4>                          
                </div>
                <div class="card-body">
                        <form action="filter.php?id=<?php echo $_SESSION['AID']?>"  method="POST">
                        <div class="col">
                            <label for=""><strong>Name</strong></label>
                            <?php
                            if(isset($_GET['name']))
                            {
                                $Name = $_GET['name'];
                                ?>
                                <input type="text" class="form-control" name="name" placeholder="Enter Product Name"  value=<?php echo $Name?> style="border: 1px solid;">
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="text" class="form-control" name="name" placeholder="Enter Product Name"  style="border: 1px solid;">
                                <?php
                            }
                            ?>
                            
                        </div>
                        <div class="col mt-3">
                            <label for=""><strong>Category</strong></label>
                            <?php
                            if(isset($_GET['cate']))
                            {
                                $Cate = $_GET['cate'];
                                ?>
                                <input type="text" class="form-control" name="cate" placeholder="Enter Product Category"  value=<?php echo $Cate?> style="border: 1px solid;">
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="text" class="form-control" name="cate" placeholder="Enter Product Category"  style="border: 1px solid;">
                                <?php
                            }
                            ?>
                            
                        </div>
                        <div class="col mt-3">
                            <label for=""><strong>Status</strong></label>
                            <select name="status" class="form-control border border-dark">
                                <option value="">- - - - - Select Status - - - - -</option>
                            <?php
                            if(isset($_GET['status']))
                            {
                                $Status = $_GET['status'];
                                if($Status == "1")
                                {
                                ?>
                                <option value="<?php echo $Status ?>" <?php echo $Status=='1'? "selected":""?> >Enable</option>
                                <option value="0">Disable</option>       
                                <?php
                                }
                                else if($Status == "0")
                                {
                                ?>
                                    <option value="1">Enable</option>
                                    <option value="<?php echo $Status ?>" <?php echo $Status=="0"? "selected":""?> >Disable</option>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                                <?php
                            }
                            ?>    
                            </select>
                        </div>
                        <div class="col mt-3">
                            <button type="submit" name="filterprobtn"  class="btn btn-light" style="float:right">Filter</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>    


<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>