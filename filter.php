<?php
    include("dataconnection.php");
    session_start();
    $Current_Admin = $_SESSION['AID'];
    if(isset($_POST['filterprobtn']))
    {
        $Fil_Name = $_POST['name'];
        $Fil_Cate = $_POST['cate'];
        $Fil_Status = $_POST['status'];
        if($Fil_Name != NULL)
        {
            if($Fil_Cate != NULL)
            {
                if($Fil_Status != NULL)
                {
                    header("Location: products.php?name=$Fil_Name&cate=$Fil_Cate&status=$Fil_Status"); 
                }
                else 
                {
                    header("Location: products.php?name=$Fil_Name&cate=$Fil_Cate"); 
                }
            }
            else if($Fil_Status != NULL)

            {
                header("Location: products.php?name=$Fil_Name&status=$Fil_Status"); 
            }
            else
            {
                header("Location: products.php?name=$Fil_Name"); 
            }
        }
        else
        {
            if($Fil_Cate != NULL)
            {
                if($Fil_Status != NULL)
                {
                    header("Location: products.php?cate=$Fil_Cate&status=$Fil_Status"); 
                }
                else
                {
                    header("Location: products.php?cate=$Fil_Cate"); 
                }
            }
            else if($Fil_Status != NULL)
            {
                header("Location: products.php?status=$Fil_Status"); 
            }
            else
            {
                header("Location: products.php?");
            }
        }
    }
    else if(isset($_POST['filterstockbtn']))
    {
        $Fil_Cate = $_POST['category'];
        $Fil_Pro = $_POST['product'];
        $Fil_Size = $_POST['size'];
        if($Fil_Cate != NULL)
        {
            if($Fil_Pro != NULL)
            {
                if($Fil_Size != NULL)
                {
                    header("Location: stocks.php?cate=$Fil_Cate&pro=$Fil_Pro&size=$Fil_Size"); 
                }
                else 
                {
                    header("Location: stocks.php?cate=$Fil_Cate&pro=$Fil_Pro"); 
                }
            }
            else if($Fil_Size != NULL)
            {
                header("Location: stocks.php?cate=$Fil_Cate&size=$Fil_Size"); 
            }
            else
            {
                header("Location: stocks.php?cate=$Fil_Cate"); 
            }
        }
        else
        {
            if($Fil_Pro != NULL)
            {
                if($Fil_Size != NULL)
                {
                    header("Location: stocks.php?pro=$Fil_Pro&size=$Fil_Size"); 
                }
                else
                {
                    header("Location: stocks.php?pro=$Fil_Pro"); 
                }
            }
            else if($Fil_Size != NULL)
            {
                header("Location: stocks.php?size=$Fil_Size"); 
            }
            else
            {
                header("Location: stocks.php?");
            }
        }
    }
?>