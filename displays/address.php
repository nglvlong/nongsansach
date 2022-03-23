<link rel="stylesheet" href="./css/personalInfo.css">
<?php
if (isset($_POST['editname'])) {
    $mann = $_POST['editmann'];
    $name = $_POST['editname'];
    $sdt = $_POST['editsdt'];
    $sonha = $_POST['editsonha'];
    $diachi = $_POST['editaddress'];
    $sql2 = "UPDATE nongsansach.thongtinnguoinhan SET `TenNN`='$name', `SDTNN`='$sdt', `SoNha`='$sonha', `DiaChi`='$diachi' where `MaNN`='$mann'";
    $query2 = mysqli_query($connect, $sql2);
}
if (isset($_POST['addname'])) {
    $addname = $_POST['addname'];
    $addsdt = $_POST['addsdt'];
    $addsonha = $_POST['addsonha'];
    $adddiachi = $_POST['adddiachi'];
    $sql3 = "INSERT INTO nongsansach.thongtinnguoinhan(`TenNN`,`SDTNN`,`SONHA`,`DIACHI`,`MaTK`) VALUES ('$addname','$addsdt','$addsonha','$adddiachi','" . $currentUser['MaTK'] . "')";
    $query3 = mysqli_query($connect, $sql3);
}
?>
<section class="manage-info">
    <div class="menu">
        <ul>
            <li class="select">
                <a href="?mod=displays/personalInfo" onclick="openInfo(event,'personInfo')">Thông tin cá nhân</a>
            </li>
            <li class="select activeMenu">
                <a href="?mod=displays/address" onclick="openInfo(event,'address')">Địa chỉ</a>
            </li>
            <li class="select">
                <a href="?mod=displays/changepass" onclick="openInfo(event,'address')">Đổi mật khẩu</a>
            </li>
        </ul>
    </div>
    <div class="tabcontent" id="address">
        <h1><i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng</h1>
        <button class="btn btn-address">+ Thêm mới địa chỉ</button>
        <table class="table-address">
            <?php
            $sql = "SELECT * FROM nongsansach.thongtinnguoinhan WHERE MaTK=" . $currentUser['MaTK'];
            $query = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-1">Họ tên:</td>
                        <td class="col-2"><?= $row['TenNN'] ?></td>
                        <td class="col-3"></td>
                    </tr>
                    <tr>
                        <td class="col-1">Số điện thoại:</td>
                        <td class="col-2"><?= $row['SDTNN'] ?></td>
                        <td style="display: none;"><?= $row['MaNN'] ?></td>
                        <td class="col-3">
                            <form action="" method="POST">
                                <div class="btnedit fa-solid fa-pen"></div>&nbsp;
                                <div class="btndelete fa-solid fa-trash-can"></div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-1">Địa chỉ:</td>
                        <td class="col-2">
                            <label for=""><?= $row['SoNha'] ?></label>
                            <br>
                            <label for=""><?= $row['DiaChi'] ?></label>
                        </td>
                        <td class="col-3"></td>
                    </tr>

                </tbody>
            <?php
            }
            ?>
        </table>
        <div id="edit" style="display: none;"></div>
    </div>
</section>
<script src="./js/script2.js"></script>