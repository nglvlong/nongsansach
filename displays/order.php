
<link rel="stylesheet" href="./css/cart.css">
<?php
         
         if (!empty($_SESSION['current_user'])) {
             $currentUser = $_SESSION['current_user'];
            
         ?>
  
  <?php
}
        ?>
<div class="total-page">
    <?php
    if (isset($_SESSION['current_user'])) {
    ?>
        <h1>Giỏ Hàng</h1>
        <?php
        if (!empty($_SESSION['cart'])) {
            $products = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham WHERE `MaSP` IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
        ?>
            <form action="?mod=displays/cart&action=submit" id="cart-content" method="POST" class="container">
                <table id="cart" class="cart">
                    <thead>
                        <tr>
                            <th style="width:52%">Sản phẩm</th>
                            <th style="width:17%">Giá</th>
                            <th style="width:10%">Số lượng</th>
                            <th style="width:17%" class="text-center">Thành tiền</th>
                            <th style="width:5%"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                        ?>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="img-product">
                                                <img src="uploads/<?= $row['AnhSP'] ?>" alt="<?= $row['TenSP'] ?>" class="img-responsive" width="100">
                                            </div>
                                            <div class="name-product">
                                                <h4 class="nomargin"><?= $row['TenSP'] ?></h4>
                                                <p><?= $row['MoTa'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><?= number_format($row['GiaSP'], 0, ',', '.') ?>₫</td>
                                    <td data-th="Quantity"><input class="form-control text-center"  value="<?= $_SESSION['cart'][$row['MaSP']] ?>">
                                    </td>
                                    <td data-th="Subtotal" class="text-center"><?= number_format((($_SESSION['cart'][$row['MaSP']]) * $row['GiaSP']), 0, ',', '.') ?>₫</td>
                                   
                                </tr>
                            <?php
                                $total += $row['GiaSP'] * $_SESSION['cart'][$row['MaSP']];
                                $num++;
                            }

                            ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            
                            <td><strong>Tổng tiền: </strong></td>
                            <td class="text-center"><strong><?= number_format($total, 0, ',', '.') ?>₫</strong>
                            </td>
                            
                        </tr>
                    <?php
                        }
                    ?>
                    </tfoot>

                </table>
                 <hr>
                 <?php
            $sql = "SELECT * FROM nongsansach.thongtinnguoinhan WHERE MaTK=" . $currentUser['MaTK'];
            $query = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="body-form_tt">
    <div class="form-login_tt">
<table>
        <div class="title-login_tt">
            <h3>Thông tin thanh toán</h3>
            <hr />
        </div>
        <div class="box-lg_tt">
        <div class="box-import_tt">
                <div class="box-input_tt">
                <i class="fas fa-user"></i>
                    <input type="text" value="<?= $row['TenNN'] ?>" name="TenKH" id="TenKH">
                    </div> 
                    </div>
                    <div class="box-import_tt">
                <div class="box-input_tt">
                    <i class="fas fa-mobile-alt"></i>
                    <input  type="text" value="<?= $row['SDTNN'] ?>" name="SDT" id="SDT">
                    </div> 
                    </div>
                    <div class="box-import_tt">
                <div class="box-input_tt">
                    <i class="fas fa-map-marker-alt"></i>
                    <input  type="text" value="<?= $row['DiaChi'] ?>" name="DiaChi" id="DiaChi">
                    </div> 
                    </div>
                    <div class="btn-login_tt">
                        <button type="submit" class="btn-lg" name="thanhtoan">Thanh Toán</button>
                    </div>
                    <a href="?mod=displays/products" class="cart-content_home">Về trang danh sách sản phẩm</a>
                </div>
            </table>
</div>
</div>
<?php
            }
            ?>
       <div class="col-md-4 hinhthucthanhtoan">
           <h4>Hình thức thanh toán</h4>
           <div class="form-check">
               <input class="form-check_input" type="radio" name="payment" id="Exampleradios2" value="tienmat" checked>
               <label class="form-check_label" for="Exampleradios2"></label>
               Tiền mặt
           </div>
           <div class="form-check">
               <input class="form-check_input" type="radio" name="payment" id="Exampleradios2" value="chuyenkhoan">
               <label class="form-check_label" for="Exampleradios2"></label>
               Chuyển khoản
           </div>
           <?php    
            $orderProducts = array();
            foreach ($orderProducts as $key => $product) {
                $total += $product['GiaSP'] * $_SESSION['cart'][$product['MaSP']];
                

            }
           ?>
           <input type="hidden" name="" value="<?php echo $total = round($total/23000) ?>" id="total">
           <div id="paypal-button-container">
               </div>
            </div>
            <!-- <div><label>Người nhận: </label><input type="text" value="" name="TenKH" /></div>
            <div><label>Điện thoại: </label><input type="text" value="" name="SDT" /></div>
            <div><label>Địa chỉ: </label><input type="text" value="" name="DiaChi" /></div>
            <div><label>Ghi chú: </label><textarea name="GhiChu" cols="50" rows="7" ></textarea></div>
            <section id="checkout-button" class="wrap-button ">
                <section class="left-buy-button"></section>
                <section class="content-buy-button">
                    <input type="submit" value="Đặt hàng" />
                </section>
                <section class="right-buy-button"></section>
                <section class="clear-both"></section>
            </section>
            <a href="?mod=displays/products" class="cart-content_home">Về trang danh sách sản phẩm</a> -->
            
            <!-- <div class="form-check">
                <input class="form-check_input" type="radio" name="payment" id="Exampleradios4" value="vnpay">
                <label class="form-check_label" for="Exampleradios4"></label>
                VNPAY
             </div> -->
            
        </form>
        
        <?php
        } else {
            ?>
            <div class="notify">
                <img src="./images/shop-cart-icon.png" alt="">
                <span>Giỏ hàng của bạn còn trống</span>
                <a href="?mod=displays/products" class="btn">Mua ngay</a>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="notify">
            <div class="fas fa-user-circle"></div>
            <span>Vui lòng đăng nhập để sử dụng chức năng giỏ hàng</span>
            <a href="displays/account.php" class="btn">Đăng nhập</a>
        </div>
        <?php
    }
    ?>
</div>
<div class="clear"></div>
<!-- <div class="box-import_tt">
<div class="box-input_tt">
<i class="fa-solid fa-comment"></i>
<textarea name="GhiChu" cols="50" rows="3" ></textarea>
</div> 
</div> -->