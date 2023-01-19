<?php $page_title = "Orders"?>
<?php include("includes/header.php");?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card z-index-2">
        <div class="card-header">
        <h4>Orders</h4>
        <div class="row">
          <div class = "col-md-3">
          <form action="orders.php?id=<?php echo $_SESSION['AID']?>"  method="POST">
          <div class="input-group input-group-outline">
            <input type="text" class="form-control" name="keyword" placeholder="Order ID">
            <button style="margin-left:10px" type="submit" class="btn btn-outline-primary btn-sm mb-0 me-3">Search</a>
          </div>
			    </form>
          </div>
        </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer Name</th>
                      <th>Amount Paid</th>
                      <th>Payment Method</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_POST['keyword']))
                      {
                        $ID = $_POST['keyword'];
                        if(!preg_match('/^[0-9]+$/', $ID))
                        {
                          echo "<strong>Please Enter Valid Order ID!</strong>";
                          ?>
                          <br/>
                          <?php
                        }
                        else
                        {
                          $orders = "SELECT * FROM orders WHERE id = '$ID'" ;
                          $orders_run = mysqli_query($userconnection,$orders);
                        }
                        $orders = "SELECT * FROM orders WHERE id = '$ID'" ;
                        $orders_run = mysqli_query($userconnection,$orders);
                      }
                      else
                      {
                        $orders = "SELECT * FROM orders ORDER BY id DESC" ;
                        $orders_run = mysqli_query($userconnection,$orders);
                      }
                       if(mysqli_num_rows($orders_run) > 0)
                       {
                          foreach ($orders_run as $items) 
                          {
                                ?>
                                <tr>
                                <td><?php echo $items['id'];?></td>
                                <td><?php echo $items['fname'] ?> <?php echo $items['lname']?></td>
                                <td>RM <?php echo $items['amount_paid'] ?></td>
                                <td>
                                <?php
                                if($items['payment_method'] == 'COD')
                                {
                                  echo "Cash On Delivery";
                                }
                                else
                                {
                                  echo "Credit/Debit Card";
                                }
                                ?>
                                </td>
                                <td><?php echo $items['email']?></td>
                                <td>
                                <?php
                                if($items['Status'] == 0)
                                {
                                    echo "Packaging";
                                }
                                else if($items['Status'] == 1)
                                {
                                  echo "Shipping";
                                }
                                else if($items['Status'] == 2)
                                {
                                  echo "Delivered";
                                }
                                else if($items['Status'] == 3)
                                {
                                  echo "Canceled";
                                }
                                ?>
                                </td>
                                
                                <td><a href="vieworder.php?id=<?php echo $items['id']?>" class="btn btn-primary">View</a>
                                <form action="ordercode.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $items['id']?>"></input>
                                </form>
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
                            echo "<strong>$message</strong>";
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
</div>
      

      <?php include("includes/footer.php");?>
      <?php include("includes/scripts.php");?>