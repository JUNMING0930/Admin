<?php $page_title = "Categories"?>
<?php include("includes/header.php");?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Categories</h4>
                    <a href="addcategory.php" class="btn btn-success float-end mb-3"><i class="fa fa-plus"></i> Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
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
                                          <td><?php echo $items['Cate_Status'] == '1'? "Enabled":"Disabled" ?></td>
                                          <td>
                                            <form action="editcategory.php" method="POST">
                                                <input type="hidden" name="category_id" value="<?php echo $items['ID']?>"></input>
                                                <button type="submit" name="updatecategorybtn" class="btn btn-primary btn-sm">Edit</button>
                                            </form>
                                            <?php if($_SESSION['Role'] == 1) : ?>
                                            <form action="categorycode.php" method="POST" class="d-inline">
                                                <input type="hidden" name="category_id" value="<?php echo $items['ID']?>"></input>
                                                <button type="submit" name="deletecategorybtn" onclick="return confirm('Are you sure to delete this category?');" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <?php endif;?>
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                   }
                                   else
                                   {
                                    echo "<tr><td colspan='4' class='text-center'><strong>No records found!</strong></td></tr>";
                                   }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Display Messages -->
    <div class="float-end">
        <?php
            if(isset($_SESSION['dmessage']))
            {
                $message = $_SESSION['dmessage'];
                echo "<script>alert('$message')</script>";
                unset($_SESSION['dmessage']);
            }
            else if(isset($_SESSION['message']))
            {
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
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .text-center {
        text-align: center;
    }
</style>
