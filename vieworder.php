<?php $page_title = "View Order"?>
<?php include("includes/header.php");?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card z-index-2">
        <div class="card-header">
        <h4>View Orders</h4>
        </div>
        <div class="card-body">
            
        <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Size</th>
                      <th>Unit Price</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $ptotal = 0;
                       $gtotal = 0;
                       $Order_ID = $_GET['id'];
                       $Order = "SELECT * FROM orders_details WHERE Order_ID = '$Order_ID'";
                       $Order_Run = mysqli_query($userconnection,$Order);
                       if(mysqli_num_rows($Order_Run) > 0)
                       {
                          foreach ($Order_Run as $items) 
                          {
                            $Product_ID = $items['Product_ID'];
                            $Product = "SELECT * FROM product WHERE ID = '$Product_ID'";
                            $Product_Run = mysqli_query($dataconnection,$Product);
                            $Pro_Row = mysqli_fetch_array($Product_Run);
                            $ptotal = $Pro_Row['Pro_Price'] * $items['Order_Quantity'];
                            $gtotal += $ptotal;
                            ?>
                            <tr>
                              <td><?php echo $Pro_Row['Pro_Name'];?></td>
                              <td><?php echo $items['Order_Quantity'];?></td>
                              <td><?php echo $items['Order_Size']?></td>
                              <td>RM <?php echo $Pro_Row['Pro_Price']?>
                              <td>RM <?php echo $ptotal?>
                              </td>
                            </tr>
                            <?php
                          }
                       }
                    ?>
                <tr>
                    <td colspan="4" style="text-align:right"><strong>Grand Total</strong></td>
                    <td>RM <?php echo $gtotal?></td>
                </tr>    
                </tbody>
                </table>    
                <table class="table table-bordered table-striped">
                <thead>    
                <?php
                    $Orders = "SELECT * FROM orders WHERE id = '$Order_ID' LIMIT 1";
                    $Orders_Run = mysqli_query($userconnection,$Orders);   
                    $Orders_Row = mysqli_fetch_array($Orders_Run);
                ?>
                 <tr>
                    <td><strong>Customer Name</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['fname']?> <?php echo $Orders_Row['lname']?> </td>
                </tr>
                <tr>
                    <td><strong>Shipping Address</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['address']?></td>
                </tr>
                <tr>
                    <td><strong>Phone Number</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['phone']?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td colspan="4" ><?php echo $Orders_Row['email']?></td>
                </tr>
                <form action="ordercode.php?id=<?php echo $_SESSION['AID']?>" method="POST">
                <input type="hidden" name="order_id" value=<?php echo $Order_ID?>>
                <tr>
                    <td><strong>Status</strong></td>
                    <td colspan="4" ><select name="Status" class="form-control border border-dark">
                    <?php
                    if($Orders_Row['Status'] == 0)
                    {
                        ?>
                        <option value="0" selected>Packaging</option>
                        <option value="1">Shipping</option>
                        <option value="2">Delivered</option>
                        <option value="3">Canceled</option>
                        <?php
                    }
                    else if($Orders_Row['Status'] == 1)
                    {
                      ?>
                        <option value="0">Packaging</option>
                        <option value="1" selected>Shipping</option>
                        <option value="2">Delivered</option>
                        <option value="3">Canceled</option>
                        <?php
                    }
                    else if($Orders_Row['Status'] == 2)
                    {
                      ?>
                        <option value="0">Packaging</option>
                        <option value="1">Shipping</option>
                        <option value="2"selected>Delivered</option>
                        <option value="3">Canceled</option>
                        <?php
                    }
                    else if($Orders_Row['Status'] == 3)
                    {
                      ?>
                        <option value="0">Packaging</option>
                        <option value="1">Shipping</option>
                        <option value="2">Delivered</option>
                        <option value="3" selected>Canceled</option>
                        <?php
                    }
                    ?>
                    </select>
                    </td>
                </tr>
                </tbody>
                </table>
          <div class="col-md-6">
          <button type="submit" name="updateorderbtn" class="btn btn-success mb-3"><i class="fa fa-check-circle"></i> Save</button>
          <a href="orders.php?id=<?php echo $_SESSION['AID'] ?>" class="btn btn-light mb-3"><i class="fa fa-angle-double-left" ></i> Return</a>
          </div>      
          </form>  
        </div>        
      </div>
    </div>
  </div>
</div>
<?php
						if(isset($_SESSION['message']))
						{
							$message = $_SESSION['message'];
							echo "<script>alert('$message')</script>";
							unset($_SESSION['message']);
						}
						?>

      <?php include("includes/footer.php");?>
      <?php include("includes/scripts.php");?>