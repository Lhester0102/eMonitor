<?php
    include_once("config.php");
    $inventory_id=$_REQUEST['id'];
    $rs=mysqli_query($mysqli,"delete from inventory where id=$inventory_id");
    if($rs)
    {
        echo'<script>alert("Record has been deleted!")</script>';
        header("Location:index.php");
    }
    else
    {
        echo'<script>alert("Delete record Error!")</script>';
    } 
?>