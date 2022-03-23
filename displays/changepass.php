<?php
if (isset($_POST['changepass'])) {
    $pass_cu =md5($_POST['passcu']);
    $pass_moi =md5($_POST['passmoi']);

    $sql = "SELECT * FROM nongsansach.taikhoan WHERE  Pass='".$pass_cu."'";
    $row = mysqli_query($connect,$sql);
    $checkPass = mysqli_num_rows($row);
    if ($checkPass >0) {
        $sql_update = mysqli_query($connect,"UPDATE nongsansach.taikhoan SET  Pass='".$pass_moi."'");
        echo '<p style="color:green">("Đã đổi mật khẩu thành công.");</p>';
        
    }else{
        echo '<p style="color:red">("Tài khoản hoặc mật khẩu không đúng vui lòng nhập lại.");</p>';
        
    }
}
?>
<link rel="stylesheet" href="./css/personalInfo.css">

<section class="manage-info">
    <div class="menu">
        <ul>
            <li class="select ">
                <a href="?mod=displays/personalInfo" onclick="openInfo(event,'personInfo')">Thông tin cá nhân</a>
            </li>
            <li class="select">
                <a href="?mod=displays/address" onclick="openInfo(event,'address')">Địa chỉ</a>
            </li>
            <li class="select activeMenu">
                <a href="?mod=displays/changepass" onclick="openInfo(event,'address')">Đổi mật khẩu</a>
            </li>
        </ul>
    </div>
    <form class="tabcontent" id="personInfo" method="POST" action="">
        <h1><i class="fa-solid fa-user"></i> Đổi Mật Khẩu</h1>
        <span style="font-size: 16px;color:#aaa">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</span>
        <hr>
        <table class="table-info">
            <tr>
                <td class="col-1">Mật khẩu cũ:</td>
                <td class="col-2"><input type="password" name="passcu" value="" placeholder="Mật khẩu cũ"></td>
            </tr>
            <tr>
                <td class="col-1">Mật khẩu mới:</td>
                <td class="col-2"><input type="password" name="passmoi" value="" placeholder="Mật khẩu mới"></td>
            </tr>
            <tr>
                <td class="col-1">Nhập lại mật khẩu:</td>
                <td class="col-2"><input type="password" name="passmoi" value="" placeholder="Nhập lại mật khẩu"></td>
            </tr>


        </table>
        <button type="submit" name="changepass" class="btn">Xác Nhận</button>
    </form>
</section>
</body>

</html>