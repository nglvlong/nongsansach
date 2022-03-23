<section class="home" id="home">
    <div class="image">
        <img src="images/home-img.png" alt="">
    </div>
    <div class="content">
        <span>Sản phẩm tươi và sạch</span>
        <h3>Tốt cho sức khỏe của bạn</h3>
        <a href="#" class="btn">Tìm hiểu</a>
    </div>
</section>
<section class="category" id="category">
    <h1 class="heading">Những sản phẩm trong <span>danh mục</span></h1>
    <div class="box-container">
        <?php
        $sql = "SELECT * FROM nongsansach.danhmuc;";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
        ?>

            <div class="box">
                <h3><?= $row['TenDM'] ?></h3>
                <img src="uploads/<?= $row['HinhDD'] ?>" alt="">
                <a href="?mod=displays/productlist&id=<?= $row['MaDM'] ?>" class="btn">Mua ngay</a>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<section class="product" id="product">
    <h1 class="heading">Sản phẩm <span>mới</span></h1>
    <div class="box-container">
        <?php
         if(isset($_GET['trang'])){
            $page = $_GET['trang'];
        }else{
            $page = 1;
        }
        if($page == '' || $page == 1){
            $begin = 0;
        }else{
            $begin = ($page*3)-3;
        }
        $sql = "SELECT * FROM nongsansach.sanpham inner join nongsansach.donvitinh on sanpham.MaDV=donvitinh.MaDV ORDER BY nongsansach.sanpham.MaSP DESC LIMIT $begin,5";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <!-- ?mod=displays/cart&action=add -->
            <form action="" class="quick-by-form box" method="POST" enctype="multipart/form-data">
                <span class="discount">-33%</span>

                <a href="?mod=displays/productDetail&id=<?= $row['MaSP'] ?>"><img src="uploads/<?= $row['AnhSP'] ?>" alt=""></a>
                <h3><?= $row['TenSP'] ?></h3>

                <div class="price"><?= number_format($row['GiaSP'], 0, ',', '.') ?>₫ <span> 99.000₫</span> </div>
                <?php
                if ($row['SoLuong'] > 0) {
                ?>
                    <div class="quantity">
                        <span>Số lượng : </span>
                        <input type="number" min="1" max="1000" value="1" name="quantity[<?= $row['MaSP'] ?>]">
                        <span> /<?= $row['TenDV'] ?></span>
                    </div>
                    <button type="submit" class="btn">Thêm vào giỏ</button>
                <?php
                } else {
                ?>

                    <div>
                        <h1 style="color: red;font-size: 20px;"><strong>Hết hàng</strong></h1>
                    </div>
                <?php
                }
                ?>
            </form>
        <?php
        }
        ?>
    </div>
    </div style="clear: both;"></div>
    
    <?php
        $sql_trang = mysqli_query($connect,"SELECT * FROM nongsansach.sanpham");
        $row_count = mysqli_num_rows($sql_trang);
        $trang = ceil($row_count/3);

    ?>
    <p>Trang hiện tại: <?php echo $page?>/<?php echo $trang ?></p>
    <ul class="list-trang">
        <?php
        for($i=1;$i<=$trang;$i++){
        ?>
        <li><a <?php if($i==$page){echo  '"';}else{echo '';}?> href="?mod=displays/home&trang=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
        }
        ?>
        
    </ul>
</section>
