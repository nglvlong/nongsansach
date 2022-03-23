<?php

if (!empty($_SESSION['current_user'])) {
    $currentUser = $_SESSION['current_user'];
    $sql = "SELECT * FROM nongsansach.taikhoan WHERE MaTK=" . $currentUser['MaTK'];
    $query = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($query);
    $date = date_create($data['NgaySinh']);
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $ngaysinh  =  $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
    $sql2 = "UPDATE nongsansach.taikhoan SET `TenKH` = '$name', `SDT` ='$sdt', `GioiTinh` ='$gioitinh', `NgaySinh` ='$ngaysinh' WHERE `MaTK`=" . $currentUser['MaTK'];
    $query2 = mysqli_query($connect, $sql2);
    header('location: index.php?mod=displays/personalInfo');
}

?>
<link rel="stylesheet" href="./css/personalInfo.css">

<section class="manage-info">
    <div class="menu">
        <ul>
            <li class="select activeMenu">
                <a href="?mod=displays/personalInfo" onclick="openInfo(event,'personInfo')">Thông tin cá nhân</a>
            </li>
            <li class="select">
                <a href="?mod=displays/address" onclick="openInfo(event,'address')">Địa chỉ</a>
            </li>
            <li class="select">
                <a href="?mod=displays/changepass" onclick="openInfo(event,'address')">Đổi mật khẩu</a>
            </li>
        </ul>
    </div>
    <form class="tabcontent" id="personInfo" method="POST" action="?mod=displays/personalInfo&action=submit">
        <h1><i class="fa-solid fa-user"></i> Thông tin cá nhân</h1>
        <hr>
        <table class="table-info">
            <tr>
                <td class="col-1">Họ tên:</td>
                <td class="col-2"><input type="text" name="name" value="<?= $data['TenKH'] ?>"></td>
            </tr>
            <tr>
                <td class="col-1">Email:</td>
                <td class="col-2 email"><?= $data['Email'] ?></td>
            </tr>
            <tr>
                <td class="col-1">Số điện thoại:</td>
                <td class="col-2"><input type="text" name="sdt" id="" value="<?= $data['SDT'] ?>"></td>
            </tr>
            <tr>
                <td class="col-1">Giới tính:</td>
                <td class="col-2">
                    <div class="container">
                        <input type="radio" name="gioitinh" <?php ($data['GioiTinh'] == 'Nam' ? print 'checked' : print '') ?> value="Nam">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkmark"></span>
                    </div>
                    <div class="container">
                        <input type="radio" name="gioitinh" <?php ($data['GioiTinh'] == 'Nữ' ? print 'checked' : print '') ?> value="Nữ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nữ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="checkmark"></span>

                    </div>
                    <div class="container">
                        <input type="radio" name="gioitinh" <?php ($data['GioiTinh'] == '' ? print 'checked' : print '') ?> value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Khác
                        <span class="checkmark"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-1">Ngày sinh:</td>
                <td class="col-2">
                    <select name="year" id="year" size="1">
                        <option value="<?php print date_format($date, "Y") ?>"><?php print date_format($date, "Y") ?></option>
                    </select>
                    <select name="month" id="month" size="1">
                        <option value="<?php print date_format($date, "m") ?>"><?php print date_format($date, "m") ?></option>
                    </select>
                    <select name="day" id="day" size="1">
                        <option value="<?php print date_format($date, "d") ?>" selected><?php print date_format($date, "d") ?></option>
                    </select>

                </td>
            </tr>
        </table>
        <div class="picture">
            <img src="<?= $data['Avatar'] ?>" alt="">
        </div>
        <button type="submit" class="btn">Lưu</button>
    </form>
</section>
<script src="./js/script2.js"></script>