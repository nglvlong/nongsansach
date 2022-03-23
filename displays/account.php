<?php
include '../db/config.php';
include '../api/google_source.php';
include '../api/facebook_source.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);


    $sql1 = "SELECT * FROM nongsansach.taikhoan WHERE Email='".$email."' AND Pass='".$pass."' LIMIT 1";
    $query1 = mysqli_query($connect, $sql1);
    $data = mysqli_fetch_assoc($query1);
    $checkEmail = mysqli_num_rows($query1);
    if ($checkEmail == 1) {
        $checkPass = mysqli_num_rows($query1);
        if ($checkPass>0) {
            $_SESSION['current_user'] = $data;
            header('location: ../index.php');
        } else {
            echo "Sai mật khẩu.";
        }
    } else {
        echo 'Email không tồn tại.';
    }
} 

if (isset($_POST['rName'])) {
    $rname = $_POST['rName'];
    $remail = $_POST['rEmail'];
    $rpass = md5($_POST['rPass']);
    $rrpass = md5($_POST['rrPass']);
    if (empty($rname)) {
        $err['rName'] = 'Ban chua nhap ten';
    }
    if (empty($remail)) {
        $err['rEmail'] = 'Ban chua nhap email';
    }
    if (empty($rpass)) {
        $err['rPass'] = 'Ban chua nhap password';
    }
    if ($rpass != $rrpass) {
        $err['rrPass'] = 'Mật khẩu nhập lại không đúng';
    }
    $sql2 = "SELECT * FROM nongsansach.taikhoan WHERE Email='$remail'";
    $query2 = mysqli_query($connect, $sql2);
    $data2 = mysqli_fetch_array($query2);
    $checkEmail2 = mysqli_num_rows($query2);
    if ($remail == $data2['Email']) {
        $err['rEmail'] = 'Tài khoản này đã tồn tại';
    }if(empty($err)){
        $sql3 = "INSERT INTO nongsansach.taikhoan(Email,Pass,TenKH) VALUES ('$remail','$rpass','$rname')";
        $query3 = mysqli_query($connect, $sql3);
        if ($query3) {
            header('location: ../displays/account.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/account.css">
    <title>Nông sản sạch</title>
</head>

<body>
    <div class="banner">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Đăng Nhập</button>
                <button type="button" class="toggle-btn" onclick="register()">Đăng Ký</button>
            </div>
            <div class="social-icons">
                <a href="<?= $loginUrl ?>"><img src="../images/fb.png"></a>
                <a href="<?= $authUrl ?>"><img src="../images/google.png"></a>
                <img src="../images/zalo.jpg">
            </div>
            <form action="" method="POST" class="input-group" id="login">
                <input type="text" class="input-field" placeholder="Tên Đăng Nhập" name="email" required>
                <span class="login-sp"><?php echo (isset($err['email'])) ? $err['email'] : '' ?></span>
                <input type="password" class="input-field" placeholder="Mật Khẩu" name="pass" required>
                <span class="login-sp"><?php echo (isset($err['pass'])) ? $err['pass'] : '' ?></span>
                <input type="checkbox" class="check-box">
                <span class="login-sp" style="color:#696969">Nhớ Mật Khẩu</span>
                <button type="submit" class="submit-btn">Đăng Nhập</button>

            </form>
            <form action="" method="POST" class="input-group" id="register">
                <input type="text" class="input-field" placeholder="Tên Đăng Nhập" name="rName" required>
                <span class="login-sp"><?php echo (isset($err['rName'])) ? $err['rName'] : '' ?></span>
                <input type="text" class="input-field" placeholder="Địa chỉ email" name="rEmail" required>
                <span class="login-sp"><?php echo (isset($err['rEmail'])) ? $err['rEmail'] : '' ?></span>
                <input type="password" class="input-field" placeholder="Mật Khẩu" name="rPass" required>
                <span class="login-sp"><?php echo (isset($err['rPass'])) ? $err['rPass'] : '' ?></span>
                <input type="password" class="input-field" placeholder="Nhập Lại Mật Khẩu" name="rrPass" required>
                <span class="login-sp"><?php echo (isset($err['rrPass'])) ? $err['rrPass'] : '' ?></span>
                <input type="checkbox" class="check-box">
                <span class="login-sp" style="color:#696969">Tôi đồng ý với các điều khoản của trang web</span>
                <button type="submit" class="submit-btn">Đăng Ký</button>
               
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn")

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "140px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
    </script>
</body>

</html>