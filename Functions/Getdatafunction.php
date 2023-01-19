<?php
include("dataconnection.php");
    function getalldata($table)
    {
        global $dataconnection;
        $query = "SELECT * FROM $table";
        return $query_run = mysqli_query($dataconnection,$query);
    }

    function getbyid($table,$id)
    {
        global $dataconnection;
        $query = "SELECT * FROM $table WHERE ID = '$id'";
        return $query_run = mysqli_query($dataconnection,$query);
    }
?>