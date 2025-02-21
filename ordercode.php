<?php
session_start();
include("dataconnection.php");
if(isset($_POST['updateorderbtn']))
{
    $Order_ID = $_POST['order_id'];
    $Status = $_POST['Status'];
    $Update_Status = "UPDATE orders SET Status='$Status' WHERE id = '$Order_ID' ";
    $Update_Status_run = mysqli_query($userconnection,$Update_Status);
    if($Update_Status_run)
    {
        $_SESSION['message'] = "Order Status Changed Successfully!";
        header("location: orders.php");
    }
}
?>