<?php
include '../db/config.php';
    if(isset($_GET['masp'])){
        $id = $_GET['masp'];

       $query= mysqli_query($connect, "DELETE FROM nongsansach.sanpham where MaSP=$id");
    if($query){
        header('Location: ./product.php');
    }else{
        echo 'Xoá không thành công';
    }
    }
?>