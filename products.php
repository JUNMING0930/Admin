<?php $page_title = "Products"?>
<?php include("includes/header.php");?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9 mb-lg-0">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Products</h4>
                    <a href="addproduct.php" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
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
                                    // Filter logic based on GET parameters
                                    $conditions = [];
                                    if(isset($_GET['name'])) $conditions[] = "product.Pro_Name LIKE '{$_GET['name']}%'";
                                    if(isset($_GET['cate'])) $conditions[] = "category.Cate_Name LIKE '{$_GET['cate']}%'";
                                    if(isset($_GET['status'])) $conditions[] = "product.Pro_Status = '{$_GET['status']}'";
                                    
                                    $condition_str = implode(' AND ', $conditions);
                                    $product_query = "SELECT product.*, category.Cate_Name AS Cname FROM product, category WHERE category.ID = product.Category_ID" . ($condition_str ? " AND $condition_str" : "");
                                    $product_run = mysqli_query($dataconnection, $product_query);

                                    if(mysqli_num_rows($product_run) > 0) {
                                        foreach($product_run as $items) {
                                            ?>
                                            <tr>
                                                <td><?php echo $items['Pro_Name'];?></td>
                                                <td><?php echo $items['Cname'];?></td>
                                                <td>RM <?php echo $items['Pro_Price'];?></td>
                                                <td><img src="../Admin/uploads/products/<?php echo $items['Pro_Image'];?>" width="100px" height="150px" /></td>
                                                <td><?php echo $items['Pro_Status'] == '1' ? "Enabled" : "Disabled"; ?></td>
                                                <td>
                                                    <form action="editproduct.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?php echo $items['ID'];?>">
                                                        <button type="submit" name="editproductbtn" class="btn btn-primary btn-sm">Edit</button>
                                                    </form>
                                                    <?php if($_SESSION['Role'] == 1) : ?>
                                                    <form action="productcode.php" method="POST" class="d-inline">
                                                        <input type="hidden" name="product_id" value="<?php echo $items['ID'];?>">
                                                        <button type="submit" name="deleteproductbtn" onclick="return confirm('Are you sure to delete this product?');" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'><strong>No Products Available</strong></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-secondary text-white">
                    <h4>Filter</h4>
                </div>
                <div class="card-body">
                    <form action="filter.php" method="POST">
                        <div class="form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" placeholder="Enter Product Name">
                        </div>

                        <div class="form-group mt-3">
                            <label for="cate"><strong>Category</strong></label>
                            <input type="text" class="form-control" name="cate" value="<?php echo isset($_GET['cate']) ? $_GET['cate'] : ''; ?>" placeholder="Enter Product Category">
                        </div>

                        <div class="form-group mt-3">
                            <label for="status"><strong>Status</strong></label>
                            <select name="status" class="form-control">
                                <option value="">- - - - Select Status - - - -</option>
                                <option value="1" <?php echo (isset($_GET['status']) && $_GET['status'] == '1') ? 'selected' : ''; ?>>Enable</option>
                                <option value="0" <?php echo (isset($_GET['status']) && $_GET['status'] == '0') ? 'selected' : ''; ?>>Disable</option>
                            </select>
                        </div>

                        <button type="submit" name="filterprobtn" class="btn btn-dark mt-3" style="float: right;">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Displaying any system messages -->
    <div class="float-end mt-3">
        <?php
            if(isset($_SESSION['dmessage'])) {
                $message = $_SESSION['dmessage'];
                echo "<script>alert('$message')</script>";
                unset($_SESSION['dmessage']);
            } else if(isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                echo "<script>alert('$message')</script>";
                unset($_SESSION['message']);
            }
        ?>
    </div>  
</div>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>

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
    .bg-gradient-primary {
        background: linear-gradient(180deg, #1d2b64, #0e1731);
    }
    .bg-gradient-secondary {
        background: linear-gradient(180deg, #434343, #222222);
    }
    .form-control {
        border-radius: 10px;
        padding: 8px;
    }
    .text-center {
        text-align: center;
    }
</style>
