<?php
    include '../db/config.php';
    
    $order = mysqli_query($connect, "SELECT * FROM nongsansach.donhang ORDER BY MaDH DESC");
?>
<?php include './header.php'?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách đơn hàng</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $key => $value){?>
                                <tr>
                                    <td><?php echo $value['MaDH']?></td>
                                    <td><?php echo $value['TenKH'] ?></td>
                                    <td><?php echo $value['SDT'] ?></td>
                                    <td><?php echo $value['DiaChi'] ?></td>
                                    <td><?php echo $value['TrangThai'] ?></td>
                                    <td>
                                        <?php if($value['TrangThai']==1){
                                        echo '<a class="label label-danger" href="./xuly-order.php?TrangThai=0&chitietdh='.$value['TrangThai'].'">Chưa xử lý</a>';
                                    
                                        } elseif($value['TrangThai']==0){
                                            echo '<a class="label label-success" href="./xuly-order.php?TrangThai=1&chitietdh='.$value['TrangThai'].'">Đã xử lý</a>';
                                        }else{
                                        echo 'Hủy đơn hàng';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value['Payment'] ?></td>
                                    <td> 
                                        <a href="./order-detail.php?chitietdh=<?php echo $value['MaDH'] ?>" class="btn btn-outline-success" title="Xem đơn hàng"><span class="fas fa-edit"></span></a>
                                         <a href="./order-delete.php?madh=<?php echo $value['MaDH']?>" class="btn btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa không')"><span class="fas fa-window-close"></span></a>        
                                    </td>
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
