
<section class="footer" id="contact">
    <div class="box-container">
        <div class="box">
            <a href="#" class="logo"></i>Nông trại organic</a>
            <p> Địa chỉ: 326 Hà Huy Tập, Thanh Khuê, Đà Nẵng </p>
            <p> Điện thoại: 0878.63.66.69</p>
            <p> E-mail: shopnongsansach@gmail.com</p>
            <p> Website: shopnongsansach.com</p>
            <div class="share">
                <a href="#" class="btn fab fa-facebook-f"></a>
                <a href="#" class="btn fab fa-twitter"></a>
                <a href="#" class="btn fab fa-instagram"></a>
                <a href="#" class="btn fab fa-linkedin"></a>
            </div>
        </div>
        <div class="box">
            <h3>Cam kết</h3>
            <p> - Giá ưu đãi nhất. </p>
            <p> - Sản phẩm chất lượng.</p>
            <p> - Truy xuất nguồn gốc rõ ràng.</p>

        </div>
        <div class="box">
            <h3>CHÍNH SÁCH & BẢO MẬT</h3>
            <div class="links">
                <a href="#">Chính sách thanh toán</a>
                <a href="#">Chính sách vận chuyển</a>
            </div>
        </div>
    </div>
    <h1 class="credit"> Copyright © 2021 Nông Sản Sạch</h1>
</section>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<script>
    $("#cart-content").validate({
        rules: {
            TenKH: {
                required: true
            },
            SDT: {
                required: true,
                minlength: 8
            },
            DiaChi: {
                required: true
            }
        },
        messages: {
            TenKH: {
                required: "Bạn phải nhập họ và tên"
            },
            SDT: {
                required: "Bạn phải nhập số điện thoại",
                minlength: "Số điện thoại phải có ít nhất 8 ký tự"
            },
            DiaChi: {
                required: "Bạn phải nhập địa chỉ của mình"
            }
        },
        submitHandler: function (form) {
            
            $.ajax({
                type: "POST",
                url: './displays/ajax/cart/processCart.php?action=submit',
                data: $(form).serializeArray(),
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.status == 0) { //Đăng nhập lỗi
                        alert(response.message);
                    } else { //Đăng nhập thành công
                        alert(response.message);
                        location.href = '?mod=displays/cart';
                       
                    }
                }
            });
        }
    });
</script>
<script>
    function updateQuantity(quantity) {
        if (quantity != "") {
            $.ajax({
                type: 'POST',
                url: './displays/ajax/cart/processCart.php?action=update',
                data: $('#cart-content').serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 0) {
                        alert(response.message);
                        location.reload();
                    } else {
                        // alert(response.message);
                        location.reload();
                    }
                }
            });
        }
    }

    function deleteCart(productId) {
        $.ajax({
            type: 'POST',
            url: './displays/ajax/cart/processCart.php?action=delete',
            data: {
                "id": productId
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.message);
                } else {
                    alert(response.message);
                    location.reload();
                }
            }
        });
    }

    $('#add-to-cart').validate({
        rules: {
            "quantity[<?= isset($row['MaSP']) ? $row['MaSP'] : 0 ?>]": {
                required: true,
                remote: {
                    url: './displays/ajax/cart/checkQuantity.php',
                    type: 'post',
                }
            }
        },
        submitHandler: function(form) {
            $.ajax({
                type: 'POST',
                url: './displays/ajax/cart/processCart.php?action=add',
                data: $(form).serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 0) { //mua ko thành công
                        alert(response.message);
                    } else { //mua thành công
                        alert(response.message);
                        location.reload();
                    }
                }
            })
        }
    });
</script>
<script>
    $('.quick-by-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: './displays/ajax/cart/processCart.php?action=add',
            data: $(this).serializeArray(),
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == 0) { //có lỗi
                    alert(response.message);
                } else { //mua thành công
                    alert(response.message);
                    location.reload();
                }
            }
        })
    })
</script>

   
