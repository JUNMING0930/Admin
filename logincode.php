<?php
	session_start();
    include("dataconnection.php");
	if(isset($_POST["loginbtn"]))
	{
		$Admin_Email = $_POST['adminemail'];
		$Admin_Password = $_POST['adminpass'];
		$Encryption_key = 'Multimedia'; 
        $iv = '1234567891234567';
        
        function encryption($data,$key,$iv)
        {
            $Encryption_key = base64_encode($key);
            $Encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $Encryption_key, 0, $iv);
            return base64_encode($Encrypted_data . '::' . $iv);;
        }
		$Admin_Encrypted_Email = encryption($Admin_Email, $Encryption_key, $iv);

		$query = "SELECT * FROM `admin_login` WHERE `Admin_Email` = '$Admin_Encrypted_Email'";
		$result = mysqli_query($dataconnection,$query);
		if(mysqli_num_rows($result)>0)
		{
			$Get_Admin_Pass = mysqli_fetch_array($result);
			$Admin_Hashed_Password = $Get_Admin_Pass['Admin_Password'];
			if(password_verify($Admin_Password, $Admin_Hashed_Password))
			{
				
				$Admin_ID = $Get_Admin_Pass['ID']; 
				$Admin_Role = $Get_Admin_Pass['Admin_Role'];
				$_SESSION['AID'] = $Admin_ID;
				$_SESSION['Role'] = $Admin_Role;
				$page_title = "Home Page";
				header("location: index.php");
			}
			else
			{
				$_SESSION['message'] = "Invalid password or username";
				header("location: login.php");
				exit(0);
			}
		}
		else
		{
			$_SESSION['message'] = "Invalid password or username";
			header("location: login.php");
            exit(0);
		}
	}
?>