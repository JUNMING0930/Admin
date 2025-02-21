<?php $page_title = "Orders"?>
<?php include("includes/header.php");?>
<div class="container">
  <div class="row">
    <div class="col">
      <div class="card z-index-2">
        <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
        <h4>Orders</h4>
        <div class="row">
          <div class = "col-md-8">
          <form action="orders.php"  method="POST">
          <div class="input-group input-group-outline">
            <input type="text" class="form-control" name="keyword" placeholder="Order ID">
            <button style="margin-left:10px" type="submit" class="btn btn-outline-primary ">Search</a>
          </div>
			    </form>
          </div>
        </div>
        </div>
        <div class="card-body">
                <table class="table table-bordered ">
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
                        if($ID == NULL)
                        {
                          echo "<strong>Please Enter Order ID!</strong>";
                          ?>
                          <br/>
                          <?php
                        }
                        else if(!preg_match('/^[0-9]+$/', $ID))
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
                          if(mysqli_num_rows($orders_run) > 0)
                          {
                          foreach ($orders_run as $items) 
                            {
                            $User_Decrypted_FName = decryption($items['fname'], $Encryption_key);
                            $User_Decrypted_LName = decryption($items['lname'], $Encryption_key);
                            $User_Decrypted_Name = $User_Decrypted_FName . " " . $User_Decrypted_LName;
                            $User_Decrypted_Email = decryption($items['email'], $Encryption_key);
                                ?>
                                <tr>
                                <td><?php echo $items['id'];?></td>
                                <td><?php echo $User_Decrypted_Name?></td>
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
                                <td><?php echo $User_Decrypted_Email?></td>
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
                                
                                <td><a href="vieworder.php" class="btn btn-primary">View</a>
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
                        }
                      }
                      else
                      {
                      $orders = "SELECT * FROM orders";
                      $orders_run = mysqli_query($userconnection,$orders);
                          if(mysqli_num_rows($orders_run) > 0)
                          {
                          foreach ($orders_run as $items) 
                            {
                            $User_Decrypted_FName = decryption($items['fname'], $Encryption_key);
                            $User_Decrypted_LName = decryption($items['lname'], $Encryption_key);
                            $User_Decrypted_Name = $User_Decrypted_FName . " " . $User_Decrypted_LName;
                            $User_Decrypted_Email = decryption($items['email'], $Encryption_key);
                                ?>
                                <tr>
                                <td><?php echo $items['id'];?></td>
                                <td><?php echo $User_Decrypted_Name?></td>
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
                                <td><?php echo $User_Decrypted_Email?></td>
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
                                
                                <td>
                                <form action="vieworder.php" method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $items['id']?>"></input>
                                <button type="submit" name="updateorderbtn" class="btn btn-primary">Edit</button>
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