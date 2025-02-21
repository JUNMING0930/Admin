<?php
    session_start();
    include("dataconnection.php");
    if(isset($_POST['addproductbtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Category_ID = $_POST['category_id'];
        $Pro_Name = $_POST['name'];
        $Pro_Description = $_POST['description'];
        $Pro_Price = $_POST['price'];

        $Pro_Image = $_FILES['image']['name'];
        //rename Image Files
        $Image_Extension = pathinfo($Pro_Image,PATHINFO_EXTENSION);
        $Filename = time().".".$Image_Extension;

        $Pro_Status = isset($_POST['status']) ? '1':'0';

        $Check_Pro = "SELECT Pro_Name FROM product WHERE Pro_Name = '$Pro_Name' AND Category_ID = '$Category_ID'";
        $Check_Pro_run = mysqli_query($dataconnection,$Check_Pro);
        if(mysqli_num_rows($Check_Pro_run) > 0)
        {
            $_SESSION['message'] = "Products existed in the same categories!";
            header("location: addproduct.php");
        }
        else if($Pro_Price < 0 || preg_match('@[0-9]@',$Pro_Price) != 1)
        {
            $_SESSION['message'] = "Products price must be positive value!";
            header("location: addproduct.php");
        }
        else
        {
            $Pro_query = "INSERT INTO product (Category_ID,Pro_Name,Pro_Description,Pro_Price,Pro_Image,Pro_Status) VALUES ('$Category_ID','$Pro_Name','$Pro_Description','$Pro_Price','$Filename',$Pro_Status)" ;
            $Pro_query_run = mysqli_query($dataconnection,$Pro_query);
    
            if($Pro_query_run)
            {
                move_uploaded_file($_FILES['image']['tmp_name'],'../Admin/uploads/products/'.$Filename);
                $_SESSION['message'] = "Products Added Successfully!";
                header("location: products.php");
            }
            else
            {
                $_SESSION['message'] = "Products Added Unsuccessfully!";
                header("location: addproduct.php");
            }
        }
        
    }
    else if(isset($_POST['updateproductbtn']))
    {
        $Product_ID = $_POST['product_id'];

        $Category_ID = $_POST['category_id'];
        
        $Pro_Name = $_POST['name'];
        $Pro_Description = $_POST['description'];
        $Pro_Price = $_POST['price'];

        $Old_Filename = $_POST['Old_Image'];
        $Updated_Filename = "";
        $Pro_Image = $_FILES['image']['name'];
        
        if($Pro_Image != NULL)
        {
            //rename Image Files
            $Image_Extension = pathinfo($Pro_Image,PATHINFO_EXTENSION);
            $Filename = time().".".$Image_Extension;
            $Updated_Filename = $Filename;
        }
        else
        {
            $Updated_Filename = $Old_Filename;
        }
        
        $Pro_Status = isset($_POST['status']) ? '1':'0';

        $Check_Pro = "SELECT product.Pro_Name FROM product,category WHERE product.Pro_Name = '$Pro_Name' AND product.Category_ID = category.ID AND product.ID != '$Product_ID'";
        $Check_Pro_run = mysqli_query($dataconnection,$Check_Pro);
        if(mysqli_num_rows($Check_Pro_run) > 0)
        {
            $_SESSION['message'] = "Products existed in the same categories!";
            $_SESSION['product_id'] = $Product_ID;
            header("location: editproduct.php?");
        }
        else if($Pro_Price < 0 || preg_match('@[0-9]@',$Pro_Price) != 1)
        {
            $_SESSION['message'] = "Products price must be positive value!";
            $_SESSION['product_id'] = $Product_ID;
            header("location: editproduct.php?");
        }
        else
        {
            $updateproduct_query = "UPDATE product SET Category_ID = '$Category_ID', Pro_Name = '$Pro_Name', Pro_Description = '$Pro_Description', Pro_Price = '$Pro_Price', Pro_Image = '$Updated_Filename', Pro_Status = '$Pro_Status' WHERE ID = '$Product_ID'" ;
            $updateproduct_query_run = mysqli_query($dataconnection,$updateproduct_query);
            if($updateproduct_query_run)
            {
                if($Pro_Image != NULL)
                {
                    if(file_exists("../Admin/uploads/products/".$Old_Filename))
                    {
                        unlink("../Admin/uploads/products/".$Old_Filename);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'],'../Admin/uploads/products/'.$Updated_Filename);
                } 
                $_SESSION['message'] = "Product Updated Successfully!";
                header("location: products.php");
            }
            else
            {
                
                $_SESSION['message'] = "Product Updated Unsuccessfully!";
                $_SESSION['product_id'] = $Product_ID;
                header("location: editproduct.php?");
            }
        }
        
    }
    else if(isset($_POST['deleteproductbtn']))
    {
        $Current_Admin = $_SESSION['AID'];
        $Product_ID = $_POST['product_id'];
        $deleteproduct_query = "DELETE FROM product WHERE ID = '$Product_ID'";
        $deleteproduct_query_run = mysqli_query($dataconnection,$deleteproduct_query);

        if($deleteproduct_query_run)
        {
            $_SESSION['dmessage'] = "Product Deleted Successfully!";
            header("location: products.php");
        }
        else
        {
            $_SESSION['dmessage'] = "Product Deleted Unsuccessfully!";
            header("location: products.php");
        }
        
        
    }
?>