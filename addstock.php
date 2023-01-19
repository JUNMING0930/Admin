<?php $page_title = "Add Products' Stock"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Add Products' Stocks</h4>
            </div>
                <div class="card-body">
                    <form action="stockcode.php" method="POST">
                    <div class="row">
                        <div class = "col-md-12 mb-3">
                            <label for=""><strong>Categories</strong></label>
                            <?php
                                if(!isset($_GET['cate']))
                                {
                                    $category = "SELECT * FROM category WHERE Cate_Status = 1 ";
                                    $category_run = mysqli_query($dataconnection,$category);
                                    if(mysqli_num_rows($category_run)>0)
                                    {
                                        ?>
                                            <select name="category_id" id="cate" required class="form-control border border-dark" onchange="Pro()">
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
                                }        
                                else
                                {
                                    $Cate = $_GET['cate'];
                                    $category = "SELECT * FROM category WHERE Cate_Status = 1";
                                    $category_run = mysqli_query($dataconnection,$category);
                                    if(mysqli_num_rows($category_run)>0)
                                    {
                                        ?>
                                            <select name="category_id" id="cate" required class="form-control border border-dark" onchange="Pro()">
                                                <option value="">---Select Categories---</option>
                                                <?php
                                                    foreach($category_run as $data)
                                                    {
                                                        ?>
                                                            <option value="<?php echo $data['ID']?>" <?php echo $data['ID'] == $Cate ? 'selected':''?>> <?php echo $data['Cate_Name']?></option>
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
                                        <label for="" class="form-control"><strong>Products' Name</strong></label>
                                    <?php
                                    $product = "SELECT product.ID AS ID ,product.Pro_Name AS PName FROM product,category WHERE product.Category_ID = category.ID AND category.ID = '$Cate'";
                                    $product_run = mysqli_query($dataconnection,$product);
                                    if(mysqli_num_rows($product_run)>0)
                                    {
                                        ?>
                                            <select name="product_id" required class="form-control border border-dark">
                                                <option value="">---Select Products---</option>
                                                <?php
                                                    foreach($product_run as $pro)
                                                    {
                                                        ?>
                                                            <option value="<?php echo $pro['ID']?>"> <?php echo $pro['PName']?></option>
                                                        <?php    
                                                    }
                                                        ?>        
                                            </select>
                                    <?php           
                                    }
                                    else
                                    {
                                        echo "No Products Available";
                                    }
                                }
                            
                        ?>    
                        <div class="col-md-6">
                            <label for=""><strong>Size</strong></label>
                            <select name="stock_size" required class="form-control border border-dark">
                                <option value="">---Select Size---</option>
                        </div>    
                                <?php
                                    $Size = getalldata("size");
                                    if(mysqli_num_rows($Size)>0)
                                    {
                                        foreach($Size as $All_Size)
                                        {
                                            ?>
                                                <option value="<?php echo $All_Size['EUsize']?>"><?php echo $All_Size['EUsize']?></option> 
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong>Quantity</strong></label>
                            <input type="text" class="form-control" name="quantity" placeholder="Enter Product Quantity" style="border: 1px solid;"></textarea>
                        </div>
                    </div>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="addstockbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
                        <a href="stocks.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
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

                                <script>
                                    function Pro()
                                    {
                                        var Cate = document.getElementById("cate").value;
                                        self.location="addstock.php?id=<?php echo $_SESSION['AID'] ?>&cate=" + Cate;
                                    }
                                </script>        
<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>