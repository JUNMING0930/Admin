<?php $page_title = "Welcome"?>
<?php include('includes/header.php')?>

<div class="row">
  <div class="col-lg-7 position-relative z-index-2">
    <div class="card card-plain mb-4">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-6">
            <div class="d-flex flex-column h-100">
  <h2 class="font-weight-bolder mb-0">General Statistics</h2>
</div>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-5 col-sm-5">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">category</i>
    </div>

    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Categories</p>
      <?php
        $Cate = getalldata("category");
        if($Total_Cate_Row = mysqli_num_rows($Cate))
        {
          ?>
          <h4 class="mb-0"><?php echo $Total_Cate_Row ?></h4>
          <?php
        }
        else
        {
          echo "error";
        }
      ?>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><br></p>
  </div>
</div>

        <div class="card  mb-2">
  <div class="card-header p-3 pt-2">
    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">person</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize">Total Users</p>
      <?php
        $User = "SELECT * FROM user";
        $User_Run = mysqli_query($userconnection,$User);
        if($Total_User_Row = mysqli_num_rows($User_Run))
        {
          ?>
          <h4 class="mb-0"><?php echo $Total_User_Row ?></h4>
          <?php
        }
        else
        {
          echo "error";
        }
      ?>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span><br></p>
  </div>
</div>

      </div>
      <div class="col-lg-5 col-sm-5 mt-sm-0 mt-4">
        <div class="card  mb-2">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">local_mall</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Products</p>
      <?php
        $Pro = getalldata("product");
        if($Total_Pro_Row = mysqli_num_rows($Pro))
        {
          ?>
          <h4 class="mb-0"><?php echo $Total_Pro_Row ?></h4>
          <?php
        }
        else
        {
          echo "error";
        }
      ?>
    </div>
  </div>

  <hr class="dark horizontal my-0">
  <div class="card-footer p-3">
    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"><br></p>
  </div>
  </hr>
</div>

        <div class="card ">
  <div class="card-header p-3 pt-2 bg-transparent">
    <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
      <i class="material-icons opacity-10">receipt</i>
    </div>
    <div class="text-end pt-1">
      <p class="text-sm mb-0 text-capitalize ">Total Orders</p>
      <?php
        $Order = "SELECT * FROM orders ORDER BY id DESC";
        $Order_Run = mysqli_query($userconnection,$Order);
        if($Total_Order_Row = mysqli_num_rows($Order_Run))
        {
          ?>
          <h4 class="mb-0"><?php echo $Total_Order_Row ?></h4>
          <?php
        }
        else
        {
          echo "error";
        }
      ?>
    </div>
  </div>

  <hr class="horizontal my-0 dark">
  <div class="card-footer p-3">
    <p class="mb-0 "><br></p>
  </div>
</div>

      </div>
    </div>

    <div class="row mt-4">
      <div class="col-10">
        <div class="card mb-4 ">

</div>

      </div>
    </div>
  </div>
</div>

<div class="row ">
  <div class="col">
    <div class="card z-index-2 mt-4">
  <div class="card-body mt-n5 px-3">
  <div class="card-header pb-0">
    <h6>Customer List</h6>
    <table class="table table-bordered table-striped">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone Number</th>
      </thead>
      <tbody>
        
        <?php 
        foreach($User_Run AS $items)
        {
          ?>
          <tr>
            <td><?php echo $items["ID"]?></td>
            <td><?php echo $items['User_First_Name']?> <?php echo $items['User_Last_Name']?></td>
            <td><?php echo $items['User_Email']?></td>
            <td><?php if($items['User_Phone'] !=NULL ){ echo $items['User_Phone'];} else {echo "-";}?></td>
          </tr>  
          <?php
        }
        ?>
        
      </tbody>
    </table> 
    <?php
    ?>
  </div>
  </div>
</div>

  </div>
  <div class="colmt-5">
    <div class="card ">
  <div class="card-header pb-0">
    <h6>Latest Order</h6>
  </div>
  <div class="card-body p-3">
  <table class="table table-bordered table-striped">
      <thead>
        <th>ID</th>
        <th>Customer</th>
        <th>Status</th>
        <th>Time Added</th>
        <th>Total</th>
        <th>View</th>
      </thead>
      <tbody>
        
        <?php 
        foreach($Order_Run AS $order)
        {
          ?>
          <tr>
            <td><?php echo $order['id']?></td>
            <td><?php echo $order['fname']?> <?php echo $order['lname']?></td>
            <td>
                                <?php
                                if($order['Status'] == 0)
                                {
                                    echo "Packaging";
                                }
                                else if($order['Status'] == 1)
                                {
                                  echo "Shipping";
                                }
                                else if($order['Status'] == 2)
                                {
                                  echo "Delivered";
                                }
                                else if($order['Status'] == 3)
                                {
                                  echo "Canceled";
                                }
                                ?>
                                </td>        
            <td><?php echo $order['created_at']?></td>
            <td>RM <?php echo $order['amount_paid']?></td>
            <td><a href="vieworder.php?id=<?php echo $order['id']?>" class="btn btn-primary">View</a>
          </tr>  
          <?php
        }
        ?>
        
      </tbody>
    </table> 
  </div>
</div>

  </div>
</div>           


<?php 
include('includes/footer.php');
include('includes/scripts.php');
?>