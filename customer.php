<?php $page_title = "Customers"?>
<?php include("includes/header.php");?>

<div class="container">
    <div class="row">
        <div class="col-lg-9 mb-lg-0">
            <div class="card z-index-2">
                <div class="card-header">
                    <h4>Customers List</h4>
                </div>
                <div class="card-body">
                    <div class = "table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php
                                    /*
                                    if(isset($_GET['name']))
                                    {
                                        $Name = $_GET['name'];
                                        if(isset($_GET['email']))
                                        {
                                            $Email = $_GET['email'];
                                            if(isset($_GET['gender']))
                                            {
                                                $Gender = $_GET['gender'];
                                                if(isset($_GET['status']))
                                                {
                                                    $Status = $_GET['status'];
                                                    $Customer = "SELECT * FROM user WHERE User_First_Name,User_Last_Name = '$Name'";
                                                    $Customer_run = mysqli_query($userconnection,$Customer);
                                                }
                                                else
                                                {
                                                    $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name = '$Name' AND category.Cate_Name = '$Cate' AND product.Pro_Status = '$Status'";
                                                    $product_run = mysqli_query($dataconnection,$product);
                                                }
                                                }
                                                
                                            else
                                            {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name = '$Name' AND category.Cate_Name = '$Cate'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                        }
                                        else if(isset($_GET['status']))
                                        {
                                                $Status = $_GET['status'];
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name = '$Name' AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                        }
                                        else
                                        {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND product.Pro_Name = '$Name'";
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
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND category.Cate_Name = '$Cate' AND product.Pro_Status = '$Status'";
                                                $product_run = mysqli_query($dataconnection,$product);
                                            }
                                            else
                                            {
                                                $product = "SELECT product.*, category.Cate_Name AS Cname FROM product,category WHERE category.ID = product.Category_ID AND category.Cate_Name = '$Cate'";
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
                                    */
                                    $Customer = "SELECT * FROM user";
                                    $Customer_run = mysqli_query($userconnection,$Customer);
                                    
                                    if(mysqli_num_rows($Customer_run) > 0)
                                    {
                                                foreach($Customer_run as $items)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $items['User_First_Name']." ".$items['User_Last_Name'];?></td>
                                                        <td><?php echo $items['User_Email'];?></td>
                                                        <td><?php echo $items['User_Status'] == '1'? "Enable":"Disable" ?></td>
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
        <?php
        /*
        <div class="col-lg-3">
            <div class="card z-index-2">
                <div class="card-header">
                    <h4>Filter</h4>                          
                </div>
                <div class="card-body">
                        <form action="filter.php?id=<?php echo $_SESSION['ID']?>"  method="POST">
                        <div class="col">
                            <label for=""><strong>Name</strong></label>
                            
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
                            <label for=""><strong>Email</strong></label>
                            <?php
                            if(isset($_GET['email']))
                            {
                                $Email = $_GET['email'];
                                ?>
                                <input type="text" class="form-control" name="email" placeholder="Enter Product Category"  value=<?php echo $Email?> style="border: 1px solid;">
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="text" class="form-control" name="email" placeholder="Enter Product Category"  style="border: 1px solid;">
                                <?php
                            }
                            ?>
                            
                        </div>
                        <div class="col-mt-3">
                            <label for=""><strong>Gender</strong></label>
                            <select name="gender" class="form-control border border-dark" >
                                <option value="">---Select Gender---</option>
                                <?php
                                if(isset($_GET['gender']))
                                {
                                    $Gender = $_GET['gender'];
                                    if($Gender == "Male")
                                    {
                                        ?>
                                        <option value="<?php echo $Gender?>" <?php echo $Gender == "Male" ? "selected":"" ?>>Male</option>
                                        <option value="Female">Female</option>
                                        <?php
                                    }
                                    else if($Gender == "Female")
                                    {
                                        ?>
                                        <option value="Male">Male</option>
                                        <option value="<?php echo $Gender?>" <?php echo $Gender == "Female" ? "selected":"" ?>>Female</option>
                                        <?php
                                    }
                                }    
                                else
                                {
                                    ?>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <?php
                                }
                                ?>
                            </select>
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
                                <option value="<?php echo $Status ?>" <?php echo $Status='1'? "selected":""?> >Enable</option>
                                <option value="0">Disable</option>       
                                <?php
                                }
                                else if($Status == "0")
                                {
                                ?>
                                    <option value="1">Enable</option>
                                    <option value="<?php echo $Status ?>" <?php echo $Status="1"? "selected":""?> >Disable</option>
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
                            <button type="submit" name="filtercusbtn"  class="btn btn-light" style="float:right">Filter</button>
                        </div>
                        </form>
                        */
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>    


<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>