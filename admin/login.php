<link rel="stylesheet" href="../css/account.css">
<?php
include '../db/config.php';

if (isset($_POST['emailam'])) {
    $emailam = $_POST['emailam'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM nongsansach.admin WHERE EmailAM='".$emailam."' AND Password='".$password."' LIMIT 1";
    $query = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($query);
    if ($count>0){
            $_SESSION['dangnhap'] = $emailam;
            header('location: ./index.php');
        } else {
            echo '<script>Tài khoản hoặc mật khẩu không đúng</script>';
            header('location: login.php');

        }
    } 
    
?>

<div class="banner">
        <div class="form-box">
            <div class="button-box">
                <div id="btna"></div>
                <button type="button" class="toggle-btnn" onclick="login()">Đăng Nhập</button>
            </div>
            <form action="" class="input-group" id="login" method="POST">
                <input type="text" class="input-field" placeholder="Tên Đăng Nhập" name="emailam" required>
                <span class="login-sp"><?php echo (isset($err['emailam'])) ? $err['emailam'] : '' ?></span>
                <input type="text" class="input-field" placeholder="Mật Khẩu" name="password" required>
                <span class="login-sp"><?php echo (isset($err['password'])) ? $err['password'] : '' ?></span>
                <button type="submit" class="submit-btn">Đăng Nhập</button>
            </form>
            </div>
    </div>