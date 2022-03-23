<header>
    <div class="header-1">
        <a href="?mod=displays/home" class="logo"></i>Nông trại organic</a>
        <form action="?mod=displays/search" method="post" class="search-box-container">
            <input type="text" id="search-box" autocomplete="off" name="keyword" placeholder="Tìm kiếm ở đây..." require>
            <button type="submit" class="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="header-2">
        <div id="menu-bar" class="fas fa-bars"></div>
        <nav class="navbar">
            <a href="?mod=displays/home">Trang chủ</a>
            <a href="?mod=displays/products">Sản phẩm</a>
            <a href="?mod=displays/contact">Liên hệ</a>
            <a href="?mod=displays/introduce">Giới thiệu</a>
        </nav>
        <div class="icons">
            <a href="?mod=displays/cart" class="fas fa-shopping-cart"></a>
            <span></span>
            <?php
            if (!empty($_SESSION['current_user'])) {
                $currentUser = $_SESSION['current_user'];
                $sql = "SELECT * FROM nongsansach.taikhoan WHERE MaTK=" . $currentUser['MaTK'];
                $query = mysqli_query($connect, $sql);
                $data = mysqli_fetch_assoc($query);
            ?>
                <div class="dropdown">
                    <img src="<?= $data['Avatar'] ?>" alt="<?= $data['Avatar']; ?>" height="40" width="40">
                    <div class="dropdown-contents">
                        <div class="display-info">
                            <img src="<?= $data['Avatar'] ?>" alt="<?= $data['Avatar']; ?>">
                            <h1><?= $data['TenKH'] ?></h1>
                        </div>
                        <hr>
                        <ul>
                            <li><a href="?mod=displays/personalInfo"><i class="fa-solid fa-user"></i>&nbsp;Thông tin cá nhân</a></li>
                            <li><a href="#"><i class="fa-solid fa-lock"></i>&nbsp;Bảo mật</a></li>
                            <li><a href="displays/logout.php" class=""><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;Logout</a></li>
                        </ul>
                    </div>

                </div>
            <?php
            } else {
            ?>
                <a href="displays/account.php" class="fas fa-user-circle"></a>';
            <?php
            }
            ?>
        </div>

    </div>

</header>