<?php
include '../db/config.php';
    if(isset($_GET['madv'])){
        $id = $_GET['madv'];

       $query= mysqli_query($connect, "DELETE FROM nongsansach.donvitinh where MaDV=$id");
    if($query){
        header('Location: ./unit.php');
    }else{
        echo 'Xoá không thành công';
    }
    }
?>
