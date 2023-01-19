<?php
session_start();
include("dataconnection.php");
if(isset($_POST['addstockbtn']))
{
    $Current_Admin = $_SESSION['AID'];
    $Category_ID = $_POST['category_id'];
    $Product_ID = $_POST['product_id'];
    $Stock_Size = $_POST['stock_size'];
    $Stock_Quantity = $_POST['quantity'];

    if($Stock_Quantity < 0 || preg_match('@[0-9]@',$Stock_Quantity) != 1)
    {
        $_SESSION['message'] = "Please Enter Valid Quantity!";
        header("Location: addstock.php?id=$Current_Admin");
    }
    else
    {
        $Check_Size = "SELECT Product_ID,Product_Size,Product_Quantity FROM stock WHERE Product_ID = '$Product_ID' AND Product_Size = '$Stock_Size'";
        $Check_Size_Query = mysqli_query($dataconnection,$Check_Size);
        if(mysqli_num_rows($Check_Size_Query) > 0)
        {
            $Stock = mysqli_fetch_array($Check_Size_Query);
            $Stock_New_Quantity =  $Stock['Product_Quantity'] + $Stock_Quantity;
            $Update_Size = "UPDATE stock SET Product_Quantity = '$Stock_New_Quantity' WHERE Product_ID = '$Product_ID' AND Product_Size = '$Stock_Size'";
            $Update_Size_run = mysqli_query($dataconnection,$Update_Size);
            if($Update_Size_run)
            {
                $_SESSION['message'] = "Product Stock existed,The quantity will be added on.";
                header("Location: addstock.php?id=$Current_Admin");
            }
            else
            {
                $_SESSION['message'] = "Something errors";
                header("Location: addstock.php?id=$Current_Admin");
            }
        }
        else
        {
            $Add_Stock = "INSERT INTO stock(Category_ID,Product_ID,Product_Size,Product_Quantity) VALUES ('$Category_ID','$Product_ID','$Stock_Size','$Stock_Quantity')";
            $Add_Stock_run = mysqli_query($dataconnection,$Add_Stock);
    
            if($Add_Stock_run)
            {
                $_SESSION['message'] = "Product Stock Added Successfully";
                header("Location: addstock.php?id=$Current_Admin");
            }
            else
            {
                $_SESSION['message'] = "Product Stock Added Unsuccessfully";
                header("Location: addstock.php?id=$Current_Admin");
            }
        }
    }
    
}
else if(isset($_POST['editstockbtn']))
{
    $Stock_ID = $_POST['stock_id'];
    $Stock_Quantity = $_POST['quantity'];
    
    if($Stock_Quantity < 0 || preg_match('@[0-9]@',$Stock_Quantity) != 1)
    {
        $_SESSION['message'] = "Please Enter Valid Quantity!";
        header("Location: editstock.php?id=$Stock_ID");
    }
    else
    {
        $Update_Stock = "UPDATE stock SET Product_Quantity = '$Stock_Quantity' WHERE ID = $Stock_ID";
        $Update_Stock_Run = mysqli_query($dataconnection,$Update_Stock);
    
        if($Update_Stock_Run)
        {
            $_SESSION['message'] = "Product Stock Edited Successfully";
            header("Location: editstock.php?id=$Stock_ID");
        }
        else
        {
            $_SESSION['message'] = "Product Stock Edited Unsuccessfully";
            header("Location: editstock.php?id=$Stock_ID");
        }
    }
}
else if(isset($_POST['deletestockbtn']))
{
        $Current_Admin = $_SESSION['AID'];
        $Stock_ID = $_POST['stock_id'];
        $deletestocks_query = "DELETE FROM stock WHERE id = '$Stock_ID'";
        $deletestocks_query_run = mysqli_query($dataconnection,$deletestocks_query);

        if($deletestocks_query_run)
        {
                $_SESSION['dmessage'] = "Stocks Deleted Successfully!";
                header("location: stocks.php?id=$Current_Admin");
        }
        else
        {
            $_SESSION['dmessage'] = "Stocks Deleted Unsuccessfully!";
            header("location: stocks.php?id=$Current_Admin");
        }
        
        
} 
?>