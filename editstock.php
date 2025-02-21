<?php $page_title = "Edit Products' Stocks"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="font-weight-bold">Edit Products' Stocks</h4>
                </div>
                <div class="card-body">
                    <form action="stockcode.php" method="POST">
                        <?php
                        if (isset($_POST['stock_id']) || isset($_SESSION['stock_id'])) {
                            $Stock_ID = isset($_POST['stock_id']) ? $_POST['stock_id'] : $_SESSION['stock_id'];
                            unset($_SESSION['stock_id']);

                            $Selected_Stock = getbyid("stock", $Stock_ID);
                            if (mysqli_num_rows($Selected_Stock) > 0) {
                                $Stock_Row = mysqli_fetch_array($Selected_Stock);
                                $Stock_Cate = $Stock_Row['Category_ID'];
                                $Stock_Pro = $Stock_Row['Product_ID'];

                                $Cate_Name_Query = "SELECT Cate_Name FROM category WHERE ID = $Stock_Cate";
                                $Pro_Name_Query = "SELECT Pro_Name FROM product WHERE ID = $Stock_Pro";

                                $Cate_Name_run = mysqli_query($dataconnection, $Cate_Name_Query);
                                $Pro_Name_run = mysqli_query($dataconnection, $Pro_Name_Query);

                                if (mysqli_num_rows($Cate_Name_run) > 0 && mysqli_num_rows($Pro_Name_run) > 0) {
                                    $Cate = mysqli_fetch_array($Cate_Name_run);
                                    $Pro = mysqli_fetch_array($Pro_Name_run);
                        ?>
                                    <input type="hidden" name="stock_id" value="<?php echo $Stock_Row['ID']; ?>">

                                    <div class="row">
                                        <!-- Category Display -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cate"><strong>Category</strong></label>
                                            <input type="text" id="cate" name="cate" class="form-control" value="<?php echo htmlspecialchars($Cate['Cate_Name']); ?>" readonly>
                                        </div>

                                        <!-- Product Display -->
                                        <div class="col-md-6 mb-3">
                                            <label for="pro"><strong>Product</strong></label>
                                            <input type="text" id="pro" name="pro" class="form-control" value="<?php echo htmlspecialchars($Pro['Pro_Name']); ?>" readonly>
                                        </div>

                                        <!-- Size Display -->
                                        <div class="col-md-6 mb-3">
                                            <label for="size"><strong>Size</strong></label>
                                            <input type="text" id="size" name="size" class="form-control" value="<?php echo htmlspecialchars($Stock_Row['Product_Size']); ?>" readonly>
                                        </div>

                                        <!-- Quantity Input -->
                                        <div class="col-md-6 mb-3">
                                            <label for="quantity"><strong>Quantity</strong></label>
                                            <input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo $Stock_Row['Product_Quantity']; ?>" required placeholder="Enter Quantity" min="1">
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" name="editstockbtn" class="btn btn-success"><i class="fa fa-check-circle"></i> Save</button>
                            <a href="stocks.php" class="btn btn-light"><i class="fa fa-angle-double-left"></i> Return</a>
                        </div>

                        <!-- Feedback Message -->
                        <?php if (isset($_SESSION['message'])) { ?>
                            <div class="alert alert-info mt-3">
                                <?php
                                echo htmlspecialchars($_SESSION['message']);
                                unset($_SESSION['message']);
                                ?>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
