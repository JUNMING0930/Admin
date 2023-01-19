<?php $page_title = "Edit Products Stocks"?>
<?php include("includes/header.php");?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
            <h4>Edit Products' Stocks</h4>
            </div>
                <div class="card-body">
                    <form action="stockcode.php" method="POST">
                    <div class="row">
                        <div class = "col-md-12 mb-3">
                            <?php
                            if(isset($_GET['id']))
                            {
                                $Stock_ID = $_GET['id'];
                                $Selected_Stock = getbyid("stock",$Stock_ID);
                                if(mysqli_num_rows($Selected_Stock)>0)
                                {
                                    $Stock_Row = mysqli_fetch_array($Selected_Stock);
                                    $Stock_Cate = $Stock_Row['Category_ID'];
                                    $Stock_Pro = $Stock_Row['Product_ID'];
                                
                                    $Cate_Name = "SELECT Cate_Name FROM category WHERE ID = $Stock_Cate";
                                    $Cate_Name_run = mysqli_query($dataconnection,$Cate_Name);
                                    $Pro_Name = "SELECT Pro_Name FROM product WHERE ID = $Stock_Pro";
                                    $Pro_Name_run = mysqli_query($dataconnection,$Pro_Name);

                                    if(mysqli_num_rows($Cate_Name_run)>0 && mysqli_num_rows($Pro_Name_run) > 0)
                                    {
                                        $Cate = mysqli_fetch_array($Cate_Name_run);
                                        $Pro = mysqli_fetch_array($Pro_Name_run);
                                        ?>
                                        <div class="col-md-6">
                                            <input type="hidden" name="stock_id" value="<?php echo $Stock_Row['ID']?>">
                                            <label for=""><strong>Category</strong></label>
                                            <input type="text" readonly class="ms-3 mb-3" name="cate"  required style="border: 0px;" value = <?php echo $Cate['Cate_Name']?>>
                                        </div>
                                        <div class="col-md-6">
                                            <label for=""><strong>Product</strong></label>
                                            <input type="text" readonly class="ms-3 mb-3" name="pro"  required style="border: 0px;" value = <?php echo $Pro['Pro_Name']?>>
                                        </div>
                                        <div class="col-md-6">
                                            <label for=""><strong>Size</strong></label>
                                            <input type="text" readonly class="ms-3 mb-3" name="size"  required style="border: 0px;" value = <?php echo $Stock_Row['Product_Size']?>>
                                        </div>
                                        <div class="col-md-6">
                                            <label for=""><strong>Quantity</strong></label>
                                            <input type="text" class="ms-3 mb-3" name="quantity"  required style="border: 1px Solid;" placecholder="Please Enter Quantity" value = <?php echo $Stock_Row['Product_Quantity']?>>
                                        </div>
                                        <?php
                                        

                                    }

                                }
                            }     
                            ?>
                        <div class="col-md-3 mt-3">
                        <button type="submit" name="editstockbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
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
<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>