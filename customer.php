<?php $page_title = "Customers"?>
<?php include("includes/header.php");?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Customers List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>    
                            </thead>
                            <tbody>
                                <?php
                                    $Customer = "SELECT * FROM user";
                                    $Customer_run = mysqli_query($userconnection, $Customer);
                                    
                                    if(mysqli_num_rows($Customer_run) > 0) {
                                        foreach($Customer_run as $items) {
                                            $User_Decrypted_FName = decryption($items['User_First_Name'], $Encryption_key);
                                            $User_Decrypted_LName = decryption($items['User_Last_Name'], $Encryption_key);
                                            $User_Decrypted_Name = $User_Decrypted_FName." ".$User_Decrypted_LName;
                                            $User_Decrypted_Email = decryption($items['User_Email'], $Encryption_key);
                                            ?>
                                            <tr>
                                                <td><?php echo $User_Decrypted_Name;?></td>
                                                <td><?php echo $User_Decrypted_Email;?></td>
                                                <td><?php echo $items['User_Status'] == '1'? "Enabled" : "Disabled" ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' class='text-center'><strong>No Customers Found!</strong></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                </div>    
            </div>
        </div>

        
    </div>
</div>

<?php include("includes/footer.php");?>
<?php include("includes/scripts.php");?>

<style>
    .card {
        border-radius: 15px;
    }
    .card-header {
        border-radius: 15px 15px 0 0;
    }
    .btn {
        border-radius: 5px;
    }
    .table {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .table th, .table td {
        padding: 12px;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .btn-sm {
        padding: 5px 10px;
    }
    .bg-gradient-dark {
        background: linear-gradient(180deg, #2a2a2a, #434343);
    }
    .bg-gradient-primary {
        background: linear-gradient(180deg, #1d2b64, #0e1731);
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .text-center {
        text-align: center;
    }
</style>
