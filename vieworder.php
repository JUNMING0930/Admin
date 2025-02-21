<?php $page_title = "View Order"; ?>
<?php include("includes/header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>View Order</h4>
                </div>
                <div class="card-body">
                    <!-- Order Details Table -->
                    <table class="table table-hover">
                        <thead class="thead-dark">
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
                            $Order_ID = $_POST['order_id'];

                            $Order_Query = "SELECT * FROM orders_details WHERE Order_ID = '$Order_ID'";
                            $Order_Run = mysqli_query($userconnection, $Order_Query);
                            if (mysqli_num_rows($Order_Run) > 0) {
                                foreach ($Order_Run as $items) {
                                    $Product_ID = $items['Product_ID'];
                                    $Product_Query = "SELECT * FROM product WHERE ID = '$Product_ID'";
                                    $Product_Run = mysqli_query($dataconnection, $Product_Query);
                                    $Pro_Row = mysqli_fetch_array($Product_Run);

                                    $ptotal = $Pro_Row['Pro_Price'] * $items['Order_Quantity'];
                                    $gtotal += $ptotal;
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($Pro_Row['Pro_Name']); ?></td>
                                        <td><?php echo $items['Order_Quantity']; ?></td>
                                        <td><?php echo htmlspecialchars($items['Order_Size']); ?></td>
                                        <td>RM <?php echo number_format($Pro_Row['Pro_Price'], 2); ?></td>
                                        <td>RM <?php echo number_format($ptotal, 2); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">Grand Total</td>
                                <td>RM <?php echo number_format($gtotal, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Customer Information Table -->
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="5">Customer Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Order_Info_Query = "SELECT * FROM orders WHERE id = '$Order_ID' LIMIT 1";
                            $Order_Info_Run = mysqli_query($userconnection, $Order_Info_Query);
                            $Order_Row = mysqli_fetch_array($Order_Info_Run);

                            $User_Decrypted_FName = decryption($Order_Row['fname'], $Encryption_key);
                            $User_Decrypted_LName = decryption($Order_Row['lname'], $Encryption_key);
                            $User_Decrypted_Name = $User_Decrypted_FName . " " . $User_Decrypted_LName;
                            $User_Decrypted_Address = decryption($Order_Row['address'], $Encryption_key);
                            $User_Decrypted_Phone = decryption($Order_Row['phone'], $Encryption_key);
                            $User_Decrypted_Email = decryption($Order_Row['email'], $Encryption_key);
                            ?>
                            <tr>
                                <td><strong>Customer Name</strong></td>
                                <td colspan="4"><?php echo htmlspecialchars($User_Decrypted_Name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Shipping Address</strong></td>
                                <td colspan="4"><?php echo htmlspecialchars($User_Decrypted_Address); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Phone Number</strong></td>
                                <td colspan="4"><?php echo htmlspecialchars($User_Decrypted_Phone); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td colspan="4"><?php echo htmlspecialchars($User_Decrypted_Email); ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Order Status Update Form -->
                    <form action="ordercode.php" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $Order_ID; ?>">
                        <div class="form-group row">
                            <label for="status" class="col-md-3 col-form-label"><strong>Status</strong></label>
                            <div class="col-md-9">
                                <select name="Status" id="status" class="form-control">
                                    <?php
                                    $order_status = $Order_Row['Status'];
                                    $statuses = ['Packaging', 'Shipping', 'Delivered'];
                                    foreach ($statuses as $index => $status) {
                                        $selected = ($order_status == $index) ? 'selected' : '';
                                        echo "<option value='$index' $selected>$status</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="updateorderbtn" class="btn btn-success">
                                <i class="fa fa-check-circle"></i> Save
                            </button>
                            <a href="orders.php" class="btn btn-light">
                                <i class="fa fa-angle-double-left"></i> Return
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    echo "<script>alert('$message')</script>";
    unset($_SESSION['message']);
}
?>

<?php include("includes/footer.php"); ?>
<?php include("includes/scripts.php"); ?>
