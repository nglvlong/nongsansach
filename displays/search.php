<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $sql1 = "SELECT * from nongsansach.sanpham inner join nongsansach.donvitinh on sanpham.MaDV=donvitinh.MaDV where `TenSP` like'%$keyword%'";
    $query1 = mysqli_query($connect, $sql1);
}
?>

<section class="product" id="product">
    <h1 class="heading">Kết quả tìm kiếm cho: <span>"<?php echo $keyword; ?>"</span></h1>
    <div class="box-container">
        <?php
        while ($row = mysqli_fetch_assoc($query1)) {
        ?>
            <form action="?mod=displays/cart&action=add" method="POST" class="box">
                <span class="discount">-33%</span>

                <img src="uploads/<?= $row['AnhSP'] ?>" alt="">
                <h3><?= $row['TenSP'] ?></h3>

                <div class="price"><?= number_format($row['GiaSP'], 0, ',', '.') ?>₫ <span> 99.000₫</span> </div>
                <div class="quantity">
                    <span>Số lượng : </span>
                    <input type="number" min="1" max="1000" value="1" name="quantity[<?= $row['MaSP'] ?>]">
                    <span> /<?= $row['TenDV'] ?></span>
                </div>
                <button type="submit" class="btn">Thêm vào giỏ</button>
                <button type="submit" class="btn">Mua ngay</button>
            </form>
        <?php
        }
        ?>


    </div>

</section>