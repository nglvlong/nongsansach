<link rel="stylesheet" href="./css/cart.css">

<?php

    // if(isset($_GET['vnp_Amount'])){
    //     $vnp_Amount = $_GET['vnp_Amount'];
    //     $vnp_BankCode = $_GET['vnp_BankCode'];
    //     $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    //     $vnp_CardType = $_GET['vnp_CardType'];
    //     $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    //     $vnp_PayDate = $_GET['vnp_PayDate'];
    //     $vnp_TmnCode = $_GET['vnp_TmnCode'];
    //     $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    //     $code_cart = $_SESSION['code_cart'];

    //     $insert_vnpay = "INSERT INTO nongsansach.vnpay(amount,bankcode,banktranno,cardtype,orderinfo,paydate,tmncode,transactionno,code_cart)
    //     VALUE ('".$vnp_Amount."','".$vnp_BankCode."','".$vnp_BankTranNo."','".$vnp_CardType."','".$vnp_OrderInfo."','".$vnp_PayDate."','".$vnp_TmnCode."',
    //     '".$vnp_TransactionNo."','".$code_cart."')";
    //     $cart_query = mysqli_query($connect,$insert_vnpay);
    //     if($cart_query){
    //         echo '<h3 style="text-align: center; margin-top:20px; font-size:2.5rem">Giao dịch thanh toán bằng VNPAY thành công</h3>';

            
    //     }else{
    //         echo 'Giao dịch thất bại';
    //     }
    // }else{

// Tai khoan Test PAYPAL
// TK: hai888880@personal.example.com
// MK: Hai0987994431
        if(isset($_GET['thanhtoan'])=='paypal'){
            $card_payment='paypal';
            $products = mysqli_query($connect, "SELECT * FROM nongsansach.sanpham WHERE MaSP IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
            $total = 0;
            $orderProducts = array();
            $updateString = "";
            $changeQuantity = false;
            $code_order = rand(0,9999);
            $trangthai=0;
            while ($row = mysqli_fetch_array($products)) {
                $orderProducts[] = $row;
                if ($_SESSION['cart'][$row['MaSP']] > $row['SoLuong']) { //Thay đổi số lượng sản phẩm trong giỏ hàng
                    $_SESSION['cart'][$row['MaSP']] = $row['SoLuong'];
                    $changeQuantity = true;
                } else {
                    $total += $row['GiaSP'] * $_SESSION['cart'][$row['MaSP']];
                    $updateString .= " when MaSP = " . $row['MaSP'] . " then SoLuong - " . $_SESSION['cart'][$row['MaSP']]; //Trừ đi sản phẩm tồn kho
                    
                }
            }
                if ($changeQuantity == false) {
            
                $updateQuantity = mysqli_query($connect, "UPDATE nongsansach.sanpham set SoLuong = CASE" . $updateString . " END where MaSP in (" . implode(",", array_keys($_SESSION['cart'])) . ")");
                $sql = mysqli_query($connect,"SELECT * FROM nongsansach.thongtinnguoinhan WHERE MaTK=" . $currentUser['MaTK']);
                $query = mysqli_fetch_array($sql);
                $tennn = $query['TenNN'];
                $sdtnn = $query['SDTNN'];
                $diachi = $query['DiaChi'];
                $insertOrder = "INSERT INTO nongsansach.donhang(TenKH,SDT,DiaChi,TrangThai,Payment,code_cart)
                VALUES ('".$tennn."', '".$sdtnn."','".$diachi."','".$trangthai."','".$card_payment."','".$code_order."')";
                $cart_query=mysqli_query($connect,$insertOrder);
                $last_id = mysqli_insert_id($connect); 
                $dateTime = date("Y-m-d H:i:s");
                $ngaytao = $dateTime;
                $orderID = $connect->insert_id;
                $insertString = "";
                foreach ($orderProducts as $key => $product) {
                    $insertString .= "(NULL,'" . $orderID . "', '" . $product['MaSP'] . "', '" . $_SESSION['cart'][$product['MaSP']] . "', '" . $product['GiaSP'] . "','" . $total . "', '" . $ngaytao . "','".$code_order."')";
                    if ($key != count($orderProducts) - 1) {
                        $insertString .= ",";
                    }
                
            }
                $insertOrder ="INSERT INTO nongsansach.chitietdonhang(MaCTDH,MaDH,MaSP,SoLuong,GiaSP,ThanhTien,NgayTao,code_cart) VALUES " . $insertString . ";";
                $cart_detail=mysqli_query($connect,$insertOrder);   
                }
        unset($_SESSION['cart']);
                
            }
        
    if($cart_query){
        echo '<h3 style="text-align: center; margin-top:20px; font-size:2.5rem">Giao dịch thanh toán bằng PAYPAL thành công</h3>';

    }else{
        echo 'Giao dịch thất bại';
    }
        
?>
        <tr>
                    <td class="resume-buys"><a href="?mod=displays/products" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                            Tiếp tục mua hàng</a>
                    </td>    
                </tr>
                    
                    <div class="clear"></div>
<script>alert("Cảm ơn bạn đã mua hàng, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất")</script>