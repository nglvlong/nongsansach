<?php
$result = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham WHERE MaSP=" . $_GET['id']);
$product = mysqli_fetch_assoc($result);
$imgLibrary = mysqli_query($connect, "SELECT * FROM nongsansach.thuvienanh WHERE nongsansach.thuvienanh.MaSP  = ' $_GET[id]' LIMIT 4");
            $product['imagesps'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
?>
<div class="small-container single-product">
    <div class="row">
        <div class="col-1">
            <div class="slider-for">
                <div class="">
                <img src="uploads/<?= $product['AnhSP'] ?>" class="small-img" width="100">

                </div>
                <?php foreach ($product['imagesps'] as $img) { ?>
                    <div class="small-img-col">
                    
                     <img src="uploads/<?= $img['path'] ?>" class="small-img">
                     </div>
                
                <?php } ?>
            </div>
            <div class="slider-nav">
                <div class="small-img-col">
                <img src="uploads/<?= $product['AnhSP'] ?>" class="small-img" width="100">
                </div>
                <?php foreach ($product['imagesps'] as $img) { ?>
                    <div class="small-img-col">
                    
                     <img src="uploads/<?= $img['path'] ?>" class="small-img">
                     </div>
                
                <?php } ?>
                
            </div>
        </div>
        <div class="col-2">
            <h1 style="color: var(--green);"><?= $product['TenSP'] ?></h1>
            <br>
            <h2><?= $product['MoTa'] ?></h2>
            <h4><?= number_format($product['GiaSP'], 0, ',', '.') ?><span class="unit">₫</span></h4>
            <h2>Tồn kho: <?= $product['SoLuong'] ?></h2>
            <?php
            if ($product['SoLuong'] > 0) {
            ?>
                <form action="" method="POST" id="add-to-cart">
                    <input type="number" min="1" max="100" value="1" name="quantity[<?= $product['MaSP'] ?>]">
                    <!-- <button class="add-cart" type="submit">Thêm vào giỏ</button> -->
                    <br>
                    <label id="quantity[<?= $product['MaSP'] ?>]-error" class="error" for="quantity[<?= $product['MaSP'] ?>]"></label>
                    <br>
                    <button type="submit" class="btn">Thêm vào giỏ</button>
                </form>
            <?php
            } else {
            ?>
                <h1 style="color: red;font-size: 20px;"><strong>Hết hàng</strong></h1>
            <?php
            }
            ?>
            <br>
            <br>
            <h2>Chi tiết sản phẩm</h2>
            <br>
            <div class="clear-both"></div>
            <p><?= $product['MoTa'] ?></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            autoplay: true,
            asNavFor: '.slider-nav',
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            autoplay: true,
            centerMode: true,
            focusOnSelect: true,
            infinite: true,
            prevArrow: '<button type="button" class="slick-prev"><ion-icon name="caret-back-circle-outline"></ion-icon></button>',
            nextArrow: '<button type="button" class="slick-next"><ion-icon name="caret-forward-circle-outline"></ion-icon></button>',

        });
    })
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>