<?php
include('dataconnection.php');
$Email = 'limjunming0458@gmail.com';
$Pass = 'Lim_020930';

$Encryption_key = 'Multimedia'; 
        $iv = '1234567891234567';
function encryption($data,$key,$iv)
        {
            $Encryption_key = base64_encode($key);
            $Encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $Encryption_key, 0, $iv);
            return base64_encode($Encrypted_data . '::' . $iv);
        }
$Encrypted_email = encryption($Email,$Encryption_key,$iv);
$Encrypted_pass = password_hash($Pass,PASSWORD_DEFAULT);
mysqli_query($dataconnection,"INSERT INTO admin_login(Admin_Email,Admin_Password) VALUES ('$Encrypted_email','$Encrypted_pass')");

?>