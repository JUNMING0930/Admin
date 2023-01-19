<?php
    session_start();
    include("dataconnection.php");
    if(isset($_POST['addadminbtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Admin_Fname = $_POST['fname'];
        $Admin_Lname = $_POST['lname'];
        $Admin_Email = $_POST['email'];
        $Admin_Password = $_POST['password'];
        $Admin_Confirm_Password = $_POST['cpassword'];
        $Admin_Phone = $_POST['phone'];
        $Admin_Role = $_POST['role'];

        $Check_Admin_Email = "SELECT Admin_Email FROM admin_login WHERE Admin_Email = '$Admin_Email'" ;
        $Check_Admin_Email_run = mysqli_query($dataconnection,$Check_Admin_Email);
        
        if(!filter_var($Admin_Email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = "Please Enter Valid Email!";
            header("location: addadmin.php?id=$Current_Admin");
        }
        else if(mysqli_num_rows($Check_Admin_Email_run) > 0 )
        {
            $_SESSION['message'] = "Email Adress is already existed!";
            header("location: addadmin.php?id=$Current_Admin");
        }
        else if($Admin_Password != $Admin_Confirm_Password)
        {
            $_SESSION['message'] = "Password id not same as Confirm Password!";
            header("location: addadmin.php?id=$Current_Admin");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            header("location: addadmin.php?id=$Admin_ID");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            header("location: addadmin.php?id=$Admin_ID");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            header("location: addadmin.php?id=$Admin_ID");
        }
        else
        {
            $Admin_query = "INSERT INTO admin_login (Admin_Fname,Admin_Lname,Admin_Email,Admin_Password,Admin_Phone,Admin_Role) VALUES ('$Admin_Fname','$Admin_Lname','$Admin_Email','$Admin_Password','$Admin_Phone','$Admin_Role')" ;
            $Admin_query_run = mysqli_query($dataconnection,$Admin_query);        
            if($Admin_query_run)
            {
               $_SESSION['message'] = "Admin Added Successfully!";
                header("location: addadmin.php?id=$Current_Admin");
            }
            else
            {
                $_SESSION['message'] = "Admin Added Unsuccessfully!";
                header("location: addadmin.php?id=$Current_Admin");
            }
        }
    }    
    else if(isset($_POST['updateadminbtn']))
    {
        $Admin_ID = $_POST['admin_id'];
        $Admin_Fname = $_POST['fname'];
        $Admin_Lname = $_POST['lname'];
        $Admin_Email = $_POST['email'];
        $Admin_Password = $_POST['password'];
        $Admin_Confirm_Password = $_POST['cpassword'];
        $Admin_Phone = $_POST['phone'];
        $Admin_Role = $_POST['role'];

        $Check_Admin_Email = "SELECT Admin_Email FROM admin_login WHERE Admin_Email = '$Admin_Email' AND ID != '$Admin_ID'" ;
        $Check_Admin_Email_run = mysqli_query($dataconnection,$Check_Admin_Email);

        if(!filter_var($Admin_Email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = "Please Enter Valid Email!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else if(mysqli_num_rows($Check_Admin_Email_run) > 0 )
        {
            $_SESSION['message'] = "Email Adress is already existed!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else if($Admin_Password != $Admin_Confirm_Password)
        {
            $_SESSION['message'] = "New Password id not same as Confirm Password!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            header("location: editadmin.php?id=$Admin_ID");
        }
        else
        {
            $updateadmin_query = "UPDATE admin_login SET Admin_Fname = '$Admin_Fname', Admin_Lname = '$Admin_Lname', Admin_Email = '$Admin_Email', Admin_Password = '$Admin_Password', Admin_Phone = '$Admin_Phone' ,Admin_Role = '$Admin_Role' WHERE ID = '$Admin_ID'" ;
            $updateadmin_query_run = mysqli_query($dataconnection,$updateadmin_query);

            if($updateadmin_query_run)
            {
                $_SESSION['message'] = "Admin Updated Successfully!";
                header("location: editadmin.php?id=$Admin_ID");
            }
            else
            {
                $_SESSION['message'] = "Admin Updated Unsuccessfully!";
                header("location: editadmin.php?id=$Admin_ID");
            }
        }
        
    }
    else if(isset($_POST['deleteadminbtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Admin_ID = $_POST['admin_id'];
        $deleteadmin_query = "DELETE FROM admin_login WHERE ID = '$Admin_ID'";
        $deleteadmin_query_run = mysqli_query($dataconnection,$deleteadmin_query);

        if($deleteadmin_query_run)
        {
                $_SESSION['dmessage'] = "Admin Deleted Successfully!";
                header("location: admin.php?id=$Current_Admin");
        }
        else
        {
            $_SESSION['dmessage'] = "Categories Deleted Unsuccessfully!";
            header("location: admin.php?id=$Current_Admin");
        }
        
        
    }
?>