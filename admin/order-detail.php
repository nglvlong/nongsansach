<?php
    include '../db/config.php';
    $chitietdh = $_GET['chitietdh'];
    $order_detail = mysqli_query($connect, "SELECT * FROM nongsansach.chitietdonhang,nongsansach.sanpham where nongsansach.chitietdonhang.MaSP =
    nongsansach.sanpham.MaSP AND nongsansach.chitietdonhang.MaDH = '".$chitietdh."' ORDER BY nongsansach.chitietdonhang.MaCTDH DESC");
?>
<?php include './header.php'?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin đơn hàng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã chi tiết đơn hàng</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Ngày tạo</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_detail as $key => $value){?>
                                <tr>
                                    <td><?php echo $value['MaCTDH']?></td>
                                    <td><?php echo $value['MaDH'] ?></td>
                                    <td><?php echo $value['TenSP'] ?></td>
                                    <td><img src="../uploads/<?php echo $value['AnhSP'] ?>" alt="" width="100"></td>
                                    <td><?php echo $value['SoLuong'] ?></td>
                                    <td><?php echo $value['GiaSP'] ?></td>
                                    <td><?php echo $value['ThanhTien'] ?></td>
                                    <td><?php echo $value['NgayTao'] ?></td>
                                    
                                        
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
