<?php
    include '../db/config.php';
    $product = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham ,nongsansach.danhmuc, nongsansach.donvitinh WHERE nongsansach.sanpham.MaDM = nongsansach.danhmuc.MaDM AND nongsansach.sanpham.MaDV = nongsansach.donvitinh.MaDV ORDER BY MaSP DESC");

    // phân trang danh mục
// buoc 1 tinh tong so ban ghi
$total1= mysqli_num_rows($product);
// buoc 2 thiet lap so ban ghi tren 1 trang
$limit1=3;
// buoc 3 tinh so trang 
$page1=ceil($total1/$limit1);
// buoc 4 lay trang hien tai
$cr_pro = (isset($_GET['page'])? $_GET['page'] : 1);
// buoc 4 tinh start
$start1 =($cr_pro - 1)*$limit1;
// buoc 5 query du lieu
$product = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham,nongsansach.danhmuc, nongsansach.donvitinh WHERE nongsansach.sanpham.MaDM = nongsansach.danhmuc.MaDM AND nongsansach.sanpham.MaDV = nongsansach.donvitinh.MaDV ORDER BY MaSP DESC LIMIT $start1,$limit1");
?>
<?php include './header.php'?>
<div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Sản phẩm</h3>
                </div>
                <div class="panel-body">
                    <a href="./add-product.php" class="btn btn-info">Thêm mới</a>
                </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh sách sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Mô tả</th>
                                    <th>Tên danh mục</th>
                                    <th>Tên đơn vị</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product as $key => $value):?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value['TenSP'] ?></td>
                                    <td><img src="../uploads/<?php echo $value['AnhSP'] ?>" alt="" width="100"></td>
                                    <td><?php echo $value['SoLuong'] ?></td>
                                    <td><?php echo $value['GiaSP'] ?></td>
                                    <td><?php echo $value['MoTa'] ?></td>
                                    <td><?php echo $value['TenDM'] ?></td>
                                    <td><?php echo $value['TenDV'] ?></td>

                                    <td> 
                                        <a href="./edit-product.php?masp=<?php echo $value['MaSP']?>" class="btn btn-outline-success" title="Sửa"><span class="fas fa-edit"></span></a>
                                         <a href="./delete-product.php?masp=<?php echo $value['MaSP']?>" class="btn btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa không')"><span class="fas fa-window-close"></span></a>        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if($cr_pro - 1 >0){?>
                        <li class="page-item">
                        <a class="page-link" href="product.php?page=<?php echo $cr_pro - 1 ?>">Previous</a>
                        </li>
                        <?php } ?>
                        <?php for ($i = 1; $i <=$page1; $i++) {?>
                            <li class="page-item <?php echo (($cr_pro == $i)? 'active': '' )?>"><a class="page-link" href="product.php?page=<?php echo $i?>"><?php echo $i ?></a></li> 
                            <?php }?>
                        <?php if($cr_pro + 1 <=$page1){?>
                        <li class="page-item">
                        <a class="page-link" href="product.php?page=<?php echo $cr_pro + 1 ?>">Next</a>
                        </li>
                        <?php } ?>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include './footer.php'?>
