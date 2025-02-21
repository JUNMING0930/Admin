<?php
    session_start();
    include("dataconnection.php");
    if(isset($_POST['addcustomerbtn']))
    {
        $Current_Admin = $_SESSION['ID'];
        $User_Fname = $_POST['fname'];
        $User_Lname = $_POST['lname'];
        $User_Email = $_POST['email'];
        $User_Password = $_POST['password'];
        $User_Gender = $_POST['gender'];
        $User_Status = isset($_POST['status']) ? "1":"0";

        $Check_User_Email = "SELECT User_Email FROM user WHERE User_Email = '$User_Email'" ;
        $Check_User_Email_run = mysqli_query($userconnection,$Check_User_Email);

        if(!filter_var($User_Email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = "Please Enter Valid Email!";
            header("location: addcustomer.php?id=$Current_Admin");
        }
        else if(mysqli_num_rows($Check_User_Email_run) > 0 )
        {
            $_SESSION['message'] = "Email Adress is already existed!";
            header("location: addcustomer.php?id=$Current_Admin");
        }
        else
        {
            $Add_User_query = "INSERT INTO user (User_Email,User_Password,User_First_Name,User_Last_Name,User_Gender,User_Status) VALUES ('$User_Email','$User_Password','$User_Fname','$User_Lname','$User_Gender','$User_Status')" ;
            $Add_User_query_run = mysqli_query($userconnection,$Add_User_query);        
            if($Add_User_query_run)
            {
               $_SESSION['message'] = "Customer Added Successfully!";
                header("location: addcustomer.php?id=$Current_Admin");
            }
            else
            {
                $_SESSION['message'] = "Customer Added Unsuccessfully!";
                header("location: addcustomer.php?id=$Current_Admin");
            }
        }
    }

    else if(isset($_POST['updatecustomerbtn']))
    {
        $User_ID = $_POST['customer_id'];
        $User_Fname = $_POST['fname'];
        $User_Lname = $_POST['lname'];
        $User_Email = $_POST['email'];
        $User_Password = $_POST['password'];
        $User_Gender = $_POST['gender'];
        $User_Status = isset($_POST['status']) ? "1":"0";

        $Check_User_Email = "SELECT User_Email FROM user WHERE User_Email = '$User_Email' AND ID != '$User_ID'" ;
        $Check_User_Email_run = mysqli_query($userconnection,$Check_User_Email);

        if(!filter_var($User_Email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = "Please Enter Valid Email!";
            header("location: editcustomer.php?id=$User_ID");
        }
        else if(mysqli_num_rows($Check_User_Email_run) > 0 )
        {
            $_SESSION['message'] = "Email Adress is already existed!";
            header("location: editcustomer.php?id=$User_ID");
        }
        else
        {
            $Edit_User_query = "UPDATE user SET User_Email = '$User_Email',User_Password = '$User_Password',User_First_Name = '$User_Fname',User_Last_Name = '$User_Lname',User_Gender = '$User_Gender',User_Status = '$User_Status' WHERE ID = '$User_ID'" ;
            $Edit_User_query_run = mysqli_query($userconnection,$Edit_User_query);        
            if($Edit_User_query_run)
            {
               $_SESSION['message'] = "Customer Edited Successfully!";
                header("location: editcustomer.php?id=$User_ID");
            }
            else
            {
                $_SESSION['message'] = "Customer Edited Unsuccessfully!";
                header("location: editcustomer.php?id=$User_ID");
            }
        }
    }

    else if(isset($_POST['deletecustomerbtn']))
    {
        $Current_Admin = $_SESSION['ID'];
        $Customer_ID = $_POST['customer_id'];
        $deletecustomer_query = "DELETE FROM user WHERE ID = '$Customer_ID'";
        $deletecustomer_query_run = mysqli_query($userconnection,$deletecustomer_query);

        if($deletecustomer_query_run)
        {
            $_SESSION['dmessage'] = "Customer Deleted Successfully!";
            header("location: customer.php?id=$Current_Admin");
        }
        else
        {
            $_SESSION['dmessage'] = "Customer Deleted Unsuccessfully!";
            header("location: customer.php?id=$Current_Admin");
        }
        
        
    }
?>