<?php
    include '../db/config.php';
    
    $member = mysqli_query($connect, "SELECT * FROM nongsansach.taikhoan ORDER BY MaTK DESC");
?>
<?php include './header.php'?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách khách hàng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã tài khoản</th>
                                    <th>Email khách hàng</th>
                                    <th>Mật khẩu</th>
                                    <th>Tên khách hàng</th>
                                    <th>Phương thức đăng nhập</th>
                                    <th>Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th>Giới tính</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($member as $key => $value){?>
                                <tr>
                                    <td><?php echo $value['MaTK']?></td>
                                    <td><?php echo $value['Email'] ?></td>
                                    <td><?php echo $value['Pass'] ?></td>
                                    <td><?php echo $value['TenKH'] ?></td>
                                    <td><?php echo $value['TypeTK'] ?></td>
                                    <td><?php echo $value['NgaySinh'] ?></td>
                                    <td><?php echo $value['SDT'] ?></td>
                                    <td><?php echo $value['GioiTinh'] ?></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'?>
