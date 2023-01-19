<?php
    session_start();
    include('dataconnection.php');
    if(isset($_POST['updateprofilebtn']))
    {
        $Admin_ID = $_POST['admin_id'];
        $Admin_Fname = $_POST['fname'];
        $Admin_Lname = $_POST['lname'];
        $Admin_Email = $_POST['email'];
        $Admin_Password = $_POST['pass'];
        $Admin_Phone = $_POST['phone'];
        if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            header("location: editprofile.php?id=$Admin_ID");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            header("location: editprofile.php?id=$Admin_ID");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            header("location: editprofile.php?id=$Admin_ID");
        }
        else
        {
            $updateprofile_query = "UPDATE admin_login SET Admin_Fname = '$Admin_Fname' , Admin_Lname = '$Admin_Lname' , Admin_Email = '$Admin_Email' , Admin_Password = '$Admin_Password' , Admin_Phone='$Admin_Phone' WHERE ID = '$Admin_ID'";
            $updateprofile_query_run = mysqli_query($dataconnection,$updateprofile_query);

            if($updateprofile_query_run)
            {
                $_SESSION['message'] = "Profile Updated Successfully!";
                header("location: editprofile.php?id=$Admin_ID");
            }
            else
            {
                $_SESSION['message'] = "Profile Updated Unsuccessfully!";
                header("location: editprofile.php?id=$Admin_ID");
            }
        }
    }
    else if(isset($_POST['savepassbtn']))
    {   
        $Admin_ID = $_POST['admin_id'];
        $Old_Pass = $_POST['opass'];
        $New_Pass = $_POST['npass'];
        $Con_Pass = $_POST['cpass'];
        $uppercase = preg_match('@[A-Z]@', $New_Pass);
        $lowercase = preg_match('@[a-z]@', $New_Pass);
        $number    = preg_match('@[0-9]@', $New_Pass);

        if($Old_Pass == $New_Pass)
        {
            $_SESSION['message'] = "New Password is same as Old Password!";
            header("location: editpass.php?id=$Admin_ID");
        }
        else
        {
            if(!$uppercase || !$lowercase || !$number || strlen($New_Pass) < 8)
            {
                $_SESSION['message'] = "New Password must be at least 8 characters in length, and should include at least one upper case letter and one number";
                header("location: editpass.php?id=$Admin_ID");
            }
            else
            {
                if($New_Pass != $Con_Pass)
                {
                    $_SESSION['message'] = "New Password is not same as Confirm Password!";
                    header("location: editpass.php?id=$Admin_ID");
                }
                else
                {
                    $Pass = "UPDATE admin_login SET Admin_Password='$New_Pass' WHERE ID = '$Admin_ID' ";
                    $Pass_Query = mysqli_query($dataconnection,$Pass);
                    if($Pass_Query)
                    {
                        $_SESSION['message'] = "Password had been changed successfully!";
                        header("location: editpass.php?id=$Admin_ID");
                    }
                }
            }
        }
    }
?>