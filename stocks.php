<?php $page_title = "Stocks"?>
<?php include("includes/header.php");?>

<head>
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
</head>


<div class="container">
  <div class="row">
    <div class="col-lg-9 mb-lg-0">
      <div class="card z-index-2">
        <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
        <h4>Stocks Management</h4>
        <a href="addstock.php" class="btn btn-success float-end mb-3"><i class="fa fa-plus"></i> Add New</a>
        </div>
        
        <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <th>Product Size</th>
                      <th>Product Quantity</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($_GET['cate']))
                    {
                      $cate = $_GET['cate'];
                      if(isset($_GET['pro']))
                      {
                        $product = $_GET['pro'];
                        if(isset($_GET['size']))
                        {
                          $size = $_GET['size'];
                          $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Category_ID = '$cate' AND stock.Product_ID = '$product' AND stock.Product_Size = '$size' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                          $stocks_run = mysqli_query($dataconnection,$stocks);
                        }
                        else
                        {
                          $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Category_ID = '$cate' AND stock.Product_ID = '$product' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                          $stocks_run = mysqli_query($dataconnection,$stocks);
                        }
                      }
                      else if(isset($_GET['size']))
                      {
                        $size = $_GET['size'];
                        $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Category_ID = '$cate' AND stock.Product_Size = '$size' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                        $stocks_run = mysqli_query($dataconnection,$stocks);
                      }
                      else
                      {
                        $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Category_ID = '$cate' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                        $stocks_run = mysqli_query($dataconnection,$stocks);
                      }
                    }
                    else if(isset($_GET['pro']))
                    {
                      $product = $_GET['pro'];
                      if(isset($_GET['size']))
                      {
                        $size = $_GET['size'];
                        $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Product_ID = '$product' AND stock.Product_Size = '$size' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                        $stocks_run = mysqli_query($dataconnection,$stocks);
                      }
                      else
                      {
                        $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Product_ID = '$product' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                        $stocks_run = mysqli_query($dataconnection,$stocks);
                      }
                    }
                    else if(isset($_GET['size']))
                    {
                      $size = $_GET['size'];
                      $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID AND stock.Product_Size = '$size' ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                      $stocks_run = mysqli_query($dataconnection,$stocks);
                    }
                    else
                    {
                      $stocks = "SELECT stock.*, category.ID AS CId,category.Cate_Name AS CName,product.ID AS PiD, product.Pro_Name AS PName FROM stock,product,category WHERE stock.Category_ID = category.ID AND stock.Product_ID = product.ID ORDER BY category.ID ASC,product.ID ASC,stock.Product_Size ASC" ;
                      $stocks_run = mysqli_query($dataconnection,$stocks);
                    }
                       if(mysqli_num_rows($stocks_run) > 0)
                       {
                          foreach ($stocks_run as $items) 
                          {
                            ?>
                            <tr>
                              <td><?php echo $items['CName'];?></td>
                              <td><?php echo $items['PName'] ?></td>
                              <td><?php echo $items['Product_Size'] ?></td>
                              <td><?php echo $items['Product_Quantity'] ?></td>
                              <td>
                              <form action="editstock.php" method="POST">
                              <input type="hidden" name="stock_id" value="<?php echo $items['ID']?>"></input>
                              <button type="submit" name="updatestockbtn" class="btn btn-primary">Edit</button>
                              </form>
                              <?php if($_SESSION['Role'] == 1) : ?>
                              <form action="stockcode.php" method="POST">
                              <input type="hidden" name="stock_id" value="<?php echo $items['ID']?>"></input>
                              <button type="submit" name="deletestockbtn" onclick="return confirm('Are you sure want to delete this stock?');" class="btn btn-danger">Delete</button>
                              </form>
                              <?php endif;?>                          
                              </td>
                            </tr>
                            <?php
                          }
                       }
                       else
                       {
                        echo "<strong>No records found !</strong>";
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
                         else if(isset($_SESSION['message']))
                          {
                          $message = $_SESSION['message'];
                          echo "<script>alert('$message')</script>";
                          unset($_SESSION['message']);
                          }
                        ?>
                      </div>  
                  </tbody>
                </table>
        </div>        
      </div>
    </div>
    <div class="col-lg-3">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-secondary text-white">
                    <h4>Filter</h4>                          
                </div>
                <div class="card-body">
                        <form action="filter.php"  method="POST">
                        <div class="col">
                            <label for=""><strong>Category</strong></label>
                            <select name="category" class="form-control ">
                            <option value="">- - - -Select Category- - - -</option>
                            <?php
                            $Cate = "SELECT * FROM category WHERE Cate_Status='1'";
                            $Cate_Run = mysqli_query($dataconnection,$Cate);
                            if(isset($_GET['cate']))
                            {
                              $Category = $_GET['cate'];
                              if(mysqli_num_rows($Cate_Run)>0)
                              {
                                foreach($Cate_Run AS $Cate_Items)
                                {
                                  ?>
                                    <option value="<?php echo $Cate_Items['ID']?>" <?php echo $Cate_Items['ID'] == $Category ? "selected":""?>><?php echo $Cate_Items['Cate_Name']?></option>
                                  <?php
                                }
                              }
                              else
                              {
                                echo "No Category Available";
                              }
                            }
                            else
                            {
                              if(mysqli_num_rows($Cate_Run)>0)
                              {
                                foreach($Cate_Run AS $Cate_Items)
                                {
                                  ?>
                                    <option value="<?php echo $Cate_Items['ID']?>"><?php echo $Cate_Items['Cate_Name']?></option>
                                  <?php
                                }
                              }
                              else
                              {
                                echo "No Category Available";
                              }
                            }
                            ?>
                        </select>    
                        </div>
                        <div class="col mt-3">
                        <label for=""><strong>Product</strong></label>
                            <select name="product" class="form-control ">
                            <option value="">- - - -Select Product- - - - </option>
                            <?php
                            $Product = "SELECT product.* FROM product,category WHERE product.Pro_Status = '1' AND category.Cate_Status='1' AND product.Category_ID = category.ID";;
                            $Product_Run = mysqli_query($dataconnection,$Product);
                            if(isset($_GET['pro']))
                            {
                              $Pro = $_GET['pro'];
                              {
                                if(mysqli_num_rows($Product_Run)>0)
                                {
                                  foreach($Product_Run AS $Product_Items)
                                  {
                                    ?>
                                      <option value="<?php echo $Product_Items['ID']?>" <?php echo $Product_Items['ID'] == $Pro ? "selected":""?>><?php echo $Product_Items['Pro_Name']?></option>
                                    <?php
                                  }
                                }
                                else
                                {
                                  echo "No Product Available";
                                }
                              }
                            }
                            else
                            {
                              if(mysqli_num_rows($Product_Run)>0)
                              {
                                foreach($Product_Run AS $Product_Items)
                                {
                                  ?>
                                    <option value="<?php echo $Product_Items['ID']?>"><?php echo $Product_Items['Pro_Name']?></option>
                                  <?php
                                }
                              }
                              else
                              {
                                echo "No Product Available";
                              }
                            }
                            
                            ?>
                        </select>
                        </div>
                        <div class="col mt-3">
                        <label for=""><strong>Size</strong></label>
                            <select name="size" class="form-control ">
                            <option value="">- - - -Select Size- - - -</option>
                            <?php
                            $Size = "SELECT * FROM size";
                            $Size_Run = mysqli_query($dataconnection,$Size);
                            if(isset($_GET['size']))
                            {
                              $SIZE = $_GET['size'];
                              if(mysqli_num_rows($Size_Run)>0)
                              {
                                foreach($Size_Run AS $Size_Items)
                                {
                                  ?>
                                    <option value="<?php echo $Size_Items['EUsize']?>" <?php echo $Size_Items['EUsize'] == $SIZE ? "selected":""?>><?php echo $Size_Items['EUsize']?></option>
                                  <?php
                                }
                              }
                              else
                              {
                                echo "No Size Available";
                              }
                            }
                            else
                            {
                              if(mysqli_num_rows($Size_Run)>0)
                              {
                                foreach($Size_Run AS $Size_Items)
                                {
                                  ?>
                                    <option value="<?php echo $Size_Items['EUsize']?>"><?php echo $Size_Items['EUsize']?></option>
                                  <?php
                                }
                              }
                              else
                              {
                                echo "No Size Available";
                              }
                            }
                            ?>
                        </select>
                        </div>
                        <div class="col mt-3">
                            <button type="submit" name="filterstockbtn"  class="btn btn-dark mt-3" style="float:right">Filter</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
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
      