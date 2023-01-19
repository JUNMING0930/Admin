<?php
    session_start();
    include("dataconnection.php");
    if(isset($_POST['addcategorybtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Cate_Name = $_POST['name'];
        $Cate_Description = $_POST['description'];
        $Cate_Status = isset($_POST['status']) ? '1':'0';

        $Check_Cate = "SELECT Cate_Name FROM category WHERE Cate_Name = '$Cate_Name'";
        $Check_Cate_run = mysqli_query($dataconnection,$Check_Cate);

        if(mysqli_num_rows($Check_Cate_run) > 0)
        {
            $_SESSION['message'] = "Categories Existed!";
            header("location: addcategory.php?id=$Current_Admin");
        }
        else
        {
            $Cate_query = "INSERT INTO category (Cate_Name,Cate_Description,Cate_Status) VALUES ('$Cate_Name','$Cate_Description',$Cate_Status)" ;
            $Cate_query_run = mysqli_query($dataconnection,$Cate_query);
    
            if($Cate_query_run)
            {
                $_SESSION['message'] = "Categories Added Successfully!";
                header("location: addcategory.php?id=$Current_Admin");
            }
            else
            {
                $_SESSION['message'] = "Categories Added Unsuccessfully!";
                header("location: addcategory.php?id=$Current_Admin");
            }
        }
        
    }
    else if(isset($_POST['updatecategorybtn']))
    {
        $Category_ID = $_POST['category_id'];
        $Cate_Name = $_POST['name'];
        $Cate_Description = $_POST['description'];
        $Cate_Status = isset($_POST['status']) ? '1':'0';

        $Check_Cate = "SELECT Cate_Name FROM category WHERE Cate_Name = '$Cate_Name' AND ID != '$Category_ID'";
        $Check_Cate_run = mysqli_query($dataconnection,$Check_Cate);
        if(mysqli_num_rows($Check_Cate_run) > 0)
        {
            $_SESSION['message'] = "Categories Existed!";
            header("location: editcategory.php?id=$Category_ID");
        }
        else
        {
            $updatecate_query = "UPDATE category SET Cate_Name = '$Cate_Name', Cate_Description = '$Cate_Description', Cate_Status = '$Cate_Status' WHERE ID = '$Category_ID'" ;
            $updatecate_query_run = mysqli_query($dataconnection,$updatecate_query);
    
            if($updatecate_query_run)
            {
                $_SESSION['message'] = "Categories Updated Successfully!";
                header("location: editcategory.php?id=$Category_ID");
            }
            else
            {
                $_SESSION['message'] = "Categories Updated Unsuccessfully!";
                header("location: editcategory.php?id=$Category_ID");
            }
        }
        
    }
    else if(isset($_POST['deletecategorybtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Category_ID = $_POST['category_id'];

        $deletecate_query = "DELETE FROM category WHERE ID = '$Category_ID'";
        $deletecate_query_run = mysqli_query($dataconnection,$deletecate_query);

        if($deletecate_query_run)
        {
                $_SESSION['dmessage'] = "Categories Deleted Successfully!";
                header("location: categories.php?id=$Current_Admin");
        }
        else
        {
            $_SESSION['dmessage'] = "Categories Deleted Unsuccessfully!";
            header("location: categories.php?id=$Current_Admin");
        }
        
        
    }
?>