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

        $Encryption_key = 'Multimedia'; 
        $iv = '1234567891234567';
        
        function encryption($data,$key,$iv)
        {
            $Encryption_key = base64_encode($key);
            $Encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $Encryption_key, 0, $iv);
            return base64_encode($Encrypted_data . '::' . $iv);;
        }
        $Admin_Encrypted_Email = encryption($Admin_Email, $Encryption_key, $iv);
        $Check_Admin_Email = "SELECT Admin_Email FROM admin_login WHERE Admin_Email = '$Admin_Encrypted_Email'" ;
        $Check_Admin_Email_run = mysqli_query($dataconnection,$Check_Admin_Email);
        
        if(!filter_var($Admin_Email,FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['message'] = "Please Enter Valid Email!";
            
            header("location: addadmin.php");
        }
        else if(mysqli_num_rows($Check_Admin_Email_run) > 0 )
        {
            $_SESSION['message'] = "Email Adress is already existed!";
            header("location: addadmin.php");
        }
        else if($Admin_Password != $Admin_Confirm_Password)
        {
            $_SESSION['message'] = "Password id not same as Confirm Password!";
            header("location: addadmin.php");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            header("location: addadmin.php");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            header("location: addadmin.php");
        }
        else if(!preg_match("/^[A-Za-z\d^£$%&*()}{@#~?><>,|=_+¬-]{8,}$/",$Admin_Password))
        {
            $_SESSION['message'] = "Password must be at least 8 characters long!";
            header("location: addadmin.php");
        }
        else if(!preg_match("#[0-9]+#",$Admin_Password))
        {
            $_SESSION['message'] = "Password must contain at least 1 number!";
            header("location: addadmin.php");
        }
        else if(!preg_match("#[A-Z]+#",$Admin_Password))
        {
            $_SESSION['message'] = "Password must contain at least 1 Capital Letter!";
            header("location: addadmin.php");
        }
        else if(!preg_match("#[a-z]+#",$Admin_Password))
        {
            $_SESSION['message'] = "Password must contain at least 1 small Letter!";
            header("location: addadmin.php");
        }
        else if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $Admin_Password))
        {
            $_SESSION['message'] = "Password must contain at least 1 special character!";
            header("location: addadmin.php");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            header("location: addadmin.php");
        }
        else
        {
            $Admin_Encrypted_Fname = encryption($Admin_Fname, $Encryption_key,$iv);
            $Admin_Encrypted_Lname = encryption($Admin_Lname, $Encryption_key,$iv);
            $Admin_Encrypted_Phone = encryption($Admin_Phone, $Encryption_key,$iv); 

            $Admin_Hashed_Password = password_hash($Admin_Password, PASSWORD_DEFAULT);

            $Admin_query = "INSERT INTO admin_login (Admin_Fname,Admin_Lname,Admin_Email,Admin_Password,Admin_Phone,Admin_Role) VALUES ('$Admin_Encrypted_Fname','$Admin_Encrypted_Lname','$Admin_Encrypted_Email','$Admin_Hashed_Password','$Admin_Encrypted_Phone','$Admin_Role')" ;
            $Admin_query_run = mysqli_query($dataconnection,$Admin_query);        
            if($Admin_query_run)
            {
               $_SESSION['message'] = "Admin Added Successfully!";
                header("location: admin.php");
            }
            else
            {
                $_SESSION['message'] = "Admin Added Unsuccessfully!";
                header("location: addadmin.php");
            }
        }
    }    
    else if(isset($_POST['updateadminbtn']))
    {
        $Admin_ID = $_POST['admin_id'];
        $Admin_Fname = $_POST['fname'];
        $Admin_Lname = $_POST['lname'];
        $Admin_Phone = $_POST['phone'];
        $Admin_Role = $_POST['role'];
        $Admin_Email = $_POST['email'];
        $Admin_Password = $_POST['password'];
        $Encryption_key = 'Multimedia'; 
        $iv = '1234567891234567';
        
        function encryption($data,$key,$iv)
        {
            $Encryption_key = base64_encode($key);
            $Encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $Encryption_key, 0, $iv);
            return base64_encode($Encrypted_data . '::' . $iv);;
        }
        $Admin_Encrypted_Email = encryption($Admin_Email, $Encryption_key, $iv);
        $Check_Admin_Email = "SELECT Admin_Email FROM admin_login WHERE Admin_Email ='$Admin_Encrypted_Email' AND ID = '$Admin_ID'" ;
        $Check_Admin_Email_run = mysqli_query($dataconnection,$Check_Admin_Email);

        if(!preg_match("/^[a-zA-Z]+$/",$Admin_Fname))
        {
            $_SESSION['message'] = "Invalid First Name!";
            $_SESSION['admin_id'] = $Admin_ID;
            header("location: editadmin.php");
        }
        else if(!preg_match("/^[a-zA-Z]+$/",$Admin_Lname))
        {
            $_SESSION['message'] = "Invalid Last Name!";
            $_SESSION['admin_id'] = $Admin_ID;
            header("location: editadmin.php");
        }
        else if(!preg_match('/^[0-9]{10,11}+$/', $Admin_Phone))
        {
            $_SESSION['message'] = "Invalid Phone Number!";
            $_SESSION['admin_id'] = $Admin_ID;
            header("location: editadmin.php");
        }
        else
        {
            $Admin_Encrypted_Fname = encryption($Admin_Fname, $Encryption_key,$iv);
            $Admin_Encrypted_Lname = encryption($Admin_Lname, $Encryption_key,$iv);
            $Admin_Encrypted_Phone = encryption($Admin_Phone, $Encryption_key,$iv); 
            $Admin_Hashed_Password = password_hash($Admin_Password, PASSWORD_DEFAULT);

            $updateadmin_query = "UPDATE admin_login SET Admin_Fname = '$Admin_Encrypted_Fname', Admin_Lname = '$Admin_Encrypted_Lname', Admin_Email = '$Admin_Encrypted_Email', Admin_Password = '$Admin_Hashed_Password', Admin_Phone = '$Admin_Encrypted_Phone' ,Admin_Role = '$Admin_Role' WHERE ID = '$Admin_ID'" ;
            $updateadmin_query_run = mysqli_query($dataconnection,$updateadmin_query);

            if($updateadmin_query_run)
            {
                $_SESSION['message'] = "Admin Updated Successfully!";
                header("location: admin.php");
            }
            else
            {
                $_SESSION['message'] = "Admin Updated Unsuccessfully!";
                $_SESSION['admin_id'] = $Admin_ID;
                header("location: editadmin.php");
            }
        }

        
    }
    else if(isset($_POST['deleteadminbtn']))
    {
        $Admin_ID = $_POST['admin_id'];
        $deleteadmin_query = "DELETE FROM admin_login WHERE ID = '$Admin_ID'";
        $deleteadmin_query_run = mysqli_query($dataconnection,$deleteadmin_query);

        if($deleteadmin_query_run)
        {
                $_SESSION['dmessage'] = "Admin Deleted Successfully!";
                header("location: admin.php");
        }
        else
        {
            $_SESSION['dmessage'] = "Categories Deleted Unsuccessfully!";
            header("location: admin.php");
        }
        
        
    }
?>