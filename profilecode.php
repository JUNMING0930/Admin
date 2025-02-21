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
        $Encryption_key = 'Multimedia'; 
        $iv = '1234567891234567';
        
        function encryption($data,$key,$iv)
        {
            $Encryption_key = base64_encode($key);
            $Encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $Encryption_key, 0, $iv);
            return base64_encode($Encrypted_data . '::' . $iv);;
        }

        if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            header("location: editprofile.php");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            header("location: editprofile.php");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            header("location: editprofile.php");
        }
        else
        {
            $Admin_Encrypted_Email = encryption($Admin_Email, $Encryption_key, $iv);
            $Admin_Encrypted_Fname = encryption($Admin_Fname, $Encryption_key,$iv);
            $Admin_Encrypted_Lname = encryption($Admin_Lname, $Encryption_key,$iv);
            $Admin_Encrypted_Phone = encryption($Admin_Phone, $Encryption_key,$iv); 
            $Admin_Hashed_Password = password_hash($Admin_Password, PASSWORD_DEFAULT);

            $updateprofile_query = "UPDATE admin_login SET Admin_Fname = '$Admin_Encrypted_Fname' , Admin_Lname = '$Admin_Encrypted_Lname' , Admin_Email = '$Admin_Encrypted_Email' , Admin_Password = '$Admin_Hashed_Password' , Admin_Phone='$Admin_Encrypted_Phone' WHERE ID = '$Admin_ID'";
            $updateprofile_query_run = mysqli_query($dataconnection,$updateprofile_query);

            if($updateprofile_query_run)
            {
                $_SESSION['message'] = "Profile Updated Successfully!";
                header("location: profile.php");
            }
            else
            {
                $_SESSION['message'] = "Profile Updated Unsuccessfully!";
                header("location: editprofile.php");
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

        if(password_verify($New_Pass,$Old_Pass))
        {
            $_SESSION['message'] = "New Password is same as Old Password!";
            header("location: editpass.php");
        }
        else
        {
            if(!$uppercase || !$lowercase || !$number || strlen($New_Pass) < 8)
            {
                $_SESSION['message'] = "New Password must be at least 8 characters in length, and should include at least one upper case letter and one number";
                header("location: editpass.php");
            }
            else
            {
                if($New_Pass != $Con_Pass)
                {
                    $_SESSION['message'] = "New Password is not same as Confirm Password!";
                    header("location: editpass.php");
                }
                else
                {
                    $Hashed_New_Pass = password_hash($New_Pass, PASSWORD_DEFAULT);
                    $Pass = "UPDATE admin_login SET Admin_Password='$Hashed_New_Pass' WHERE ID = '$Admin_ID' ";
                    $Pass_Query = mysqli_query($dataconnection,$Pass);
                    if($Pass_Query)
                    {
                        $_SESSION['message'] = "Password had been changed successfully!";
                        header("location: editprofile.php");
                    }
                }
            }
        }
    }
?>