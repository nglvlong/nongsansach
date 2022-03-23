<?php
$host_name = 'localhost';
$db_name = 'mysql';
$user_name = 'root';
$password = '';

$connect = mysqli_connect($host_name, $user_name, $password, $db_name) or die('Lỗi kết nối');

mysqli_query($connect, "set name utf8");
session_start();
